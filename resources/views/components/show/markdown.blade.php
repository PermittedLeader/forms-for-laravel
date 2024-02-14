@props(['type'=>'text','label','hint'=>false,'inBlock'=>false,'name'=>false,'id'=>false,'value'])
@php
    if(!$name){
        $name = Str::snake($label);
    }
    if(!$id){
        $id= Str::snake(preg_replace('/[^A-Za-z0-9_]/',' ',$name));
    }
    $divClasses = "flex flex-col w-full ";
    $textClasses = "";
    $fieldClasses = "my-1 p-2 pt-0 max-w-none prose dark:prose-invert border rounded-sm border-gray-500";
    if($inBlock=="show"){
        $textClasses .= " font-bold";
    } elseif($inBlock){
        $textClasses .= " sr-only";
    } else {
        $textClasses .= " font-bold text-lg";
        $divClasses .= " mb-3";
    }
@endphp
<div class="{{ $divClasses }}">
    <label class="{{ $textClasses }}" for="{{ $id }}">
        {{ $label }}
    </label>
    @if($hint)
        <x-forms::hint>{{ $hint }}</x-forms::hint>
    @endif
    
    <div {{ $attributes->merge(['class'=>$fieldClasses]) }}" id="{{ $id }}">
        <x-forms::hint>Formatted text:</x-forms::hint> 
        {!! \Illuminate\Support\Str::markdown($value) !!} 
    </div>
</div>
