<?php

namespace Tests\Unit;

use App\Entities\Item;
use App\Entities\Meal;
use App\Jobs\AddMealJob;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddMealJobTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_add_a_meal()
    {
        $this->setRequestUser();

        $items = factory(Item::class, 2)->create()->pluck('id');

        $meal = factory(Meal::class)->make([
            'name' => 'Lorem',
            'description' => 'Lorem ipsum',
            'meal_items' => $items
        ]);

        $this->request->merge($meal->toArray());

        $meal = dispatch_now(new AddMealJob($this->request));

        self::assertInstanceOf(Meal::class, $meal);
        self::assertEquals('Lorem', $meal->name);
        self::assertEquals('Lorem ipsum', $meal->description);
    }

    public function test_can_update_a_meal()
    {
        $this->setRequestUser();

        $items = factory(Item::class, 2)->create()->pluck('id')->toArray();

        $meal = factory(Meal::class)->make([
            'name' => 'Lorem',
            'description' => 'Lorem ipsum',
        ]);

        $this->request->merge(
            array_merge($meal->toArray(), ['meal_items' => $items])
        );

        $meal = dispatch_now(new AddMealJob($this->request));

        self::assertInstanceOf(Meal::class, $meal);
        self::assertEquals('Lorem', $meal->name);
        self::assertEquals('Lorem ipsum', $meal->description);

        $this->request->merge([
            'name' => 'Updated name',
            'description' => 'Updated description'
        ]);

        $updated = dispatch_now(new AddMealJob($this->request, $meal));

        self::assertEquals('Updated name', $updated->name);
        self::assertEquals('Updated description', $updated->description);
        self::assertEquals($meal->created_by, $updated->created_by, 'User who created meal should not be updated');
    }

    /**
     * @expectedException \App\Exceptions\NoMealItemException
     * @expectedExceptionMessage You must provide at least 1 item to create a meal
     */
    public function test_can_throw_an_exception_if_no_items_are_provided_to_create_meal()
    {
        $this->setRequestUser();

        $meal = factory(Meal::class)->make([
            'name' => 'Lorem',
            'description' => 'Lorem ipsum',
        ]);

        $this->request->merge($meal->toArray());

        dispatch_now(new AddMealJob($this->request));
    }

}
