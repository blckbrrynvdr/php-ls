<?php
require 'src/functions.php';

// Task one
$paragraphs = [
    '1Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, unde!',
    '2Lorem ipsum dolor sit amet.',
    '3Lorem ipsum dolor sit amet, consectetur.',
];

printText($paragraphs);
echo '<hr>';
echo printText($paragraphs, true);
echo '<br><hr><br>';

// Task two
echo calcEverything('+', 3, 4, 5, 6);
echo '<br>';
echo calcEverything('-', 33, 24, 54, 61);
echo '<br>';
echo calcEverything('*', .1, .2, .3, 3.14);
echo '<br>';
echo calcEverything('/', 1000, 100, 10, 2);
echo '<br>';
echo calcEverything('=', 31, 34, 55, 16);
echo '<br><hr><br>';

// Task three
printMultiplyTable(5, 5);
echo '<br><hr><br>';

// Task four
echo date('d.m.Y H:i');
echo '<br>';
$time = '24.02.2016 00:00:00';
$timeUnix = strtotime($time);
$timeBack = date('d.m.Y H:i', $timeUnix);
echo "Время в обычном формате $timeBack превращается в timestamp $timeUnix";
echo '<br><hr><br>';

// Task five
$initialCarlString = 'Карл у Клары украл Кораллы';
echo str_replace('К', '', $initialCarlString);
echo '<br>';

$bottlesString = 'Две бутылки лимонада';
echo preg_replace('/Две/', 'Три', $bottlesString);
echo '<br><hr><br>';

//Task six
$filename = 'test.txt';
writeFile($filename,'Hello again! And again');

readAndPrintFile($filename);
