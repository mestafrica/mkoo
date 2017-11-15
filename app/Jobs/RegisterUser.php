<?php

namespace App\Jobs;

use App\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RegisterUser 
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
        unset($this->params['password_confirmation'], $this->params['_token']);
        
        $this->params['password'] = \Hash::make($this->params['password']);
        
        $user = User::create($this->params);
        
        return $user;
    }
}
