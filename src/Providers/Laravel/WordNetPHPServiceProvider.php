<?php

namespace WordNetPHP\Providers\Laravel;

use Illuminate\Support\ServiceProvider;

class WordNetPHPServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
           __DIR__.'/../../config.php' => config_path('wordnetphp.php'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('WordNetPHP\WordNetPHP', function ($app) {
            return new WordNetPHP();
        });
    }
}
