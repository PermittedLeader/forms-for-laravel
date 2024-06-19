@props(['label','name'=>false,'id'=>false, 'required'=>false])
@php
    if(!$name){
        $name = Str::camel($label);
    }
    if(!$id){
        $id= Str::snake(preg_replace('/[^A-Za-z0-9_]/',' ',$name));
    }
@endphp
@push('styles')
@once
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
@endonce
@endpush
@push('scripts')
@once
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
@endonce
<script>
    const easyMDE_{{ $id }} = new EasyMDE({
        element: document.getElementById('{{ $id }}'),
        spellChecker: false,
        nativeSpellCheck: true,
        forceSync: true
    });
    easyMDE_{{ $id }}.codemirror.on('change',function(){
        document.getElementById('{{ $id }}').dispatchEvent(new Event('input'));
    })
    @if($required)
    document.getElementById('{{ $id }}').setAttribute('required', false);
    @endif
</script>
@endpush
<x-tiffey::input.textarea label="{{ $label }}" {{ $attributes }} name="{{ $name }}" id="{{ $id }}" required="{{ $required }}">
    {{ $slot }}
</x-tiffey::input.textarea>