@if($method != "show")
    <livewire:belongs-to-select-component label="{{ $fieldObject->getLabel() }}" name="{{ $fieldObject->key }}" required="{{ $fieldObject->required }}" fieldAttributes="{{ $attributes }}" model="{{ $fieldObject->model }}" :scope="$fieldObject->scope" :multiple="$fieldObject->multiple"/>
@else
    <x-forms::show.text 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif