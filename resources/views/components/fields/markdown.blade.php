@if($method != "show")
    <x-laraforms::input.markdown 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        required="{{ $fieldObject->required }}"
        >
        {{ old($fieldObject->key,$fieldObject->inputValue()) }}
    </x-laraforms::input.markdown>
@else
    <x-laraforms::show.markdown
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif