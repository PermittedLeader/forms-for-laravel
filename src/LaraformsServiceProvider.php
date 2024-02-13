<?php
namespace Permittedleader\Laraforms;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaraformsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            //Config
            __DIR__.'/../config/laraforms.php' => config_path('laraforms.php')
        ]);
        $this->loadViewsFrom(__DIR__.'/../resources/views/','laraforms');
        Blade::componentNamespace('Laraforms\\Views\\Components','laraforms');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laraforms.php','laraforms');
    }
}