@props(['noPadding'=>false,'open'=>true,'collapsible'=>false, 'inModal'=>false])
@php
if($noPadding){
    $classes = '';
} else {
    $classes = 'py-2 px-3 grow';
}
@endphp
<div class="{{ $inModal ? '' : 'mt-2 shadow-xl dark:shadow-none dark:border-2 dark:border-gray-700  mb-4' }} rounded-b-sm border-t-4 dark:border-t-4 flex flex-col" x-data="{ cardShow: {{ $open == "true" ? "true" : "false" }} }">
    @if(isset($header)||isset($actions))
        <div class="bg-white dark:bg-gray-800 py-1 px-3 rounded-t-sm border-b flex flex-col md:flex-row justify-between" 
        @if($collapsible)
            @click="cardShow = !cardShow"
        @endif>
            @if (isset($header))
            <div class="my-auto">
                <h3 class="text-lg font-bold">
                    @if($collapsible)
                        <i class="mr-2 fas" :class="cardShow ? 'fa-chevron-down' : 'fa-chevron-right'" aria-hidden="true"></i>
                        <span class="fa-sr-only">Show/Hide</span>
                    @endif
                    {{ $header }}
                </h3>
                @if (isset($subtitle))
                    <div class="text-sm">
                        {{ $subtitle }}
                    </div>
                    
                @endif
            </div>
            @endif
            @if(isset($actions))
                <div class="flex flex-row gap-2 my-auto" x-show="cardShow" @click.stop >
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif
    <div class="bg-white dark:bg-gray-800 dark:text-white {{ $classes }}" x-show="cardShow">
        {{ $slot }}
    </div>
    @if(isset($footerActions))
    <div class="bg-white dark:bg-gray-800 py-1 px-1 rounded-b-sm border-t flex flex-col md:flex-row justify-end gap-2" x-show="cardShow">
        {{ $footerActions }}
    </div>
    @endif
</div>