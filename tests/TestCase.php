<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Request;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var Request
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new Request();
    }

    /**
     * @return Request
     */
    public function setRequestUser()
    {
        return $this->request->setUserResolver(function () {
            return factory(User::class)->create();
        });
    }
}
