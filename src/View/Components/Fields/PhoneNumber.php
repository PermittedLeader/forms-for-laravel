<?php

namespace Permittedleader\Forms\View\Components\Fields;

use Propaganistas\LaravelPhone\PhoneNumber as LaravelPhonePhoneNumber;

class PhoneNumber extends Field
{
    public string $component = 'fields.phone-number';

    public function __construct($key, $label = '', $value = '')
    {
        parent::__construct($key, $label, $value);
        $this->formatShowDisplay(function ($value) {
            if ($value instanceof LaravelPhonePhoneNumber) {
                return $value->formatForCountry('GB');
            } else {
                return '';
            }
        });
    }
}
