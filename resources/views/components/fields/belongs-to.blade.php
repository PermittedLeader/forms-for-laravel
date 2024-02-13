@if($method != "show")
    <x-laraforms::input.select label="{{ $fieldObject->getLabel() }}" name="{{ $fieldObject->key }}" required="{{ $fieldObject->required }}">
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
    </x-laraforms::input.select>
@else
    <x-laraforms::show.text 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif