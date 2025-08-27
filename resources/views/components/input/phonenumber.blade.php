@php
    if(!isset($country)||blank($country)){
        $country = config('DEFAULT_PHONE_REGION','GB');
    }
    if(!isset($number)){
        $number = "";
    }
@endphp
<div>
    <x-forms::fieldset label="{{ $label }}" name="{{ $name }}">
        <div class="w-full flex flex-row divide-x-8 divide-transparent">
            <x-forms::international-select selected="{{ old('country_code',$country) }}" label="{{ __('forms::forms.phone_number.country') }}" name="{{ $name }}_country" inBlock="true"/>
            <x-forms::input type="text" label="{{ $label }}" inBlock="true" value="{{ old('phone_number',$number) }}"/>
        </div>
    </x-forms::fieldset>
</div>