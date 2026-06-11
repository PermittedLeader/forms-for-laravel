<?php
namespace Permittedleader\Forms;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Permittedleader\Forms\Http\Livewire\BelongsToSelectComponent;

class FormsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views/','forms');
        Blade::componentNamespace('Permittedleader\\Forms\\View\\Components','forms');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'forms');
        $this->publishes([
            __DIR__."/../config/forms.php" => config_path('forms.php')
        ],'forms-config');
        $this->publishes([
            __DIR__."/../lang" => $this->app->langPath('permittedleader/tiffey-forms')
        ],'forms-lang');
        Livewire::component('belongs-to-select-component', BelongsToSelectComponent::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__."/../config/forms.php",'forms');
    }
}