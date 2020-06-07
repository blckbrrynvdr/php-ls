<?php
class TariffStudents extends TariffAbstract
{
    protected $pricePerKilometer = 4;
    protected $pricePerMinute = 1;
    protected $tariffName = 'Студенческий';

    public function __construct(int $distance, int $minutes)
    {
        parent::__construct($distance, $minutes);

        $this->minutes = $this->minutes - $this->minutes % 60 + 60;
    }
}