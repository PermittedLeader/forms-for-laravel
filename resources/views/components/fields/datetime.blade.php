@if($method != "show")
    <x-forms::input.date-time 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        required="{{ $fieldObject->required }}" 
        type="{{ $fieldObject->type }}"
        value="{{ $fieldObject->value }}"
        {{ $attributes }}
        />
@else
    <x-forms::show.text
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif