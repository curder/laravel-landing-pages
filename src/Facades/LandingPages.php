<?php
namespace Curder\LandingPages\Facades;

use Illuminate\Support\Facades\Facade;

class LandingPages extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() : string
    {
        return 'landing-pages';
    }
}
