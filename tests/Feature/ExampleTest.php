<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_visit_the_homepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
