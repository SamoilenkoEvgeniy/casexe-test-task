<?php

namespace Tests\Unit;

use App\Models\Prizes\LoyaltyPrize;
use App\Models\Prizes\MoneyPrize;
use Mockery;
use Tests\TestCase;

class MoneyPrizeConvertTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $initial_value = 100;
        $initial_namespace = MoneyPrize::class;

        $mockPrize = Mockery::mock(new \App\Models\Prize);
        $mockPrize->user_id = 1;
        $mockPrize->status = 'started';
        $mockPrize->namespace = $initial_namespace;
        $mockPrize->value = $initial_value;
        $this->app->instance('\App\Models\Prize', $mockPrize);

        $mockPrizeMoney = Mockery::mock(new \App\Models\Prizes\MoneyPrize());
        $mockPrizeMoney->coefficient = 2.75;
        $mockPrizeMoney->convertTo = LoyaltyPrize::class;
        $this->app->instance('\App\Models\Prizes\MoneyPrize', $mockPrizeMoney);

        $mockPrizeMoney->convert($mockPrize);

        $this->assertEquals($mockPrize->value, $mockPrizeMoney->coefficient * $initial_value);
        $this->assertEquals($mockPrize->namespace, $mockPrizeMoney->convertTo);
    }
}
