<?php

namespace shanecullinane\Discogs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class DiscogsServiceProvider
 *
 * Taken almost as-is from https://github.com/jaiwalker/setup-laravel5-package
 * @package shanecullinane\Discogs
 */
class DiscogsServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    public function boot()
    {
        $this->loadViewsFrom(realpath(__DIR__.'/../views'), 'discogs');
        $this->setupRoutes($this->app->router);
        // this  for conig
        $this->publishes([
            __DIR__.'/config/discogs.php' => config_path('discogs.php'),
        ]);
    }
    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'shanecullinane\discogs\Http\Controllers'], function($router)
        {
            //require __DIR__.'/Http/routes.php';
        });
    }

    public function register()
    {
        $this->registerDiscogs();
        config([
            'config/discogs.php',
        ]);
    }
    private function registerDiscogs()
    {
        $this->app->bind('discogs',function($app){
            return new Discogs($app);
        });
    }

}