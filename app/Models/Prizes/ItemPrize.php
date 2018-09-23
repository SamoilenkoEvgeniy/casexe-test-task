<?php

namespace App\Models\Prizes;

use App\Modules\Prizes\Interfaces\IPrice;

class ItemPrize extends BasePrize implements IPrice
{
    public $type = 'item';

    public function getPrize()
    {
        // TODO: Implement getPrize() method.
    }
}
