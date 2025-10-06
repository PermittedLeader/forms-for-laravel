<?php

namespace Permittedleader\Forms\View\Components\Fields;

class Datetime extends Field
{
    public string $component = 'fields.datetime';

    public string $type = 'datetime';

    public function __construct($key, $label = '', $value = '')
    {
        parent::__construct($key, $label, $value);
        $this->formatShowDisplay(function ($value) {
            if (is_object($value)) {
                if($this->type == 'date')
                {
                    return $value->format(config('forms.datetime_format.date','Y-m-d'));
                } elseif($this->type == 'time')
                {
                    return $value->format(config('forms.datetime_format.time','H:i:S'));
                } else {
                    return $value->format(config('forms.datetime_format.date','Y-m-d').' '.config('forms.datetime_format.time','H:i:S'));
                }
            } else {
                return $value;
            }
        });
    }

    /**
     * Set the type of the field
     *
     * Datetime, date, time are valid options
     *
     * @param  string  $type
     */
    public function type($type = 'datetime'): self
    {
        $this->type = $type;

        return $this;
    }
}