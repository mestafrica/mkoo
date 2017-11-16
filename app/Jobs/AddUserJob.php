<?php

namespace App\Jobs;

use App\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;

class AddUserJob
{
    use Dispatchable, Queueable;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @param Request $request
     * @param User $user
     */
    public function __construct(Request $request, User $user = null)
    {
        $this->request = $request;
        $this->user = $user ?? new User;
    }

    /**
     * Execute the job.
     *
     * @return User
     */
    public function handle()
    {
        foreach ($this->user->getFillable() as $fillable) {
            if ($this->request->has($fillable)) {
                $this->user->{$fillable} = $this->request->get($fillable);
            }
        }

        $this->user->save();

        return $this->user;
    }
}
