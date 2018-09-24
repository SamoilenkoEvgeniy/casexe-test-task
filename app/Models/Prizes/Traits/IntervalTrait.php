<?php
/**
 * Created by PhpStorm.
 * User: esamoilenko
 * Date: 24.09.2018
 * Time: 9:33
 */

namespace App\Models\Prizes\Traits;


trait IntervalTrait
{
    public $from;
    public $to;

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }


    public function getPrize()
    {
        return rand($this->from, $this->to);
    }
}