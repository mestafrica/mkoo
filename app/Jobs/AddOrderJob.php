<?php

namespace App\Jobs;

use App\Entities\Menu;
use App\Entities\Order;
use App\Exceptions\InvalidDayForOrderPlacementException;
use App\Exceptions\NoMealItemException;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AddOrderJob
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Order
     */
    private $order;

    /**
     * Create a new job instance.
     *
     * @param Request $request
     * @param Order $order
     */
    public function __construct(Request $request, Order $order = null)
    {
        $this->request = $request;
        $this->order = $order ?? new Order(['user_id' => $this->request->user()->id]);
    }

    /**
     * Execute the job.
     * @return Order
     * @throws \Exception
     */
    public function handle()
    {
        if (!in_array(Carbon::now()->format('l'), config('mkoo.days_for_order_placement'))) {
            throw new InvalidDayForOrderPlacementException;
        }

        $meals = collect($this->request->get('meals'));

        if ($meals->isEmpty()) {
            throw new NoMealItemException('You must select the meals for this order');
        }

        $this->order->menu()->associate(Menu::find($this->request->get('menu_id')));

        $this->order->save();

        $this->order->items()->sync($meals);

        return $this->order;
    }
}
