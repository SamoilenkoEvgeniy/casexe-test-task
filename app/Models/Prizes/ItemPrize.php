<?php

namespace App\Models\Prizes;

use App\Models\Prizes\Traits\ItemsTrait;
use App\Modules\Prizes\Interfaces\IPrice;

class ItemPrize implements IPrice
{
    use ItemsTrait;

    public function __construct()
    {
        $this->getItems();
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
