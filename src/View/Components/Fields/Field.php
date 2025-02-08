<?php

namespace Permittedleader\Forms\View\Components\Fields;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Console\View\Components\Component;
use Illuminate\View\ComponentAttributeBag;

abstract class Field extends Component
{

    public string $component = 'fields.default';

    public $key;

    protected $label = '';

    public $value;

    public Closure $showTransformation;

    public Closure $inputTransformation;

    public bool $visibleOnShow = true;

    public bool $visibleOnCreate = true;

    public bool $visibleOnEdit = true;

    public int $columnSpan = 1;

    public bool $required = false;

    public ComponentAttributeBag $attributes;

    /**
     * Form component
     *
     * @param  Closure|string  $routeName Pass either a closure providing the route or the route name for the submit action
     * @param  string  $title Title to be displayed
     */
    public function __construct($key, $label = '', $value = '')
    {
        $this->key = $key;
        if ($label !== '') {
            $this->label = $label;
        } else {
            $this->label = (string) Str::of($key)->snake()->replace('_', ' ')->title();
        }
        if ($value != '') {
            $this->value = $value;
        }

        $this->attributes = new ComponentAttributeBag([]);
    }

    /**
     * Make an Form component
     *
     * @param  Closure|string  $routeName Pass either a closure providing the route or the route name for the submit action
     * @param  string  $title Title to be displayed
     */
    public static function make($key, $label = '', $value = '')
    {
        return new static($key,$label,$value);
    }

    /**
     * Define the component used for this Form
     *
     * @param  string  $component
     * @return self
     */
    public function component($component)
    {
        $this->component = 'fields.'.$component;

        return $this;
    }

    public function getLabel()
    {
        return __($this->label);
    }

    /**
     * Render this Action component for the table
     *
     * @return View
     */
    public function renderForShow()
    {
        return view('forms::components.'.$this->component, ['fieldObject' => $this, 'method' => 'show']);
    }

    /**
     * Render this Action component for the table
     *
     * @return View
     */
    public function renderForEditing()
    {
        return view('forms::components.'.$this->component, ['fieldObject' => $this, 'method' => 'edit', 'attributes'=>$this->attributes]);
    }

    /**
     * Return the transformed value of the field, ready for the component to render
     *
     * @return string
     */
    public function showValue()
    {
        if (isset($this->showTransformation)) {
            return ($this->showTransformation)($this->value);
        } else {
            return $this->value;
        }
    }

    /**
     * Define a closure to process the value being tranformed for display on detail pages
     *
     * @param  Closure  $showTransformation function($value){ do stuff }
     */
    public function formatShowDisplay(Closure $showTransformation): static
    {
        $this->showTransformation = $showTransformation;

        return $this;
    }

    /**
     * Return the transformed value of the field, ready for the component to render
     *
     * @return string
     */
    public function inputValue()
    {
        if (isset($this->inputTransformation)) {
            return ($this->inputTransformation)($this->value);
        } else {
            return $this->value;
        }
    }

    /**
     * Define a closure to process the value being tranformed for display on form pages
     *
     * @param  Closure  $inputTransformation function($value){ do stuff }
     */
    public function formatInputDisplay(Closure $inputTransformation): static
    {
        $this->inputTransformation = $inputTransformation;

        return $this;
    }

    /**
     * Set methods this field is visible on. Valid options are "edit","create","show"
     *
     * @return static
     */
    public function visibileOn(array $methods)
    {
        $this->visibleOnCreate = in_array('create', $methods);
        $this->visibleOnEdit = in_array('edit', $methods);
        $this->visibleOnShow = in_array('show', $methods);

        return $this;
    }

    /**
     * Set the field as required
     *
     * @return static
     */
    public function required(bool $required = true)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Create a component attribute bag for this field
     *
     * @param array $attributes
     * @return self
     */
    public function customAttributes(array $attributes): self
    {
        $this->attributes = new ComponentAttributeBag($attributes);
        return $this;
    }
}
