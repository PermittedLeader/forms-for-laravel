@props(['label','hint'=>false,'inBlock'=>false,'name'=>false, 'error'=>false, 'id'=>false, 'required'=>false])
@php
    if(!$name){
        $name = Str::snake($label);
    } else {
        $name = $name;
    }
    if(!$id){
        $id= Str::snake(preg_replace('/[^A-Za-z0-9_]/',' ',$name));
    }
    $divClasses = "flex flex-col";
    $textClasses = "";
    $fieldClasses = "w-full my-1 p-2 ".config('tiffey.border-color')." dark:bg-gray-900 dark:text-white rounded";
    if($inBlock=="show"){
        $textClasses .= " font-bold ";
        $divClasses .= " px-3 ";
    } elseif($inBlock){
        $textClasses .= " sr-only ";
    } else {
        $textClasses .= " font-bold text-lg";
        $divClasses .= " mb-3 border-l-4 border-transparent";
    }
@endphp
@error($name)
    @php
        $divClasses .= " border-warning-mid pl-3";
        $textClasses .= " text-warning-dark";
        $fieldClasses .= " border-warning-mid";
    @endphp
@enderror
<div class="{{ $divClasses }}">
    <label class="{{ $textClasses }}" for="{{ $id }}">
        {{ $label }}
        
        @if ($required)
            <x-tiffey::required />
        @endif
    </label>
    @if($hint)
        <x-tiffey::input.hint>{{ $hint }}</x-tiffey::input.hint>
    @endif
    @error($name)
        <x-tiffey::input.hint class="text-warning-dark">{{ $message }}</x-tiffey::input.hint>
    @enderror
    <select id="{{ $id }}" {{ $attributes->merge(['class'=>$fieldClasses]) }} name="{{ $name }}" @required($required)>
        {{ $slot }}
    </select>
</div>
