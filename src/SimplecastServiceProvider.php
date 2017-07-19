<?php

namespace Clizaola\Simplecast;

use Illuminate\Support\ServiceProvider;

class SimplecastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {   
        // 
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('simplecast', function()
        {
            return new \Clizaola\Simplecast\Simplecast;
        });
    }
}
