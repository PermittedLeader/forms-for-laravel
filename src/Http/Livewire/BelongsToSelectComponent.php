<?php
namespace Permittedleader\Forms\Http\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class BelongsToSelectComponent extends Component
{
    public string $name;

    public string $label;

    public $required;

    public array $selectedIds;

    public array $selectedDisplay;

    public $fieldAttributes;

    public array|null $scope;

    public string $model;

    public bool $multiple = false;

    public bool $modalOpen = false;

    /**
     * Render this Action component for the table
     *
     * @return View
     */
    public function render()
    {
        return view('forms::livewire.belongs-to-select-component');
    }

    #[On('selected')]
    public function listenForSelected($values)
    {
        [$this->selectedIds, $this->selectedDisplay] = $values;
        $this->modalOpen = false;
    }
}