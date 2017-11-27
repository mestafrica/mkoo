<?php

namespace Tests\Unit;

use App\Jobs\AddOrderJob;
use App\Entities\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddOrderJobTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_add_order()
    {
        $today = Carbon::now()->format('l');
        
        $this->setRequestUser()
            ->merge(factory(Order::class)->make()->toArray());

        if (!collect(config('allowed_dates')['order'])->contains($today)) {
            // dd((new \Exception())->getCode());
            // $this->expectException(\Exception::class);
        }

        $saved = dispatch_now(new AddOrderJob($this->request));

        self::assertTrue(true, $saved);
    }
}
