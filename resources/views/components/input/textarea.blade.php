@props(['label','hint'=>false,'inBlock'=>false,'name'=>false, 'error'=>false,'id'=>false, 'required'=>false])
@php
    if(!$name){
        $name = Str::camel($label);
    }
    if(!$id){
        $id= Str::snake(preg_replace('/[^A-Za-z0-9_]/',' ',$name));
    }
    $divClasses = "flex flex-col ";
    $textClasses = "";
    $fieldClasses = "w-full my-1 p-2 border border-gray-200 rounded";
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
        $divClasses .= " pl-3 border-warning-mid";
        $textClasses .= " text-warning-mid";
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
        <x-tiffey::hint>{{ $hint }}</x-tiffey::hint>
    @endif
    @error($name)
        <x-tiffey::hint class="text-pink">{{ $message }}</x-tiffey::hint>
    @enderror
    <textarea {{ $attributes->merge(['class'=>$fieldClasses]) }} name="{{ $name }}" id="{{ $id }}" @required($required)>{{ $slot }}</textarea>
</div>
