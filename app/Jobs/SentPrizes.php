<?php

namespace App\Jobs;

use App\Models\Prize;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SentPrizes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $prize;

    /**
     * Create a new job instance.
     *
     * @param Prize $prize
     */
    public function __construct(Prize $prize)
    {
        $this->prize = $prize;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function handle()
    {
        $this->prize->send();
    }
}
