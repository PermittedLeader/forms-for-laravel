@props(['label', 'name'=>false,'hint'=>false, 'error'=>false])
@php
    if(!$name){
        $name = Str::snake($label);
    } else {
        $name = $name;
    }
    $fieldsetClasses = "flex flex-col mb-4 border-l-4 border-transparent";
    $legendClasses = "text-lg font-bold";
@endphp
@error($name)
    @php
        $fieldsetClasses .= " border-warning-mid pl-3";
        $textClasses = "";
        $legendClasses .= " text-warning-dark";
    @endphp
@enderror
<fieldset {{ $attributes->merge(['class'=>$fieldsetClasses]) }}>
    <div class="">
        <legend class="{{ $legendClasses }}">
            {{ $label }}
        </legend>
    </div>

    @if($hint)
        <x-tiffey::hint class="">{{ $hint }}</x-tiffey::hint>
    @endif
    @error($name)
        <x-tiffey::hint class="text-warning-dark">{{ $message }}</x-tiffey::hint>
    @enderror
    {{ $slot }}
</fieldset>
