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
        $this->request->merge(factory(Menu::class)->make()->toArray());

        // use an allowed date in case test is ran
        // during days outside allowed dates
        Carbon::setTestNow(new Carbon('this tuesday'));

        $menu = dispatch_now(new AddMenuJob($this->request));

        self::assertInstanceOf(Menu::class, $menu);
        self::assertNotNull($menu->created_by);
        self::assertNotNull($menu->serving_at);
    }

    /**
     * @expectedException \App\Exceptions\InvalidDayForMenuCreation
     */
    public function test_can_throw_an_exception_when_day_of_creation_is_not_valid()
    {
        // menu creation should fail on days except Monday and Tuesday
        // assuming today is Wednesday
        Carbon::setTestNow(new Carbon('this wednesday'));

        $this->request->merge(factory(Menu::class)->make()->toArray());

        dispatch_now(new AddMenuJob($this->request));
    }
}
