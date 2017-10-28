<?php

namespace Tests\Unit;

use App\Jobs\AddMealJob;
use App\Entities\Meal;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddMealJobTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_add_a_meal()
    {
        $this->setRequestUser();

        $meal = factory(Meal::class)->make([
            'name' => 'Lorem',
            'description' => 'Lorem ipsum'
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

        $meal = factory(Meal::class)->make([
            'name' => 'Lorem',
            'description' => 'Lorem ipsum'
        ]);

        $this->request->merge($meal->toArray());

        $meal = dispatch_now(new AddMealJob($this->request));

        self::assertInstanceOf(Meal::class, $meal);
        self::assertEquals('Lorem', $meal->name);
        self::assertEquals('Lorem ipsum', $meal->description);

        $this->request->replace([
            'name' => 'Updated name',
            'description' => 'Updated description'
        ]);

        $updated = dispatch_now(new AddMealJob($this->request, $meal));

        self::assertEquals('Updated name', $updated->name);
        self::assertEquals('Updated description', $updated->description);
        self::assertEquals($meal->created_by, $updated->created_by, 'User who created meal should not be updated');
    }
}
