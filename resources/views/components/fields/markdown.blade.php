@if($method != "show")
    <x-input.markdown 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        required="{{ $fieldObject->required }}"
        >
        {{ old($fieldObject->key,$fieldObject->inputValue()) }}
    </x-input.markdown>
@else
    <x-show.markdown
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif