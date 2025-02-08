@if($method != "show")
    <x-forms::input.select label="{{ $fieldObject->getLabel() }}" name="{{ $fieldObject->key }}" required="{{ $fieldObject->required }}" {{ $attributes }}>
        @foreach ($fieldObject->options as $optionKey => $option)
            <option 
                value="{{ is_object($option) ? $option->{$fieldObject->keyAttribute} : $optionKey }}" 
                @if($method == "edit")
                    @selected(
                        old($fieldObject->key,$fieldObject->inputValue()) == (is_object($option) ? $option->{$fieldObject->keyAttribute} : $optionKey)
                    )
                @endif
                
                >
                {{ is_object($option) ? $option->{$fieldObject->displayAttribute} : $option  }}
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