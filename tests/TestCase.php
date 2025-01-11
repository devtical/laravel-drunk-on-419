<?php

namespace Devtical\DrunkOn419\Tests;

use Devtical\DrunkOn419\Http\Middleware\HandleDrunkOn419;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Set up the test environment and register routes.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpRoutes($this->app);
    }

    /**
     * Define the test routes used during testing.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function setUpRoutes($app)
    {
        Route::get('/419', function () {
            abort(419);
        });

        $this->withHeader('referer', '/login');

        Route::get('/419-redirect', function () {
            abort(419);
        })->middleware([HandleDrunkOn419::class]);
    }
}
