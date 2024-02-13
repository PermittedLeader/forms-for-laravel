<?php

namespace Permittedleader\Laraforms\Http\Livewire;

use Closure;
use Livewire\Component;
use Permittedleader\Laraforms\View\Components\Fields\Field;
use Permittedleader\Laraforms\View\Components\Actions\Action;

abstract class Form extends Component
{
    public string $component = 'form';

    public $method;

    protected $createRoute;

    protected $editRoute;

    protected $label = '';

    /**
     * Fields in the form
     *
     * @return array<Field> Array of fields to display
     */
    abstract public function fields(): array;

    /**
     * Return only fields visible on show
     */
    public function fieldsForShow(): array
    {
        return array_filter($this->fields(), function (Field $field) {
            return $field->visibleOnShow;
        });
    }

    /**
     * Return only fields visible on creating
     */
    public function fieldsForCreate(): array
    {
        return array_filter($this->fields(), function (Field $field) {
            return $field->visibleOnCreate;
        });
    }

    /**
     * Return only fields visible on editing
     */
    public function fieldsForEdit(): array
    {
        return array_filter($this->fields(), function (Field $field) {
            return $field->visibleOnEdit;
        });
    }

    /**
     * Actions on the form
     *
     * @return array<Action> Array of actions to display
     */
    public function actions(): array
    {
        return [

        ];
    }

    /**
     * Return only actions visible on method
     */
    public function actionsFor($method): array
    {
        return array_filter($this->actions(), function (Action $action) use ($method) {
            return $action->{'visibleOn'.ucfirst($method)};
        });
    }

    /**
     * Define the component used for this Form
     *
     * @param  string  $component
     * @return self
     */
    public function component($component)
    {
        $this->component = $component;

        return $this;
    }

    /**
     * Set the route used for this Form
     *
     * @return self
     */
    public function setEditRoute(Closure $route)
    {
        $this->editRoute = $route;

        return $this;
    }

    /**
     * Set the route used for this Form
     *
     * @return self
     */
    public function setCreateRoute(Closure $route)
    {
        $this->createRoute = $route;

        return $this;
    }

    /**
     * Get the Route for the component to render
     *
     * @param  object|array  $data
     * @return string
     */
    public function getRoute()
    {
        if ($this->method == 'edit') {
            if ($this->editRoute instanceof Closure) {
                return ($this->editRoute)();
            } else {
                return route($this->editRoute);
            }
        } else {
            if ($this->createRoute instanceof Closure) {
                return ($this->createRoute)();
            } else {
                return route($this->createRoute);
            }
        }
    }

    public function getLabel()
    {
        return __($this->label);
    }

    public function getFormMethod()
    {
        if ($this->method == 'edit') {
            return 'PATCH';
        }
    }

    /**
     * Render this Action component for the table
     *
     * @return View
     */
    public function render()
    {
        return view('laraforms::livewire.'.$this->component);
    }
}
