<?php
/**
 * Created by PhpStorm.
 * User: esamoilenko
 * Date: 24.09.2018
 * Time: 9:33
 */

namespace App\Models\Prizes\Traits;


trait ItemsTrait
{
    public $items = [];
    public $length = 0;

    public function getItems()
    {
        // @todo implement getting items
        $items = [
            'one', 'two', 'three'
        ];
        $this->items = $items;
        $this->length = count($items);
        return true;
    }
}