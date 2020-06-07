<?php
include 'src/config.php';
include 'src/class.db.php';
include 'src/class.burger.php';
include 'src/functions.php';

use Order\Burger;


$burger = new Burger();

$email = $_POST['email'];
$name = $_POST['name'];

$addressFields = ['street', 'home', 'part', 'appt', 'floor'];
$address = '';
foreach ($_POST as $field => $value) {
    if ($value && in_array($field, $addressFields)) {
        $address .= $value.',';
    }
}

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