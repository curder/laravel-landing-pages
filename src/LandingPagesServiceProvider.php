<?php
namespace Curder\LandingPages;

use App\Providers\RouteServiceProvider;
use Curder\LandingPages\Facades\LandingPages;

/**
 * Class LandingPageServiceProvider
 *
 * @package \Curder\LandingPage
 */
class LandingPagesServiceProvider extends RouteServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->publishes([__DIR__.'/../config/landing-pages.php' => config_path('landing-pages.php')], 'laravel-landing-pages-config');
        $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'laravel-landing-pages-migrations');
    }

    public function map()
    {
        parent::map();
        $this->loadRoutesFrom(__DIR__.'/../routes/landing-pages.php');
        $this->loadMigrationsFrom(__DIR__.'/../databases/migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('landing-pages', function ($app) {
            return new LandingPages;
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['landing-pages'];
    }
}
