<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Entities\Order;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AddOrderJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $request;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $allowedDates = config('mkoo')['days_for_order_placement'];
        
        if (!in_array(Carbon::now()->format('l'), $allowedDates)) {
            throw new \Exception('Sorry you may not create an order at this time', 1001);
        }

        $userId = $this->request->user()->id;
        $orders = $this->request->input('orders');
        foreach ($orders as $date => $types) {
            foreach ($types as $type => $choice) {
                $status = (new Order())->updateOrCreate(['serving_at'=> $date, 'type'=> $type,
                    'user_id'=> $userId], ['meal_id'=> $choice]);
            }
        }
        return $status;
    }
}
