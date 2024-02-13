<?php
namespace Permittedleader\Laraforms;

use Livewire\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Permittedleader\Laraforms\Http\Livewire\Form;

class LaraformsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            //Config
            __DIR__.'/../config/laraforms.php' => config_path('laraforms.php')
        ]);
        $this->loadViewsFrom(__DIR__.'/../resources/views/','laraforms');
        Blade::componentNamespace('PermittedLeader\Laraforms\Views\Components','laraforms');
        Livewire::component('laraform::form',Form::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laraforms.php','laraforms');
    }
}