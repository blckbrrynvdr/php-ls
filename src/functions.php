<?php
    /*
     * Допустимые параметры для функции calcEverything
     */
    define('AVAILABLE_MATH_ACTIONS', ['*','-','+','/'], true);

    /*
     * Допустимое число байт при чтении файла
     */
    define('PRINT_FILE_MAX_LENGTH', 1024, true);

    /*
     * Задача 1
     * Функция оборачивает текст из элементов массива в тег p
     * @param array $paragraphs
     * @param bool $concat
     */
    function printText(array $paragraphs = [], bool $return = false)
    {
        $result = '';
        foreach ($paragraphs as $paragraph) {
            $result .= "<p>$paragraph</p>\n";
        }

        if ($return) {
            return $result;
        }

        echo $result;
    }

    /*
     * Задача 2
     * Функция арифмитических действий с числами
     * @param string $action
     * @param не знаю как этот тип правильно описать в PHPDoc $numbers
     */
    function calcEverything(string $action, ...$numbers) {
        if (!in_array($action,AVAILABLE_MATH_ACTIONS)) {
            trigger_error('ERROR: not available command');
            return 'Недопустимая операция.';
        }
        foreach ($numbers as $position => $number) {
            if (!is_int($number) && !is_float($number)) {
                trigger_error('ERROR: argument #'.$position.' is not integer or float');
                return 'Вас посетила digit police.';
            }
        }
        switch ($action) {
            case '+':
                return array_sum($numbers);
            case '-':
                return array_shift($numbers) - array_sum($numbers);
            case '/':
                $result = array_shift($numbers);
                foreach ($numbers as $number) {
                    if($number === 0) {
                        trigger_error('ERROR: argument #'.($position+1).' is zero.');
                        return 'Здесь вам не тут.';
                    }
                    $result = $result / $number;
                }
                return $result;
            case '*':
                $result = 1;
                foreach ($numbers as $number) {
                    $result *= $number;
                }
                return $result;

            default:
                return 'Ты мне втираешь какую-то дичь';
        }

    };

    /*
     * Функция вывода таблицы умножения из двух чисел
     * @param int $numberA
     * @param int $numberB
     * @return bool
     */
    function printMultiplyTable(int $numberA, int $numberB): bool {
        if ($numberA < 0 || $numberB < 0) {
            trigger_error('Arguments must be postitive');
            return false;
        }
        $result = '<table border="1">';
        for ($i = 1; $i <= $numberA; $i++) {
            $result .= '<tr>';
            for ($g = 1; $g <= $numberB; $g++) {
                $result .= '<td>';
                $result .= $i * $g;
                $result .= '</td>';
            }
            $result .= '</tr>';
        }
        $result .= '</table>';
        echo $result;
        return true;
    }

    /*
     * Функция для чтения файла и вывода на экран его содержимого
     */
    function readAndPrintFile(string $filename) {

        $fp = fopen($filename, 'r');
        if (!$fp) {
            return false;
        }

        $str = '';
        while (!feof($fp)) {
            $str .= fgets($fp, PRINT_FILE_MAX_LENGTH);
        }

        echo $str;
        return true;
    }