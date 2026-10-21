<?php

namespace Permittedleader\Forms\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateTime extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public ?string $hint = null,
        public ?bool $required = false,
        public ?bool $error = false,
        public ?string $name = null,
        public ?string $value = null,
        public ?string $format = 'datetime',
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('forms::components.input.datetime');
    }


    public function hasDate (): bool
    {
        return str_contains($this->format, 'date');
    }

    public function hasTime (): bool
    {
        return str_contains($this->format, 'time');
    }
}