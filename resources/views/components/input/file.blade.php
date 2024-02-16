@props(['label','hint'=>false,'inBlock'=>false,'name'=>false, 'error'=>false,'id'=>false, 'required'=>'false'])
@php
    if(!$name){
        $name = Str::snake($label);
    }
    if(!$id){
        $id= Str::snake(preg_replace('/[^A-Za-z0-9_]/',' ',$name));
    }
    $divClasses = "flex flex-col w-full h-full";
    $textClasses = "";
    $fieldClasses = "h-full my-1 p-2 dark:text-white rounded";
    if($inBlock=="show"){
        $textClasses .= " font-bold";
    } elseif($inBlock){
        $textClasses .= " sr-only";
    } else {
        $textClasses .= " font-bold text-lg";
        $divClasses .= " mb-3 border-l-4 border-transparent";
    }
@endphp
@error($name)
    @php
        $divClasses .= " border-warning-mid pl-3";
        $textClasses .= " text-warning-dark";
        $fieldClasses .= "";
    @endphp
@enderror
<div class="{{ $divClasses }}">
    <div class="{{ $textClasses }}">
        {{ $label }}
        
        @if ($required)
            <x-tiffey::input.required /> 
        @endif
    </div>
    @if($hint)
        <x-tiffey::input.hint>{{ $hint }}</x-tiffey::input.hint>
    @endif
    @error($name)
        <x-tiffey::input.hint class="text-warning-dark">{{ $message }}</x-tiffey::input.hint>
    @enderror
    <div class="flex flex-row items-center">
        @if($attributes->has('value') && $attributes['value'] !== "")
            <div class="p-2 pr-8 border-r border-gray-800 dark:border-gray-200 content-center">
                <x-tiffey::icon icon="fa-solid fa-file" label="File name" />
                {{ $attributes['value'] }}
            </div>
        @endif
        <label class="{{ $fieldClasses }}" for="{{ $id }}">
            <x-tiffey::button-no-link>
                Choose file
                <x-tiffey::icon.upload />
            </x-tiffey::button-no-link>
        </label>
        <input type="file" {{ $attributes->whereStartsWith('wire:model') }} class="hidden" name="{{ $name }}" id="{{ $id }}" @required($required) /> 
    </div>
</div>
