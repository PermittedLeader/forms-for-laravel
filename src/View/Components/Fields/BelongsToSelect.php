<?php

namespace Permittedleader\Forms\View\Components\Fields;

class BelongsToSelect extends Field
{
    public $displayAttribute = 'name';

    public $keyAttribute = 'id';

    public array|null $scope = null;

    public bool $multiple = false;

    public $model;

    public string $component = 'fields.belongs-to-select';

    public function __construct($key, $label = '', $value = '')
    {
        parent::__construct($key, $label, $value);
        $this->formatShowDisplay(function ($value) {
            if (is_object($value)) {
                return $value->{$this->displayAttribute};
            } else {
                return $value;
            }
        });
        $this->formatInputDisplay(function ($value) {
            if (is_object($value)) {
                return $value->{$this->keyAttribute};
            } else {
                return $value;
            }
        });
    }

    /**
     * Set which attribute is used for displaying this model
     *
     * @param  string  $attributeName
     * @return self
     */
    public function displayAttribute($attributeName)
    {
        $this->displayAttribute = $attributeName;

        return $this;
    }

    /**
     * Set which attribute is used for the key for this model
     *
     * @param  string  $attributeName
     * @return self
     */
    public function keyAttribute($attributeName)
    {
        $this->keyAttribute = $attributeName;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string $modelClassName
     * @return void
     */
    public function model(string $modelClassName)
    {
        $this->model = $modelClassName;

        return $this;
    }

    public function scope(array $data)
    {
        $this->scope = $data;

        return $this;
    }

    public function multiple(bool $multiple = true)
    {
        $this->multiple = $multiple;

        return $this;
    }
}
