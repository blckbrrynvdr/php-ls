<?php

/*
 * Задача 2
 * На школьной выставке 80 рисунков. 23 из них выполнены фломастерами, 40 карандашами, а остальные — красками.
 *  Сколько рисунков, выполненные красками, на школьной выставке?
 * Описать и вывести условия, решение этой задачи на PHP. Все предоставленные числа из пункта 1 должн
 * быть указаны в константах.
 * */

// Общее число рисунков
define('DRAWINGS_COUNT', 80);
// Рисунки фломастерами
define('MARKER_DRAWINGS_COUNT', 23);
// Рисунки карандашами
define('PENCIL_DRAWINGS_COUNT', 40);


$paintDrawingsCount = DRAWINGS_COUNT - MARKER_DRAWINGS_COUNT - PENCIL_DRAWINGS_COUNT;
$drawingsDescription = 'На школьной выставке ' . DRAWINGS_COUNT . ' рисунков.<br>';
$drawingsDescription .= MARKER_DRAWINGS_COUNT . ' из них выполнены фломастерами, ';
$drawingsDescription .= PENCIL_DRAWINGS_COUNT . ' карандашами, а отсальные - красками.<br>';
$drawingsDescription .= 'Сколько рисунков, выполненные красками, на школьной выставке?<br>';
$drawingsDescription .= 'Ответ: ' . $paintDrawingsCount;
echo $drawingsDescription . '<br><hr>';
