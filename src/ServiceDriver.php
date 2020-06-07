<?php
class ServiceDriver implements ServiceInterface
{

    private $price;
    public $serviceName = 'Дополнительный водитель';

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    public function apply(TariffInterface $tariff, &$price)
    {
        $price += $this->price;
    }
}