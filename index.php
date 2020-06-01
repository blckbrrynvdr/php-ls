<?php
    require 'src/functions.php';

    // Task one
    $paragraphs = [
        'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, unde!',
        'Lorem ipsum dolor sit amet.',
        'Lorem ipsum dolor sit amet, consectetur.',
    ];

    printText($paragraphs);
    echo '<br><hr><br>';

    // Task two
    echo calcEverything('+', 3,4,5,6);
    echo '<br><hr><br>';

    // Task three
    printMultiplyTable(5,5);
    echo '<br><hr><br>';

    // Task four
    echo date('d.m.Y H:i');
    echo '<br>';
    $time = '24.02.2016 00:00:00';
    $timeUnix =  strtotime($time);
    $timeBack = date('d.m.Y H:i', $timeUnix);
    echo "Время в обычном формате $timeBack превращается в timestamp $timeUnix";
    echo '<br><hr><br>';

    // Task five
    $initialCarlString = 'Карл у Клары украл Кораллы';
    echo str_replace('К','',$initialCarlString);
    echo '<br>';

    $bottlesString = 'Две бутылки лимонада';
    echo preg_replace('/Две/','Три',$bottlesString);
    echo '<br><hr><br>';

    //Task six
    $filename = 'test.txt';
    $text = 'Hello again!';
    $file = fopen($filename, 'w');
    $writeStatus = fwrite($file, $text) ? true : false;

    readAndPrintFile($filename);
