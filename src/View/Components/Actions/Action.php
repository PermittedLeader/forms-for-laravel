<?php

namespace Permittedleader\Forms\View\Components\Actions;

use Closure;
use Illuminate\Console\View\Components\Component;

class Action extends Component
{
    public string $component = 'actions.default';

    protected $label;

    protected $createRoute;

    protected $editRoute;

    protected $showRoute;

    public bool $visibleOnShow = true;

    public bool $visibleOnCreate = true;

    public bool $visibleOnEdit = true;

    public $icon;

    /**
     * Action component
     *
     * @param  Closure|string  $routeName Pass either a closure providing the route or the route name for the submit action
     * @param  string  $title Title to be displayed
     */
    public function __construct(string $label)
    {
        $this->label = $label;
    }

    /**
     * Make an Action component
     *
     * @param  Closure|string  $routeName Pass either a closure providing the route or the route name for the submit action
     * @param  string  $title Title to be displayed
     */
    public static function make($label)
    {
        return new static($label);
    }

    /**
     * Define the component used for this Form
     *
     * @param  string  $component
     * @return self
     */
    public function component($component)
    {
        $this->component = 'actions.'.$component;

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
    public function render()
    {
        return view('forms::components.'.$this->component, ['actionObject' => $this]);
    }

    /**
     * Set the route used for this Action on Edit views
     *
     * @return self
     */
    public function setEditRoute(Closure $route)
    {
        $this->editRoute = $route;

        return $this;
    }

    /**
     * Set the route used for this Action on create views
     *
     * @return self
     */
    public function setCreateRoute(Closure $route)
    {
        $this->createRoute = $route;

        return $this;
    }

    /**
     * Set the route used for this Action on show views
     *
     * @return self
     */
    public function setShowRoute(Closure $route)
    {
        $this->showRoute = $route;

        return $this;
    }

    public function icon(string $iconClasses)
    {
        $this->icon = $iconClasses;

        return $this;
    }

    /**
     * Get the Route for the component to render
     *
     * @param  object|array  $data
     * @return string
     */
    public function getRoute($method)
    {
        if ($method == 'edit') {
            if ($this->editRoute instanceof Closure) {
                return ($this->editRoute)();
            } else {
                return route($this->editRoute);
            }
        } elseif ($method == 'create') {
            if ($this->createRoute instanceof Closure) {
                return ($this->createRoute)();
            } else {
                return route($this->createRoute);
            }
        } else {
            if ($this->showRoute instanceof Closure) {
                return ($this->showRoute)();
            } else {
                return route($this->showRoute);
            }
        }
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
}
