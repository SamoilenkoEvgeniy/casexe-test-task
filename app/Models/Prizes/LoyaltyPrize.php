<?php

namespace App\Models\Prizes;

use App\Models\Prizes\Traits\IntervalTrait;
use App\Modules\Prizes\Interfaces\IPrizeInterval;

class LoyaltyPrize implements IPrizeInterval
{
    use IntervalTrait;

    public function __construct()
    {
        $this->setFrom(10);
        $this->setTo(100);
    }

    public function isConvertible()
    {
        return false;
    }

    /**
     * @param $object
     * @param $user
     */
    public function toSent($object, $user)
    {
        try {
            \DB::transaction(function () use ($user, $object) {
                $user->scores = $user->score + $object->value;
                $user->save();
            });
            $object->status = 'sent';
            $object->save();
        } catch (\Throwable $e) {
            \log::info($e->getMessage());
        }
    }

}
