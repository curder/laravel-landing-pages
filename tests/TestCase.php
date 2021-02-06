<?php

namespace Curder\LandingPages\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Curder\LandingPages\LandingPagesServiceProvider;

/**
 * Class TestCase
 *
 * @package Curder\LandingPages\Tests
 */
class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app) : array
    {
        return [
            LandingPagesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app) : void
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => 'lp_',
        ]);


        include_once __DIR__.'/../database/migrations/2018_10_30_093706_create_landing_pages_table.php';
        (new \CreateLandingPagesTable())->up();
    }
}
