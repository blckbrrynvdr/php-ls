<?php
namespace Base;

class Db
{
    /** @var \PDO */
    private $pdo;
    private $log = [];
    private static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * Инициализация по принципу singleton
     * @return Db
     */
    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Ленивое подключение к бд
     * @return \PDO
     */
    private function getConnection()
    {
        $host = DB_HOST;
        $dbName = DB_NAME;
        $dbUser = DB_USER;
        $dbPassword = DB_PASSWORD;

        if (!$this->pdo) {
            $this->pdo = new \PDO(
                "mysql:host=$host;dbname=$dbName",
                $dbUser,
                $dbPassword,
                [
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
                ]
            );
        }

        return $this->pdo;
    }

    /**
     * Получить все данные по запросу
     * @param string $query
     * @param $_method
     * @param array $params
     * @return array
     */
    public function fetchAll(string $query, $_method, array $params = [])
    {
        $t = microtime(true);
        $prepared = $this->getConnection()->prepare($query);

        $ret = $prepared->execute($params);

        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            $errorMessage = "{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2];
            $this->logToDb($query, microtime(1) - $t, $_method, $errorMessage);
            trigger_error($errorMessage);
            return [];
        }

        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();
        $this->log[] = [$query, microtime(true) - $t, $_method, $affectedRows];
        $this->logToDb($query,microtime(1) - $t,$_method);

        return $data;
    }

    /**
     * Получить первую запись по запросу
     * @param string $query
     * @param $_method
     * @param array $params
     * @return array|bool|mixed
     */
    public function fetchOne(string $query, $_method, array $params = [])
    {
        $t = microtime(true);
        $prepared = $this->getConnection()->prepare($query);

        $ret = $prepared->execute($params);

        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            $errorMessage = "{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2];
            $this->logToDb($query, microtime(1) - $t, $_method, $errorMessage);
            trigger_error($errorMessage);
            return [];
        }

        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();


        $this->log[] = [$query, microtime(true) - $t, $_method, $affectedRows];
        $this->logToDb($query,microtime(1) - $t,$_method);
        if (!$data) {
            return false;
        }
        return reset($data);
    }

    /**
     * Выполнение запроса
     * @param string $query
     * @param $_method
     * @param array $params
     * @return int
     */
    public function exec(string $query, $_method, array $params = []): int
    {
        $t = microtime(1);
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);

        $ret = $prepared->execute($params);


        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            $errorMessage = "{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2];
            $this->logToDb($query, microtime(1) - $t, $_method, $errorMessage);
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return -1;
        }
        $affectedRows = $prepared->rowCount();

        $this->log[] = [$query, microtime(1) - $t, $_method, $affectedRows];
        $this->logToDb($query,microtime(1) - $t,$_method);

        return $affectedRows;
    }

    /**
     * Получить id последней записи в БД
     * @return string
     */
    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }

    /**
     * Вывести лог в html
     * @return string
     */
    public function getLogHTML()
    {
        if (!$this->log) {
            return '';
        }
        $res = '';
        foreach ($this->log as $elem) {
            $res = $elem[1] . ': ' . $elem[0] . ' (' . $elem[2] . ') [' . $elem[3] . ']' . "\n";
        }
        return '<pre>' . $res .'</pre>';
    }

    private function logToDb(string $query, $execution_time, $_method, string $errors = '')
    {
        $pdo = $this->getConnection();

        $prepared = $pdo->prepare('INSERT INTO logs (
                    current_query,
                    `method`,
                    `execution_time`,
                    `query_date`,
                    `errors`
                    ) VALUES (
                    :current_query,
                    :method,
                    :execution_time,
                    :query_date,
                    :errors
                )');
        $ret = $prepared->execute([
            'current_query' => $query,
            'method' => $_method,
            'execution_time' => $execution_time,
            'query_date' => date('Y-m-d H:i:s'),
            'errors' => $errors
        ]);

        return $ret;
    }

}