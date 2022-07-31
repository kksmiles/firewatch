<?php

namespace KkSmiles\Firewatch;
use Illuminate\Support\ServiceProvider;
use Illuminate\Session\SessionManager;
use Illuminate\Contracts\Debug\ExceptionHandler;

class FirewatchServiceProvider extends ServiceProvider 
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'firewatch');

        $this->publishes([
            __DIR__.'/config/firewatch.php' => config_path('firewatch.php')
        ], 'firewatch-config');

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'firewatch-config');

        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/firewatch'),
        ], 'public');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/firewatch.php', 'firewatch'
        );

        $this->extendExceptionHandler();
    }

    /**
     * Extend the Laravel default exception handler.
     *
     * @return void
     */
    private function extendExceptionHandler()
    {
        $this->app->extend(ExceptionHandler::class, function (ExceptionHandler $handler, $app) {
            return new FirewatchExceptionHandler($handler);
        });
    }
}