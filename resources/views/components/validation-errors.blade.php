@if ($errors->any())
    <x-alert level="warning">
        <x-slot name="header">
            {{ __('Whoops! Something went wrong.') }}
        </x-slot>
        @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
    </x-alert>
@endif
