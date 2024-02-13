@if($method != "show")
    <x-input.select label="{{ $fieldObject->getLabel() }}" name="{{ $fieldObject->key }}" required="{{ $fieldObject->required }}">
        @foreach ($fieldObject->options as $option)
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
        @endforeach 
    </x-input.select>
@else
    <x-show.text 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif