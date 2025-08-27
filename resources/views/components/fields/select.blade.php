@if($method != "show")
    <x-forms::input.select label="{{ $fieldObject->getLabel() }}" name="{{ $fieldObject->key }}" required="{{ $fieldObject->required }}" {{ $attributes }}>
        @foreach ($fieldObject->options as $key => $option)
            
            <option hidden disabled selected value> -- {{__('forms::forms.select.default') }} -- </option>

            @if(is_object($option))
            <option 
                value="{{ $option->{$fieldObject->keyAttribute} }}" 
                @if($method == "edit")
                    @selected(
                        old($fieldObject->key,$fieldObject->inputValue()) == $option->{$fieldObject->keyAttribute}
                    )
                @endif
            >
                {{ $option->{$fieldObject->displayAttribute} }}
            </option>
            @else
            <option 
                value="{{ $key }}" 
                @if($method == "edit")
                    @selected(
                        old($fieldObject->key,$fieldObject->inputValue()) == $option
                    )
                @endif
            >
                {{ $option }}
            </option>
            @endif
            
        @endforeach 
    </x-forms::input.select>
@else
    <x-forms::show.text 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif