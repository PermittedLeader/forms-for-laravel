<?php

namespace Permittedleader\Forms\View\Components\Input;

use Carbon\Carbon;
use Asdh\LaravelFlatpickr\Components\Flatpickr;

class Datetime extends Flatpickr
{
    public function __construct(
        public string $label,
        public string $type,
        public bool $required = false,
        public ?string $name = null,
        public array $config = [],
        public string|int|null $id = null,
        public bool $showTime = false,
        public string $dateFormat = 'Y-m-d',
        public string $timeFormat = 'H:i',
        public ?string $altFormat = null,
        public string|Carbon|null $minDate = null,
        public string|Carbon|null $maxDate = null,
        public string|null $minTime = null,
        public string|null $maxTime = null,
        public int $firstDayOfWeek = 0,
        public array $disable = [],
        public bool $disableWeekend = false,
        public array $enable = [],
        public bool $multiple = false,
        public bool $range = false,
        public ?int $visibleMonths = null,
        public string|array|Carbon|null $value = null,
        public bool $inline = false,
        public bool $showWeekNumbers = false,
        public bool $time24hr = true,
        public bool $clearable = false,
        public bool $disableMobile = true,
    )
    {
        if(!$name){
            $this->name = Str::snake($label);
        } else {
            $this->name = $name;
        }
    
        switch ($type) {
            case 'date':
                
                break;
    
            case 'datetime':
                $this->showTime = true;
                $this->time24hr = true;
                break;
    
            case 'time':
                $this->showTime = true;
                $this->time24hr = true;
                break;
        }

        parent::__construct(
            $this->config,
            $this->id,
            $this->showTime,
            $this->disableMobile,
            $this->dateFormat,
            $this->timeFormat,
            $this->altFormat,
            $this->minDate,
            $this->maxDate,
            $this->minTime,
            $this->maxTime,
            $this->firstDayOfWeek,
            $this->disable,
            $this->disableWeekend,
            $this->enable,
            $this->multiple,
            $this->range,
            $this->visibleMonths,
            $this->value,
            $this->inline,
            $this->showWeekNumbers,
            $this->time24hr,
            $this->clearable,
        );
    }
}