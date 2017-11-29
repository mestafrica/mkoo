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

        if (collect($this->request->get('meals'))->isEmpty()) {
            throw new NoMealItemException('You must select the meals for this order');
        }

        $this->order->menu()->associate(Menu::find($this->request->get('menu_id')));

        $this->order->save();

        $this->order->items()->sync($this->getFormattedMealsFromRequest());

        return $this->order;
    }

    /**
     * Format meals submitted as part of the request to a format supported
     * by Model::sync when adding additional data to the pivot table
     *
     * [
     *      1 => ['serves_at' => '2017-12-06', 'type' => 'lunch'],
     *      5 => ['serves_at' => '2017-12-06', 'type' => 'dinner']
     * ]
     *
     * @see https://laravel.com/docs/5.5/eloquent-relationships#updating-many-to-many-relationships
     * @return array
     */
    private function getFormattedMealsFromRequest()
    {
        $meals = [];

        collect($this->request->get('meals'))->flatMap(function (array $meal, string $date) use (&$meals) {
            return collect($meal)->map(function ($mealId, $type) use ($date, &$meals) {
                return $meals[$mealId] = ['serves_at' => $date, 'type' => $type];
            })->values();
        });

        return $meals;
    }

}
