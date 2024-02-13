<div>
    @if ($this->method != "show")
    <form action="{{ $this->getRoute() }}" method="POST">
        @csrf
        @if ($this->method == "edit")
            @method($this->getFormMethod())
        @endif
    @endif
    <x-laraforms::card>
        <x-slot name="header">
            @if($method == "edit")
                @lang('Edit') {{ $this->getLabel() }}
            @elseif($method == "create")
                @lang('Create') {{ $this->getLabel() }}
            @elseif($method == "show")
                @lang('Show') {{ $this->getLabel() }}
            @endif
        </x-slot>
        @if($errors->any())
            <x-laraforms::alert level="warning">
                <x-slot name="header">
                    {{ __('You have errors in your form') }}
                </x-slot>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </x-alert>
        @endif
        @if($this->method == "edit")
            @foreach ($this->fieldsForEdit() as $field)
                {{ $field->renderForEditing() }}
            @endforeach
        @elseif($this->method == "create")
            @foreach ($this->fieldsForCreate() as $field)
                {{ $field->renderForEditing() }}
            @endforeach
        @else
            <div class="grid grid-flow-row-dense grid-cols-1 md:grid-cols-3 gap-2 ">
                @foreach ($this->fieldsForShow() as $field)
                    <div class="md:col-span-{{ $field->columnSpan }}">
                        {{ $field->renderForShow() }}
                    </div>
                @endforeach
            </div>
        @endif
        @if ($this->method != "show"||!empty($this->actions()))
            <x-slot name="footerActions">
                @foreach ($this->actionsFor($method) as $action)
                    {{ $action->render() }}
                @endforeach
                @if ($this->method != "show")
                <x-laraforms::form-button type="reset">Reset</x-form-button>
                <x-laraforms::form-button type="submit" color="bg-brand-500">Submit</x-form-button>
                @endif
            </x-slot>
        @endif
    </x-card>
    @if ($this->method != "show")
    </form>
    @endif
</div>