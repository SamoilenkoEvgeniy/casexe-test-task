<?php

namespace App\Models\Prizes;

use App\Models\Prizes\Traits\IntervalTrait;
use App\Modules\Prizes\Interfaces\IPrice;

class LoyaltyPrize implements IPrice
{
    use IntervalTrait;

    public function __construct()
    {
        $this->setFrom(10);
        $this->setTo(100);
    }

}
