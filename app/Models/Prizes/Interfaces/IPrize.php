<?php

namespace App\Modules\Prizes\Interfaces;

interface IPrize {
    public function getPrize();

    public function isConvertible();

    public function toSent($object, $user);
}