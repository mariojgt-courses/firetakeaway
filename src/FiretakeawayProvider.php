<?php
namespace Mariojgt\Firetakeaway;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Mariojgt\Firetakeaway\Commands\Install;
use Mariojgt\Firetakeaway\Commands\Republish;
use Mariojgt\Firetakeaway\Events\UserVerifyEvent;
use Mariojgt\Firetakeaway\Listeners\SendUserVerifyListener;

class FiretakeawayProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Event for when you create a new user
        Event::listen(
            UserVerifyEvent::class,
            [SendUserVerifyListener::class, 'handle']
        );

        // Load some commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Republish::class,
                Install::class,
            ]);
        }

        // Loading the middlewhere
        $this->app['router']->aliasMiddleware(
            'boot_token',
            \Mariojgt\Firetakeaway\Middleware\BootTokenApi::class
        );

        // Load firetakeaway views
        $this->loadViewsFrom(__DIR__.'/views', 'firetakeaway');
        // Load firetakeaway routes
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/auth.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        // Load Migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publish();
    }

    public function publish()
    {
        // Publish the npm case we need to do soem developent
        $this->publishes([
            __DIR__.'/../Publish/Npm/' => base_path()
        ]);

        // Publish the resource in case we need to compile
        $this->publishes([
            __DIR__.'/../Publish/Resource/' => resource_path('vendor/Firetakeaway/')
        ]);

        // Publish the public folder
        $this->publishes([
            __DIR__.'/../Publish/Public/' => public_path('vendor/Firetakeaway/')
        ]);

        // Publish the public folder
        $this->publishes([
            __DIR__.'/../Publish/Config/' => config_path('')
        ]);
    }
}
