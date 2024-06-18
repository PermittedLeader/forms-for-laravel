@push('styles')
<x-flatpickr::style />
@endpush

@push('scripts')
<x-flatpickr::script />
@endpush

<x-forms::fieldset label="{{ $label }}" name="{{ $name }}" {{ $attributes }}>
    <div id="{{ $containerId() }}" class="flatpickr-container">
        <input
            type="text"
            id="{{ $id }}"
            {{ $attributes->class(['flatpickr-input']) }}
            data-selector-id="{{ $selectorId() }}"
            data-config='@json($config())'
            data-disable-weekend="{{ $disableWeekend?1:0 }}"
            data-first-day-of-week="{{ $firstDayOfWeek }}"
            data-locale="{{ config('flatpickr.locale', 'default') }}"
            data-input
        />
    
        @if($clearable)
            <a id="{{ $id }}-clearable" title="clear" class="flatpickr-clearable" data-clear>
                {{ $clearer ?? $defaultClearer() }}
            </a>
        @endif
    </div>
</x-forms::fieldset>