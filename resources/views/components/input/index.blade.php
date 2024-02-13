@props(['type'=>'text','label','hint'=>false,'inBlock'=>false,'name'=>false, 'error'=>false,'id'=>false, 'required'=>false])
@php
    if(!$name){
        $name = Str::snake($label);
    }
    if(!$id){
        $id= Str::snake(preg_replace('/[^A-Za-z0-9_]/',' ',$name));
    }
    $divClasses = "flex flex-col w-full h-full";
    $textClasses = "";
    $fieldClasses = "h-full my-1 p-2 border border-gray-200 dark:bg-gray-900 dark:text-white rounded";
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
        $divClasses .= " border-warning-500 pl-3";
        $textClasses .= " text-warning-700";
        $fieldClasses .= " border-warning-500";
    @endphp
@enderror
<div class="{{ $divClasses }}">
    <label class="{{ $textClasses }}" for="{{ $id }}">
        {{ $label }}
        
        @if ($required)
            <x-required /> 
        @endif
    </label>
    @if($hint)
        <x-hint>{{ $hint }}</x-hint>
    @endif
    @error($name)
        <x-hint class="text-warning-700">{{ $message }}</x-hint>
    @enderror
    <input type="{{ $type }}" {{ $attributes->merge(['class'=>$fieldClasses]) }} name="{{ $name }}" id="{{ $id }}" @required($required) /> 
</div>
