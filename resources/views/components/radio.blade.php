@props(['label','hint'=>false,'name'])
@php
$randId = $name.bin2hex(random_bytes(2));
@endphp
<div class="flex flex-row items-center">
    <input type="radio" id="{{ $randId }}" name="{{ $name }}" {{ $attributes->merge(['class'=>'my-2 mr-3 p-2']) }}>
    <label class="font-bold" for="{{ $randId }}">
        {{ $label }}
        @if($hint)
            <x-hint class="ml-2">{{ $hint }}</x-hint>
        @endif
    </label>

</div>
