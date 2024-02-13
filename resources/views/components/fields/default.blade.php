@if($method != "show")
    <x-input 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        required="{{ $fieldObject->required }}"
        value="{{ old($fieldObject->key,$fieldObject->inputValue()) }}" />
@else
    <x-show.text 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif