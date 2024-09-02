<?php

namespace Permittedleader\Forms\View\Components\Fields;

use Illuminate\Support\Collection;

class Select extends Field
{
    public $displayAttribute = 'name';

    public $keyAttribute = 'id';

    public Collection $options;

    public string $component = 'fields.select';

    public function __construct($key, $label = '', $value = '')
    {
        parent::__construct($key, $label, $value);
        $this->formatShowDisplay(function ($value) {
            if (is_object($value)) {
                return $value->{$this->displayAttribute};
            } else {
                return '';
            }
        });
        $this->formatInputDisplay(function ($value) {
            if (is_object($value)) {
                return $value->{$this->keyAttribute};
            } else {
                return '';
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

    public function options($data)
    {
        $this->options = collect($data);

        return $this;
    }
}
