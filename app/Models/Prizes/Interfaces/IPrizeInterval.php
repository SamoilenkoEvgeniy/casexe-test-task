<?php

namespace App\Modules\Prizes\Interfaces;

interface IPrizeInterval extends IPrize {
    public function setFrom($from);
    public function setTo($to);
}