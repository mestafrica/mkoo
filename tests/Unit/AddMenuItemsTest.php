<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Entities\MenuItem;
use App\Jobs\AddMenuItems;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddMenuItemsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_add_menu_items()
    {

        $weeklySelection = factory(MenuItem::class)->make()->toArray();

        $weeklySelection['menu_id'] = 1;

        $response = dispatch_now(new AddMenuItems($weeklySelection));
        
        self::assertTrue($response);
    }
}
