<?php

namespace Tests\Unit;

use App\Entities\Meal;
use App\Entities\Order;
use App\Jobs\AddOrderJob;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddOrderJobTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->setRequestUser();
    }

    public function test_can_add_order()
    {
        // Before you can have an order
        // 1. A menu must exist
        // 2. Items/Ingredients must exist to create meals

        Carbon::setTestNow(Carbon::parse('this wednesday'));

        factory(Meal::class, 2)->create();

        $this->request->merge(array_merge(factory(Order::class)->make()->toArray(), ['meals' => [1, 2]]));

        $order = dispatch_now(new AddOrderJob($this->request));

        self::assertInstanceOf(Order::class, $order);
        self::assertCount(2, $order->items);
    }

    /**
     * @expectedException \App\Exceptions\InvalidDayForOrderPlacementException
     */
    public function test_can_throw_exception_when_placing_an_order_on_an_invalid_date()
    {
        Carbon::setTestNow(Carbon::now()->startOfWeek());

        $this->request->merge(factory(Order::class)->make()->toArray());

        dispatch_now(new AddOrderJob($this->request));
    }

    /**
     * @expectedException \App\Exceptions\NoMealItemException
     */
    public function test_can_throw_exception_when_placing_an_order_without_meals()
    {
        Carbon::setTestNow(Carbon::parse('this wednesday'));

        $this->request->merge(factory(Order::class)->make()->toArray());

        dispatch_now(new AddOrderJob($this->request));
    }

}
