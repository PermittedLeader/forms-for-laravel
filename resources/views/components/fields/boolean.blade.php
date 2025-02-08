@if($method != "show")
    <x-forms::input.toggle
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        required="{{ $fieldObject->required }}"
        value="{{ old($fieldObject->key,$fieldObject->inputValue()) }}"
        {{ $attributes }} />
@else
    <x-forms::show.boolean 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() ? true : false }}"
        />
@endif