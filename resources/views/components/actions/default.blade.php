<div>
    <x-forms::button href="{{ $actionObject->getRoute($this->method) }}">
        @if(!empty($actionObject->icon))
            <x-forms::icon icon="{{ $actionObject->icon }}" label="{{ $actionObject->getLabel() }}" />
        @endif
        {{ $actionObject->getLabel() }}
    </x-forms::button>
</div>