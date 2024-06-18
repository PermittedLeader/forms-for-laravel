<?php

namespace Permittedleader\Forms\View\Components\Input;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Asdh\LaravelFlatpickr\Components\Flatpickr;

class DateTime extends Flatpickr
{
    public string $name;
    public string $divClasses;
    public string $fieldClasses;
    public string $textClasses;

    public function __construct(
        public string $label,
        public string $type,
        public bool $required = false,
        ?string $name = null,
        ?string $inBlock = null,
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

        if(!$id){
            $id= Str::snake(preg_replace('/[^A-Za-z0-9_]/',' ',$name));
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

        $this->divClasses = "flatpickr-container flex flex-col w-full h-full";
        $this->textClasses = "text-black dark:text-white";
        $this->fieldClasses = "flatpickr-input h-full my-1 p-2 border ".config('tiffey.border-color')." dark:bg-gray-900 dark:text-white rounded";

        if($inBlock=="show"){
            $this->textClasses .= " font-bold";
        } elseif($inBlock){
            $this->textClasses .= " sr-only";
        } else {
            $this->textClasses .= " font-bold text-lg";
            $this->divClasses .= " mb-3 border-l-4 border-transparent";
        }

        parent::__construct(
            $this->config,
            $this->id,
            $this->showTime,
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
            $this->disableMobile,
        );
    }

    public function render(): View
    {
        return view('forms::components.input.datetime');
    }
}