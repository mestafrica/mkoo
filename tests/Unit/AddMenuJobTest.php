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
        self::assertNotNull($menu->serving_at);
    }

    public function test_can_select_menu()
    {

        $this->setRequestUser()
            ->merge(
                factory(Menu::class)->make()->toArray()
            );

        $menu = new Menu(['id'=>1, 'created_by'=>1]);
        $response = dispatch_now(new AddMenuJob($this->request, $menu));

        self::assertInstanceOf(Menu::class, $response);
        self::assertNotNull($response->created_by);
        self::assertNotNull($response->serving_at);
    }
}
