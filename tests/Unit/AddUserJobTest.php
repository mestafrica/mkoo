<?php

namespace Tests\Unit;

use App\Entities\User;
use App\Jobs\AddUserJob;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddUserJobTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_add_user()
    {
        $this->request->merge(
            factory(User::class)
                ->make(['first_name' => 'Meltwater', 'last_name' => 'Mkoo'])
                ->toArray()
        );

        $user = dispatch_now(new AddUserJob($this->request));

        self::assertInstanceOf(User::class, $user);
        self::assertEquals('Meltwater', $user->first_name);
        self::assertEquals('Meltwater Mkoo', $user->getFullName());
    }
}
