@if($method != "show")
    <x-forms::input 
        type="hidden"
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        required="{{ $fieldObject->required }}"
        value="{{ $fieldObject->inputValue() }}"
        {{ $attributes }} />
@endif