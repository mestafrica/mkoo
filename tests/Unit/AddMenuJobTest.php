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
        self::arrayHasKey('serving_at', $menu);
        self::arrayHasKey('menu_id', $menu);
        self::assertNotNull($menu['serving_at']);
        self::assertNotNull($menu['menu_id']);
    }
}
