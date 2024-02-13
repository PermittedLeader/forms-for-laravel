<?php
namespace Permittedleader\Laraforms;

use Illuminate\Support\ServiceProvider;

class LaraformsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            //Config
            __DIR__.'/../config/laraforms.php' => config_path('laraforms.php')
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laraforms.php','laraforms');
    }
}