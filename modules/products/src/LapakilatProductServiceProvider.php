<?php

namespace Lapakilat\ProductModule;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Routing\RouteRegistrar as Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Factory;
/**
 * 
 */
class LapakilatProductServiceProvider extends ServiceProvider
{
	
	/**
    * Register any authentication / authorization services.
    *
    * @return void
    */
    public function register()
    {}
    /**
    * Register any authentication / authorization services.
    *
    * @return void
    */
    public function boot(Router $router, Factory $factory)
    {
        $this->loadConfig();
        $this->loadRoutes($router);
        $this->loadMigrationsAndFactories($factory);
        $this->loadViews();
    }

    public function loadConfig()
    {
        $path = __DIR__ . '/../config/lk-product.php';
        $this->mergeConfigFrom($path, 'lk-product');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $path => config_path('lk-product.php'),
            ], 'lk-product:config');
        }
    }

    public function loadRoutes(Router $router)
    {
        $router->prefix('api/'.config('lk-product.api.prefix', 'products'))
        ->namespace('Lapakilat\ProductModule\Http\Controllers\API')
        ->middleware(['api'])
        ->group(function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
    }

    public function loadMigrationsAndFactories(Factory $factory)
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $factory->load(__DIR__.'/../database/factories');
        }
    }

    private function loadViews()
    {
        $path = __DIR__.'/../resources/views';
        $this->loadViewsFrom($path, 'lk-product');
    }
}