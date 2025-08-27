@if($errors->any())
    <x-tiffey::alert level="warning">
        <x-slot name="header">
            {{ __('forms::forms.errors.has_errors') }}
        </x-slot>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </x-tiffey::alert>
@endif