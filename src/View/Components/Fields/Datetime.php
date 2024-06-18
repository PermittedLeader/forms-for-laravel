<?php

namespace Permittedleader\Forms\View\Components\Fields;

class Datetime extends Field
{
    public string $component = 'fields.datetime'; 

    public string $type = "datetime";

    /**
     * Set the type of the field
     * 
     * Datetime, date, time are valid options
     *
     * @param string $type
     * @return self
     */
    public function type($type = "datetime"): self
    {
        $this->type = $type;

        return $this;
    }
}
