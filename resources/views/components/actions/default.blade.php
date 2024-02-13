<div>
    <x-laraforms::button href="{{ $actionObject->getRoute($this->method) }}">
        @if(!empty($actionObject->icon))
            <x-laraforms::icon icon="{{ $actionObject->icon }}" label="{{ $actionObject->getLabel() }}" />
        @endif
        {{ $actionObject->getLabel() }}
    </x-laraforms::button>
</div>