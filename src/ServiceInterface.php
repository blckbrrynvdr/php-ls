<?php
interface ServiceInterface
{
    public function apply(&$price, TariffInterface $tariff = null);
}