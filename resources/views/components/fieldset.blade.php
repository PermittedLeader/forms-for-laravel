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
        $fieldsetClasses .= " border-warning-500 pl-3";
        $textClasses = "";
        $legendClasses .= " text-warning-700";
    @endphp
@enderror
<fieldset {{ $attributes->merge(['class'=>$fieldsetClasses]) }}>
    <div class="">
        <legend class="{{ $legendClasses }}">
            {{ $label }}
        </legend>
    </div>

    @if($hint)
        <x-hint class="">{{ $hint }}</x-hint>
    @endif
    @error($name)
        <x-hint class="text-warning-700">{{ $message }}</x-hint>
    @enderror
    {{ $slot }}
</fieldset>
