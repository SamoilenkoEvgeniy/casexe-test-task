<?php

namespace App\Models\Prizes;

use App\Models\Prizes\Traits\IntervalTrait;
use App\Modules\Prizes\Interfaces\IPrice;

class MoneyPrize implements IPrice
{
    use IntervalTrait;

    public function __construct()
    {
        $this->setFrom(100);
        $this->setTo(1000);
    }
}
