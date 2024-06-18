@if($method != "show")
    <x-tiffey::input.date-time label="{{ $fieldObject->getLabel() }}" name="{{ $fieldObject->key }}" required="{{ $fieldObject->required }}" />
@else
    <x-forms::show.text
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif