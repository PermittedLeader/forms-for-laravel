@if($method != "show")
    <x-forms::input.checkbox 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        required="{{ $fieldObject->required }}"
        value="{{ old($fieldObject->key,$fieldObject->inputValue()) }}" />
@else
    <x-forms::show.boolean 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif