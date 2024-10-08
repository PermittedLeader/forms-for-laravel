<?php

namespace Permittedleader\Forms\View\Components\Fields;

use BackedEnum;
use Permittedleader\Forms\Traits\Enums\DisplayString;

class Enum extends Field
{

    public string $component = 'fields.enum';

    public iterable $options;

    public function __construct($key, $label = '', $value = '')
    {
        parent::__construct($key, $label, $value);
        $this->formatShowDisplay(function ($value) {
            if (is_object($value) && class_implements($value, DisplayString::class)) {
                return $value->display();
            } else {
                return $value->value;
            }
        });
        $this->formatInputDisplay(function ($value) {
            if (is_object($value) && class_implements($value, DisplayString::class)) {
                return $value->value;
            } else {
                return '';
            }
        });
    }

    public function options(array $data)
    {
        $this->options = $data;

        return $this;
    }
}
