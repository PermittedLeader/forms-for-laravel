@if ($errors->any())
    <x-tiffey::alert level="warning">
        <x-slot name="header">
            {{ __('forms::forms.errors.whoops') }}
        </x-slot>
        @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
    </x-tiffey::alert>
@endif
