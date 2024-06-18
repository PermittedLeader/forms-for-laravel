<?php
namespace Permittedleader\Forms;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FormsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views/','forms');
        Blade::componentNamespace('Permittedleader\\Forms\\View\\Components','forms');
    }

    public function register()
    {
        
    }
}