@props(['type'=>'text','label','hint'=>false,'inBlock'=>false,'name'=>false, 'error'=>false,'id'=>false, 'required'=>false, 'value'=>false])
@php
    if(!$name){
        $name = Str::snake($label);
    }
    if(!$id){
        $id= Str::snake(preg_replace('/[^A-Za-z0-9_]/',' ',$name));
    }
    $divClasses = "flex flex-col w-full h-full";
    $textClasses = "text-black dark:text-white";
    $fieldClasses = "h-full my-1 p-2 border ".config('tiffey.border-color')." dark:bg-gray-900 dark:text-white rounded";
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
        $fieldClasses .= " border-warning-mid";
    @endphp
@enderror

<div 
    class="{{ $divClasses }}" 
    @if($attributes->whereStartsWith("wire:model")->first())
    x-data="{ 
        value: $wire.entangle('{{ $attributes->whereStartsWith('wire:model')->first()}}'){{ $attributes->has('wire:model.live') ? '.live' : '' }}, 
        toggle() {
            if(this.value == 1){
                this.value = 0
            } else {
                this.value = 1 
            }
        }
    }"
    @else
    x-data="{ 
        value: {{ $value ? '1' : '0' }}, 
        toggle() {
            if(this.value == 1){
                this.value = 0
            } else {
                this.value = 1 
            }
        }
    }"
    @endif
>
    <label class="{{ $textClasses }}" for="{{ $id }}" id="{{ $id }}_label" @click="toggle()">
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
    <input type="hidden" name="{{ $name }}" :value="value">
    <x-tiffey::button-no-link
        x-ref="toggle"
        @click="toggle()"
        type="button"
        role="switch"
        x-bind:aria-checked="value"
        aria-labelledby="{{ $id }}_label"
        class="w-24  !p-1  mt-2 !block"
        x-bind:class="value ? '!text-right !bg-brand-mid' : '!text-left !bg-gray-500'"
    >
        <x-tiffey::button-no-link >
         <span x-text="value ? 'Y' : 'N'" aria-hidden="true""></span>
        </x-tiffey::button-no-link>
    </x-tiffey::button-no-link>
</div>