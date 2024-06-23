@push('styles')
@once
<link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.css" rel="stylesheet" />
@endonce
@endpush

@push('scripts')
@once
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>
<script>
    window.LaravelFlatpickr={__supportedEventNames:["onChange","onOpen","onClose","onMonthChange","onYearChange","onReady","onValueUpdate","onDayCreate"],initializeFlatpickr:function(e){flatpickr(document.getElementById(e.getAttribute("data-selector-id")),this.__config(e))},__config:function(e){let t=JSON.parse(e.getAttribute("data-config")),a="1"===e.getAttribute("data-disable-weekend");a&&t.disable.push(this.__disableWeekends());let i=e.getAttribute("data-locale"),n=Number(e.getAttribute("data-first-day-of-week")),r=flatpickr.l10ns[i]||{};return{...t,locale:{...r,firstDayOfWeek:n},...this.__events(e)}},__disableWeekends:function(){return function(e){return 0===e.getDay()||6===e.getDay()}},__events:function(el){let elEvents;return el.getAttributeNames().filter(e=>e.startsWith("on")).reduce((obj,elEventName)=>{let eventName=this.__supportedEventNames.find(e=>e.toLowerCase()===elEventName);return eventName&&(obj[eventName]=function(...params){eval(el.getAttribute(eventName))(...params)}),obj},{})}},document.addEventListener("DOMContentLoaded",function(e){document.querySelectorAll(".flatpickr-input").forEach(e=>window.LaravelFlatpickr.initializeFlatpickr(e))});var observer=new MutationObserver(e=>{e.forEach(e=>{e.removedNodes.length>0&&window.LaravelFlatpickr.initializeFlatpickr(e.previousSibling)})});document.querySelectorAll(".flatpickr-container").forEach(e=>{observer.observe(e,{childList:!0})});
</script>
@endonce
@endpush

@error($name)
    @php
        $divClasses .= " border-warning-mid pl-3";
        $textClasses .= " text-warning-dark";
        $fieldClasses .= " border-warning-mid";
    @endphp
@enderror

<div class="{{ $divClasses }}" id="{{ $containerId() }}">
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
    <div class="flex flex-row gap-2">
        <div class="grow">
            <input 
                type="{{ $type }}" 
                {{ $attributes->merge(['class'=>$fieldClasses]) }} 
                name="{{ $name }}" 
                id="{{ $id }}" 
                @required($required)
                data-selector-id="{{ $selectorId() }}"
                data-config='@json($config())'
                data-disable-weekend="{{ $disableWeekend?1:0 }}"
                data-first-day-of-week="{{ $firstDayOfWeek }}"
                data-locale="{{ config('flatpickr.locale', 'default') }}"
                data-input
                /> 
        </div>
        @if($clearable)
        <div class="my-auto px-2">
            <x-tiffey::button id="{{ $id }}-clearable" title="clear" class="h-full" data-clear>
                <x-tiffey::icon.close />
            </x-tiffey::button>
        </div>
        @endif
    </div>
</div>