@if($method != "show")
    <x-forms::input.markdown 
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        required="{{ $fieldObject->required }}"
        {{ $attributes }}
        >
        {{ old($fieldObject->key,$fieldObject->inputValue()) }}
    </x-forms::input.markdown>
@else
    <x-forms::show.markdown
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        value="{{  $fieldObject->showValue() }}"
        />
@endif