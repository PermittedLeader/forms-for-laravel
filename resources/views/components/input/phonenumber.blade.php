@php
    if(!isset($country)||blank($country)){
        $country = config('DEFAULT_PHONE_REGION','GB');
    }
    if(!isset($number)){
        $number = "";
    }
@endphp
<div>
    <x-fieldset label="{{ $label }}" name="{{ $name }}">
        <div class="w-full flex flex-row divide-x-8 divide-transparent">
            <x-international-select selected="{{ old('country_code',$country) }}" label="{{ __('Country') }}" name="{{ $name }}_country" inBlock="true"/>
            <x-input type="text" label="{{ $label }}" inBlock="true" value="{{ old('phone_number',$number) }}"/>
        </div>
    </x-fieldset>
</div>