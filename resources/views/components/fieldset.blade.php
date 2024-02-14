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
        <x-forms::hint class="">{{ $hint }}</x-forms::hint>
    @endif
    @error($name)
        <x-forms::hint class="text-warning-700">{{ $message }}</x-forms::hint>
    @enderror
    {{ $slot }}
</fieldset>
