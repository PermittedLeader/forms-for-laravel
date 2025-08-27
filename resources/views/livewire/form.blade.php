<div>
    @if ($this->method != "show")
    <form action="{{ $this->getRoute() }}" method="POST">
        @csrf
        @if ($this->method == "edit")
            @method($this->getFormMethod())
        @endif
    @endif
    <x-tiffey::card>
        <x-slot name="header">
            @if($method == "edit")
                @lang('forms::forms.methods.edit') {{ $this->getLabel() }}
            @elseif($method == "create")
                @lang('forms::forms.methods.create') {{ $this->getLabel() }}
            @elseif($method == "show")
                @lang('forms::forms.methods.show') {{ $this->getLabel() }}
            @endif
        </x-slot>
        <x-forms::partials.errors />
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
                <x-tiffey::form-button type="reset">Reset</x-tiffey::form-button>
                <x-tiffey::form-button type="submit" color="bg-brand-mid">Submit</x-tiffey::form-button>
                @endif
            </x-slot>
        @endif
    </x-tiffey::card>
    @if ($this->method != "show")
    </form>
    @endif
</div>