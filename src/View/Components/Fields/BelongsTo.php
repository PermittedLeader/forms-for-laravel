<?php

namespace Permittedleader\Forms\View\Components\Fields;

class BelongsTo extends Field
{
    public $displayAttribute = 'name';

    public $keyAttribute = 'id';

    public $options;

    public string $component = 'fields.belongs-to';

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

    public function options($data)
    {
        $this->options = $data;

        return $this;
    }
}
