<div>
    @if ($actionObject->gate)
        <x-tiffey::button href="{{ $actionObject->getRoute($this->method) }}">
            @if(!empty($actionObject->icon))
                <x-tiffey::icon icon="{{ $actionObject->icon }}" label="{{ $actionObject->getLabel() }}" />
            @endif
            {{ $actionObject->getLabel() }}
        </x-tiffey::button>
    @endif
</div>