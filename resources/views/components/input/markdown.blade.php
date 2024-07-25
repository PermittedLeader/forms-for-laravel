@props(['type'=>'text','label','hint'=>false,'inBlock'=>false,'name'=>false, 'error'=>false,'id'=>false, 'required'=>false])
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
@push('styles')
@once
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
@endonce
@endpush
@push('scripts')
@once
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
@endonce
@endpush
<div class="{{ $divClasses }}">
    <label class="{{ $textClasses }}" for="{{ $id }}">
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
    <div 
        x-data="{ 
            value: $refs.editor.value, 
            init() {
                const easyMDE_{{ $id }} = new EasyMDE({
                    element: this.$refs.editor,
                    spellChecker: false,
                    nativeSpellCheck: true,
                    forceSync: true
                });
                easyMDE_{{ $id }}.codemirror.on('change',function(){
                    $refs.editor.dispatchEvent(new Event('input'));
                })
            },

        }"
        class="prose max-w-none"
        wire:ignore
    >
        <textarea x-ref="editor" x-model="value" id="{{ $id }}" name="{{ $name }}" {{ $attributes->whereDoesntStartWith('required') }}>{{ $slot }}</textarea>
    </div>
</div>