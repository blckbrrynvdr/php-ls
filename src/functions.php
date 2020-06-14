<?php
/*
 * Задание #3.1
 * Программно создайте массив из 50 пользователей, у каждого пользователя есть поля id, name и age:
 * id - уникальный идентификатор, равен номеру эл-та в массиве
 * name - случайное имя из 5-ти возможных (сами придумайте каких)
 * age - случайное число от 18 до 45
 * Преобразуйте массив в json и сохраните в файл users.json
 * Откройте файл users.json и преобразуйте данные из него обратно ассоциативный массив РНР.
 * Посчитайте количество пользователей с каждым именем в массиве
 * Посчитайте средний возраст пользователей
 */
const NAMES = [
    'Vitaliy',
    'Inokentiy',
    'Daria',
    'Petrovich',
    'Vasya'
];

/*
 * Функция создаёт массив с случайным именем и возрастом
 * @return $user
 */
function createUser(): array
{
    return [
        'name' => NAMES[array_rand(NAMES)],
        'age' => mt_rand(18, 45),
    ];
}

/*
 * Функция помещает данные массива в JSON файл в JSON формате
 * @param string $filename - имя файла
 * @param array  $data     - массив данных
 * @return bool - статус работы функции
 */
function createJsonFile(string $filename, array $data): bool
{
    return file_put_contents($filename, json_encode($data));
}

/*
 * Функция считывает JSON файл и возвращает его в виде ассоциативного массива
 * @param string $filename - имя файла
 * @return array
 */
function readJsonToArray(string $filename): array
{
    $result = [];
    if ($file = file_get_contents($filename)) {
        $result = json_decode($file, true);
    }
    return $result;
}


/*
 * Функция возращает количество значений ключей $keyName в массиве $dataArray
 * @param array  $dataArray - имя файла
 * @param string $keyName   - массив данных
 * @return array
 */
function getKeysCount(array $dataArray, string $keyName): array
{
    $result = [];
    foreach ($dataArray as $name => $data) {
        if (isset($result[$data[$keyName]])) {
            $result[$data[$keyName]]++;
        } else {
            $result[$data[$keyName]] = 1;
        }
    }
    return $result;
}

/*
 * Функция возращает среднюю значение массива $dataArray по ключу $calculatingField
 * @param array $dataArray - имя массива
 * @param string $calculatingField - ключ массива
 * @return float
 */
function getAverageNumber(array $dataArray, string $calculatingField): float
{
    $result = '';
    $fieldsSum = 0;
    foreach ($dataArray as $data) {
        $fieldsSum += $data[$calculatingField];
    }
    $result = $fieldsSum / sizeof($dataArray);
    return $result;
}