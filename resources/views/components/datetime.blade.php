@props(['label','name'=>false,'hint'=>false,'type','value'=>false,'interval'=>false])
@php
    if(!$name){
        $name = Str::snake($label);
    } else {
        $name = $name;
    }
    $display = array();
    if($value){
        if(!is_a($value, \Carbon\Carbon::class) && !is_a($value,\Carbon\CarbonInterval::class)){
            if($interval){
                $value = dateFieldToInterval($value);
            } elseif(is_array($value)){
                $value = dateFieldToCarbon($value);
            } else {
                $value = \Carbon\Carbon::parse($value);
            }
        }
        if(is_a($value,\Carbon\CarbonInterval::class)){
            $display['y'] = $value->format('%Y');
            $display['m'] = $value->format('%M');
            $display['d'] = $value->format('%D');
            $display['h'] = $value->format('%H');
            $display['i'] = $value->format('%I');
        } else {
            $display['y'] = $value->format('Y');
            $display['m'] = $value->format('m');
            $display['d'] = $value->format('d');
            $display['h'] = $value->format('H');
            $display['i'] = $value->format('i');
        }
    } else {
        $display['y'] = "";
        $display['m'] = "";
        $display['d'] = "";
        $display['h'] = "";
        $display['i'] = "";
    }
@endphp
<x-forms::fieldset label="{{ $label }}" name="{{ $name }}" {{ $attributes }}>
    @if($hint)
        <x-forms::hint>{{ $hint }}</x-forms::hint>
    @endif
    <div class="flex flex-row">
        @if($type=="date"||$type=="datetime")
            @if ($attributes->has('required'))
                <span class="mr-2"><x-forms::input label="{{ __('Day') }}" name="{{$name}}[day]" type="number" min="1" max="31" in-block="show" value="{{ $display['d'] }}" required class="w-16"/></span>
                <span class="mr-2"><x-forms::input label="{{ __('Month') }}" name="{{$name}}[month]" type="number" min="1" max="12" in-block="show" value="{{ $display['m'] }}" required class="w-16"/></span>
                <span class="mr-2"><x-forms::input label="{{ __('Year') }}" name="{{$name}}[year]" type="number" min="0" max="9999" in-block="show" value="{{ $display['y'] }}" required class="w-20"/></span>
            @else
                <span class="mr-2"><x-forms::input label="{{ __('Day') }}" name="{{$name}}[day]" type="number" min="1" max="31" in-block="show" value="{{ $display['d'] }}" class="w-16" /></span>
                <span class="mr-2"><x-forms::input label="{{ __('Month') }}" name="{{$name}}[month]" type="number" min="1" max="12" in-block="show" value="{{ $display['m'] }}" class="w-16"/></span>
                <span class="mr-2"><x-forms::input label="{{ __('Year') }}" name="{{$name}}[year]" type="number" min="0" max="9999" in-block="show" value="{{ $display['y'] }}" class="w-20"/></span>
            @endif
        @endif
        @if($type=="datetime")
            <span class="mr-6"></span>
        @endif
        @if($type=="time"||$type=="datetime")
            @if ($attributes->has('required'))
                <span class="mr-2"><x-forms::input label="{{ __('Hours') }}" name="{{$name}}[hour]" type="number" min="0" in-block="show" value="{{ $display['h'] }}" required class="w-16"/></span>
                <span class="mr-2"><x-forms::input label="{{ __('Minutes') }}" name="{{$name}}[minute]" type="number" min="0" max="59" in-block="show" value="{{ $display['i'] }}" required class="w-16"/></span>
            @else
                <span class="mr-2"><x-forms::input label="{{ __('Hours') }}" name="{{$name}}[hour]" type="number" min="0" in-block="show" value="{{ $display['h'] }}" class="w-16"/></span>
                <span class="mr-2"><x-forms::input label="{{ __('Minutes') }}" name="{{$name}}[minute]" type="number" min="0" max="59" in-block="show" value="{{ $display['i'] }}" class="w-16"
                /></span>
            @endif
        @endif
    </div>
</x-fieldset>
