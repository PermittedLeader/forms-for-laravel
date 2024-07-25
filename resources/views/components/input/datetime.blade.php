@push('styles')
@once
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endonce
@endpush

@push('scripts')
@once
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endonce
@endpush

@error($name)
    @php
        $divClasses .= " border-warning-mid pl-3";
        $textClasses .= " text-warning-dark";
        $fieldClasses .= " border-warning-mid";
    @endphp
@enderror

<div
    @if($attributes->whereStartsWith("wire:model")->first())
    x-data="{value: @entangle($attributes->whereStartsWith("wire:model")->first())}"
    @else
    x-data="{value:'{{ $value }}'}"
    @endif
    x-init='
        let picker = flatpickr($refs.picker, @json($config()))
        picker.setDate(value)
        $watch("value",()=>picker.setDate(value))'
    class="{{ $divClasses }}"
>
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
    <div wire:ignore class="w-full">
        <input 
        type="text" 
        {{ $attributes->merge(['class'=>$fieldClasses]) }} 
        name="{{ $name }}" 
        id="{{ $id }}" 
        @required($required)
        x-ref="picker"
        x-model="value"
            />
    
        @if($clearable)
            <a id="{{ $id }}-clearable" title="clear" class="flatpickr-clearable" data-clear>
                {{ $clearer ?? $defaultClearer() }}
            </a>
        @endif
    </div>
    
    
</div>