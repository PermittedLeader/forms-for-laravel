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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<script>
    const easyMDE = new EasyMDE({
        element: document.getElementById('{{ $id }}'),
        spellChecker: false,
        nativeSpellCheck: true,
        forceSync: true
    });
    easyMDE.codemirror.on('change',function(){
        document.getElementById('{{ $id }}').dispatchEvent(new Event('input'));
    })
</script>
@endpush
<x-tiffey::input.textarea label="{{ $label }}" {{ $attributes }} name="{{ $name }}" id="{{ $id }}" required="{{ $required }}">
    {{ $slot }}
</x-tiffey::input.textarea>