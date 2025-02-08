@if($method != "show")
    @php
        $fieldname = $fieldObject->key;
        $countryFieldName = $fieldname."_country";
    @endphp
    <x-forms::input.phonenumber
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        required="{{ $fieldObject->required }}"
        number="{{ old($fieldObject->key,$fieldObject->inputValue()?->formatNational()) }}"
        country="{{ old($countryFieldName,$fieldObject->inputValue()?->getCountry()) }}" 
        {{ $attributes }}/>
@else
<x-forms::show.text 
    label="{{ $fieldObject->getLabel() }}" 
    name="{{ $fieldObject->key }}" 
    value="{{  $fieldObject->showValue() }}"
    />
@endif