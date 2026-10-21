<div 
    x-data="dateTimePicker({
        hasDate: @js($hasDate()),
        hasTime: @js($hasTime()),
        hiddenInputRef: '{{ $name }}value'
    })"
>
    <div x-effect="initSync()"></div>


    <x-forms::fieldset
        label="{{ $label }}"
        hint="{{ $hint }}"
        required="{{ $required }}"
        error="{{ $error }}"
    >
        <div class="flex flex-row gap-4">
            @if ($hasDate())
                <div>
                    <flux:date-picker
                        type="input"
                        locale="en-GB"
                        ::value="dateValue"
                        x-on:change="onDateChange($event)"
                    />
                </div>
            @endif

            @if ($hasTime())
                <div>
                    <flux:time-picker
                        type="input"
                        time-format="24-hour"
                        open-to="now"
                        locale="en-GB"
                        ::value="timeValue"
                        x-on:change="onTimeChange($event)"
                    />
                </div>
            @endif
        </div>

        <input
            class="hidden"
            x-ref="{{ $name }}value"
            x-model.fill="value"
            x-on:input="syncTextToPickers($event.target.value)"
            name="{{ $name }}"
            {{ $attributes->whereStartsWith(['wire:model', 'value']) }}
            @unless ($attributes->has(['wire:model','value']))
                value="{{ $value }}"
            @else 
            {{ $attributes->whereStartsWith(['wire:model', 'value']) }}
            @endunless
            
        />
    </x-forms::fieldset>
</div>