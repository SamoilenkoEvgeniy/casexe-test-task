<?php

namespace App\Models\Prizes;

use App\Models\Prizes\Traits\IntervalTrait;
use App\Modules\Prizes\Interfaces\IPrizeInterval;
use App\Modules\Prizes\Interfaces\IPrizeShouldConverted;

class MoneyPrize implements IPrizeShouldConverted, IPrizeInterval
{
    use IntervalTrait;

    public $convertTo;
    public $coefficient;

    public function __construct()
    {
        $this->setFrom(100);
        $this->setTo(1000);

        $this->convertTo = LoyaltyPrize::class;
        $this->coefficient = 2.75;
    }

    /**
     * @return bool
     */
    public function isConvertible()
    {
        return true;
    }

    public function toSent($object, $user)
    {
        $object->status = 'sent';
        $object->save();
    }

    /**
     * @param $object
     */
    public function convert($object)
    {
        $object->namespace = $this->convertTo;
        $object->value = $object->value * $this->coefficient;
        $object->save();
    }
}
