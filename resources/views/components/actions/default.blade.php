<div>
    <x-button href="{{ $actionObject->getRoute($this->method) }}">
        @if(!empty($actionObject->icon))
            <x-icon icon="{{ $actionObject->icon }}" label="{{ $actionObject->getLabel() }}" />
        @endif
        {{ $actionObject->getLabel() }}
    </x-button>
</div>