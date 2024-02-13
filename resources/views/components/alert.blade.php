<div x-data="{open: true}" class="border-solid rounded-sm {{ $componentData->classes }}" x-show="open" x-transition:leave="transition ease-in-out duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-0" role="alert">
    <div class="flex flex-row">
        <div class="flex-grow">
            <div class="flex flex-col h-full">
                @if (isset($header))
                <h5 class="font-bold">
                    {{ ucfirst($header) }}
                </h5>
                @endif
                
                <div class="my-auto">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @if (isset($actions))
            <div class="text-right mx-2 place-self-center">
                {{ $actions }}
            </div>
        @endif
        <div class="text-right">
            <div class="flex h-full justify-end">
                <div class="my-auto text-right">
                    <x-icon icon="{{ $icon }}" label="{{ $level }}" />
                </div>
                @if($componentData->dismissable)
                <div class="ml-3" x-on:click='open = !open' role="button">
                    <span class="cursor-pointer">
                        <svg class="h-3 w-3 rounded-sm {{ $componentData->buttonStyle }} hover:bg-opacity-75 hover:shadow-inner" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span class="sr-only">{{ __('Close') }}</span>
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
