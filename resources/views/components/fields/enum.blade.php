@if($method != "show")
    <x-forms::input.select label="{{ $fieldObject->getLabel() }}" name="{{ $fieldObject->key }}" required="{{ $fieldObject->required }}" {{ $attributes }}>
        @foreach ($fieldObject->options as $option)
            <option 
                value="{{ $option->value }}" 
                @if($method == "edit")
                    @selected(
                        old($fieldObject->key,$fieldObject->inputValue()) == $option->value
                    )
                @endif
                >
                @if(class_implements($option, \Permittedleader\Forms\Traits\Enums\DisplayString::class))
                    {{ $option->display() }}
                @else
                    {{ $option->value }}
                @endif
            </option>
        @endforeach 
    </x-forms::input.select>
@else
    <x-forms::show.text 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif