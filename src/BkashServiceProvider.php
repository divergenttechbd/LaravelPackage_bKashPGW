<?php

namespace Divergent\Bkash;

use Illuminate\Support\ServiceProvider;

class BkashServiceProvider extends ServiceProvider {
    
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config/bkash.php', 'bkash');
        $this->publishes([
            __DIR__.'/config/bkash.php' => config_path('bkash.php'),
        ]);
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        
    }
}