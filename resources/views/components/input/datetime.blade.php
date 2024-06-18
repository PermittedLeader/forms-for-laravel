@push('styles')
@once
<x-flatpickr::style />
@endonce
@endpush

@push('scripts')
@once
<x-flatpickr::script />
@endonce
@endpush

@error($name)
    @php
        $divClasses .= " border-warning-mid pl-3";
        $textClasses .= " text-warning-dark";
        $fieldClasses .= " border-warning-mid";
    @endphp
@enderror

<div class="{{ $divClasses }}" id="{{ $containerId() }}">
    <label class="{{ $textClasses }}" for="{{ $id }}">
        {{ $label }}
        
        @if ($required)
            <x-tiffey::input.required /> 
        @endif
    </label>
    @if($hint)
        <x-tiffey::input.hint>{{ $hint }}</x-tiffey::input.hint>
    @endif
    @error($name)
        <x-tiffey::input.hint class="text-warning-dark dark:text-warning-light">{{ $message }}</x-tiffey::input.hint>
    @enderror
    <input 
        type="{{ $type }}" 
        {{ $attributes->merge(['class'=>$fieldClasses]) }} 
        name="{{ $name }}" 
        id="{{ $id }}" 
        @required($required)
        data-selector-id="{{ $selectorId() }}"
        data-config='@json($config())'
        data-disable-weekend="{{ $disableWeekend?1:0 }}"
        data-first-day-of-week="{{ $firstDayOfWeek }}"
        data-locale="{{ config('flatpickr.locale', 'default') }}"
        data-input
         /> 

        {{-- <input
            type="text"
            id="{{ $id }}"
            {{ $attributes->class(['flatpickr-input']) }}
            data-selector-id="{{ $selectorId() }}"
            data-config='@json($config())'
            data-disable-weekend="{{ $disableWeekend?1:0 }}"
            data-first-day-of-week="{{ $firstDayOfWeek }}"
            data-locale="{{ config('flatpickr.locale', 'default') }}"
            data-input
        /> --}}
    
        @if($clearable)
            <a id="{{ $id }}-clearable" title="clear" class="flatpickr-clearable" data-clear>
                {{ $clearer ?? $defaultClearer() }}
            </a>
        @endif
    </div>