<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Entities\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AddOrder
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
        $userId = \Auth::id();

        $saveChoices = function ($day, $choices) use ($userId) {
            $servingAt =  Carbon::parse('this '.$day)
            ->toDateString();
            $count = 0;
            foreach ($choices as $type => $mealId) {
                ${'order'.$count++} = new Order(['serving_at'=>$servingAt, 'type'=>$type,
                    'user_id'=>$userId, 'meal_id'=>$mealId]);
            }
            return ($order0->save() && $order1->save());
        };

        $days = collect($this->params)->except('_token');
        foreach ($days as $day => $choices) {
            $saveChoices($day, $choices);
        }

        return false;
    }
}
