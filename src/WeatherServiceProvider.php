<?php

namespace Prrwebcreate\Weather;


use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\App;
use File;


class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public $routeFilePath = '/routes/weather/weather.php';

    public function boot(Router $router): void
    {
         $this->loadViewsFrom(__DIR__.'/resources/views', 'weather');
         $this->loadMigrationsFrom(__DIR__.'/database/migrations');
         $this->loadTranslationsFrom(realpath(__DIR__.'/resources/lang'), 'weather');
        $this->setupRoutes($this->app->router);
        
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
        $this->publishAssets();

        $this->app->singleton('weather', function ($app) {
            return new Weather($app['request']->server());
        });

        $this->app->alias('weather', Weather::class);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        
        
        $this->mergeConfigFrom(__DIR__.'/../config/weather.php', 'weather');

        // Register the service the package provides.
        
        //load helpers
        $this->loadHelpers();
        
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['weather'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/weather.php' => config_path('weather.php'),
        ], 'weather.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views/vendor/weather'),
        ], 'weather.views');

        // Publishing the translation files.
        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/weather'),
        ], 'weather.lang');
    }

    public function setupRoutes(Router $router)
    {
        
        // by default, use the routes file provided in vendor
        $routeFilePathInUse = __DIR__.$this->routeFilePath;
    
        // but if there's a file with the same name in routes/weather, use that one
        if (file_exists(base_path().$this->routeFilePath)) {
            $routeFilePathInUse = base_path().$this->routeFilePath;
        }

        $this->loadRoutesFrom($routeFilePathInUse);
    }
   
    public function loadHelpers(){
        require_once __DIR__.'/helpers.php';
    }
    public function publishAssets(){
        $smoothcms_assets = [__DIR__.'/public' => public_path('vendor/weather')];
        $this->publishes($smoothcms_assets,'weather.public');
    }

}
