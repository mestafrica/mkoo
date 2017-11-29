<?php

namespace Tests\Unit;

use App\Jobs\AddMenuJob;
use App\Entities\Menu;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddMenuJobTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->setRequestUser();
    }

    public function test_can_add_menu()
    {
        Carbon::setTestNow(Carbon::parse('this monday'));

        $this->request->merge(
            array_merge(factory(Menu::class)->make()->toArray(), ['meals' => $this->getMealsForMenu()])
        );

        $menu = dispatch_now(new AddMenuJob($this->request));

        self::assertInstanceOf(Menu::class, $menu);
        self::assertNotNull($menu->created_by);
        self::assertNotNull($menu->serving_at);
    }

    /**
     * @expectedException \App\Exceptions\InvalidDayForMenuCreationException
     */
    public function test_can_throw_an_exception_when_day_of_creation_is_not_valid()
    {
        // menu creation should fail on days except Monday and Tuesday
        // assuming today is Wednesday
        Carbon::setTestNow(new Carbon('this wednesday'));

        $this->request->merge(factory(Menu::class)->make()->toArray());

        dispatch_now(new AddMenuJob($this->request));
    }

    /**
     * @return mixed
     */
    private function getMealsForMenu()
    {
        $meals = [];

        $getDate = function ($day) {
            return  Carbon::now()->startOfWeek()->addWeek(1)
                ->addDay($day)->toDateString();
        };

        foreach (range(0, 5) as $day) {
            $meals[$getDate($day)]['lunch'] = [rand(1, 40),rand(1, 40)];
            $meals[$getDate($day)]['dinner'] = [rand(1, 40),rand(1, 40)];
        }

        return $meals;
    }
}
