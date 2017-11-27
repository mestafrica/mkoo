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
        $today = Carbon::now()->format('l');
        $this->setRequestUser()
            ->merge(factory(Menu::class)->make()->toArray());

       if (!collect(config('allowed_dates')['menu'])->contains($today)) {
           $this->expectException(\Exception::class);
        }

        $menu = dispatch_now(new AddMenuJob($this->request));

        self::assertInstanceOf(Menu::class, $menu);
        self::assertNotNull($menu->created_by);
        self::assertNotNull($menu->serving_at);
    }
}
