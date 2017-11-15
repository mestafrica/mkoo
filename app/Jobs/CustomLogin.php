<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CustomLogin 
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $params;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (\Auth::attempt(array('email' => $this->params['email'], 'password' => $this->params['password']), true)) {
            return true;
        }
        return false;
    }
}
