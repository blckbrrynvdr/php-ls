<?php
include 'src/functions.php';

$filename = 'users.json';

for ($i = 0; $i < 50; $i++) {
    $users[] = createUser();
}
echo '<pre>';


$createJSONStatus = createJSONFile($filename, $users);



$readedUsers = readJSONToArray($filename);
//var_dump($readedUsers);

echo 'Колличество имён в массиве: <br>';
$names = getKeysCount($readedUsers, 'name');
foreach ($names as $name => $count) {
    echo "Имя $name встречается $count раз;<br>";
}
echo '<br><hr>';

$ageSum = getAverageNumber($readedUsers, 'age');

echo "Средний возраст пользователя $ageSum";
