<?php
include 'src/TariffInterface.php';
include 'src/ServiceInterface.php';
include 'src/TariffAbstract.php';
include 'src/TariffBasic.php';
include 'src/TariffHour.php';
include 'src/TariffStudents.php';
include 'src/ServiceGPS.php';
include 'src/ServiceDriver.php';


$tariffBasic = new TariffBasic(5,60);
$tariffBasic->addService(new ServiceGPS(15));
$tariffBasic->addService(new ServiceDriver(100));
echo 'По тарифу "'.$tariffBasic->getName().'" за 5 км и 60 минут, c услугами Gps в салон и Дополнительный водитель 
цена составит :' .$tariffBasic->countPrice();
echo '<br>';

$tariffHour = new TariffHour(5,61);
echo 'По тарифу "'.$tariffHour->getName().'" за 5 км и 60 минут цена составит :';
echo $tariffHour->countPrice();
echo '<br>';


$tariffStudents = new TariffStudents(5,60);
echo 'По тарифу "'.$tariffHour->getName().'" за 5 км и 60 минут цена составит :';
echo $tariffStudents->countPrice();
echo '<br>';