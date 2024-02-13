@if ($errors->any())
    <x-laraforms::alert level="warning">
        <x-slot name="header">
            {{ __('Whoops! Something went wrong.') }}
        </x-slot>
        @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
    </x-laraforms::alert>
@endif
