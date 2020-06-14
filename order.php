<?php
include 'src/config.php';
include 'src/class.db.php';
include 'src/class.burger.php';

use Order\Burger;



$email = $_POST['email'];
$name = $_POST['name'];
$error = '';

$addressFields = ['street', 'home', 'part', 'appt', 'floor'];
$address = '';
foreach ($_POST as $field => $value) {
    if ($value && in_array($field, $addressFields)) {
        $address .= $value.',';
    }
}

if (!trim($email)) {
    $error .= 'Не указан email!<br>';
}
if (!trim($name)) {
    $error .= 'Не указано имя!<br>';
}
if (!trim($address)) {
    $error .= 'Мы не знаем куда везти, так что съедим сами. Спасибо!<br>';
}

if (!trim($error)) {
    echo $error;
    die;
}

$burger = new Burger();

$data = ['address' => $address];

$user = $burger->getUserByEmail($email);


if ($user) {
    $userId = $user['id'];
    $burger->incOrders($userId);
    $orderNumber = $user['orders_count'] + 1;
} else {
    $orderNumber = 1;
    $userId = $burger->createUser($email, $name);
}

$orderId = $burger->addOrder($userId, $data);

echo "Спасибо, ваш заказ будет доставлен по адресу: $address<br>
Номер вашего заказа: $orderId
Это ваш $orderNumber-й заказ!";