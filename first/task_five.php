<?php
/*
 * Задание #5
 * 1. Создайте массив $bmw с ячейками: model, speed, doors, year
 * 2. Заполните ячейки значениями соответсвенно: “X5”, 120, 5, “2015”.
 * 3. Создайте массивы $toyota' и '$opel аналогичные массиву $bmw (заполните данными).
 * 4. Объедините три массива в один многомерный массив.
 * 5. Выведите значения всех трех массивов в виде:
 * CAR name
 * name ­ model ­speed ­ doors ­ year
 */

$bmw = [
    'model' => 'X5',
    'speed' => 200,
    'doors' => 5,
    'year' => 2015,
];

$toyota = [
    'model' => 'auris',
    'speed' => 90,
    'doors' => 5,
    'year' => 2010,
];

$opel = [
    'model' => 'kadett',
    'speed' => 0,
    'doors' => 5,
    'year' => 1990,
];

$cars = ['bmw' => $bmw, 'toyota' => $toyota, 'opel' => $opel];

foreach ($cars as $vendor => $car) {
    echo "CAR $vendor<br>";
    echo "{$car['model']} {$car['speed']}  {$car['doors']}  {$car['year']}<br>";
}
