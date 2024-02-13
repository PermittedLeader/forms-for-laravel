@if($method != "show")
    @php
        $fieldname = $fieldObject->key;
        $countryFieldName = $fieldname."_country";
    @endphp
    <x-laraforms::input.phonenumber
        label="{{ $fieldObject->getLabel() }}" 
        name="{{ $fieldObject->key }}" 
        required="{{ $fieldObject->required }}"
        number="{{ old($fieldObject->key,$fieldObject->inputValue()?->formatNational()) }}"
        country="{{ old($countryFieldName,$fieldObject->inputValue()?->getCountry()) }}" />
@else
<x-laraforms::show.text 
    label="{{ $fieldObject->getLabel() }}" 
    name="{{ $fieldObject->key }}" 
    value="{{  $fieldObject->showValue() }}"
    />
@endif