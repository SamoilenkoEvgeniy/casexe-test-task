<?php

namespace App\Models;

use App\Models\Prizes\ItemPrize;
use App\Models\Prizes\LoyaltyPrize;
use App\Models\Prizes\MoneyPrize;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{

    protected $fillable = [
        'user_id', 'namespace', 'value', 'status'
    ];
    protected $statuses = [
        'started', 'accepted', 'declined', 'sent'
    ];

    protected static $allowedForUserChange = [
        'accepted', 'declined'
    ];


    /**
     * @param $status
     */
    public function changeStatus($status)
    {
        if (in_array($status, self::$allowedForUserChange)) {
            $this->status = $status;
            $this->save();
        }
    }

    /**
     * @return mixed
     */
    public static function getRandomPrize()
    {
        $prizes = [
            new ItemPrize(),
            new MoneyPrize(),
            new LoyaltyPrize()
        ];
        shuffle($prizes);
        $prize = $prizes[0];

        Prize::create([
            'user_id' => \Auth::user()->id,
            'namespace' => get_class($prize),
            'value' => $prize->getPrize(),
            'status' => 'started'
        ]);
    }

    public function toArray()
    {
        $pieces = explode('\\', $this->namespace);
        $this->type = array_pop($pieces);
        return parent::toArray();
    }

}
