<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Jobs\AddMenuItems;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddMenuItemsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_add_menu_items()
    {

        $weeklySelection = [];
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        foreach ($days as $day) {
            $weeklySelection[$day]['lunch'] = [rand(1, 40),rand(1, 40)];
            $weeklySelection[$day]['dinner'] = [rand(1, 40),rand(1, 40)];
        }
        
        $weeklySelection['menu_id'] = 1;

        $response = dispatch_now(new AddMenuItems($weeklySelection));
        
        self::assertTrue($response);
    }
}
