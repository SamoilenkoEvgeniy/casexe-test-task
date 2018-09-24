<?php

namespace App\Models\Prizes;

use App\Models\Prizes\Traits\ItemsTrait;
use App\Modules\Prizes\Interfaces\IPrizeItem;

class ItemPrize implements IPrizeItem
{
    use ItemsTrait;

    public function __construct()
    {
        $this->getItems();
    }

    public function isConvertible()
    {
        return false;
    }

    public function toSent($object, $user)
    {
        $object->status = 'sent';
        $object->save();
    }

    /**
     * @return mixed
     */
    public function getPrize()
    {
        shuffle($this->items);
        return $this->items[rand(0, $this->length-1)];
    }
}
