<?php

namespace App\Modules\Prizes\Interfaces;

interface IPrizeShouldConverted extends IPrize {
    public function convert($object);
}