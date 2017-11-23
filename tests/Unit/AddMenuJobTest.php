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

    public function test_can_add_menu()
    {
        $this->setRequestUser()
            ->merge(
                factory(Menu::class)->make()->toArray()
            );

        $menu = dispatch_now(new AddMenuJob($this->request));

        self::assertInstanceOf(Menu::class, $menu);
        self::assertNotNull($menu->created_by);
//        self::assertNotNull($menu->serving_date);
    }

    public function test_can_update_menu()
    {
        $this->setRequestUser()
            ->merge(
                factory(Menu::class)->make()->toArray()
            );

        $menu = dispatch_now(new AddMenuJob($this->request));

        self::assertInstanceOf(Menu::class, $menu);
        self::assertNotNull($menu->created_by);
//        self::assertNotNull($menu->serving_date);

        $this->request->replace(['serving_date' => '2017-04-21']);

        $updatedMenu = dispatch_now(new AddMenuJob($this->request, $menu));

//        self::assertEquals(Carbon::parse('2017-04-21'), $updatedMenu->serving_date);
    }
}
