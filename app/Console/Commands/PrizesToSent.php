<?php

namespace App\Console\Commands;

use App\Jobs\SentPrizes;
use App\Models\Prize;
use Illuminate\Console\Command;

class PrizesToSent extends Command
{

    protected $signature = 'prizes:sent';
    protected $description = 'Sent all prizes which can be sended';

    protected $batch_count = 10;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $prizes = Prize::whereStatus(Prize::$isProcessableStatus)->get();

        foreach ($prizes as $prize) {
            SentPrizes::dispatch($prize)->delay(now()->addMinutes(1));
        }
    }
}
