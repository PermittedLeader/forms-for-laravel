<div>
    <x-forms::fieldset label="{{ $label }}" name="{{ $name }}">
    <div class="flex flex-row gap-2">
        <div class="flex-grow">
            <x-tiffey::input disabled label="{{ $label }}" name="{{ $name }}_display" required="{{ $required }}" inBlock="true" wire:model="selectedDisplay" />
        </div>
        <div class="">
            <x-tiffey::modal x-model="$wire.modalOpen">
                <x-slot:header>
                    {{ __('forms::forms.select.select') }} {{ $label }}
                </x-slot:header>
                <x-slot:button>
                    <div class="pt-1">
                        <x-tiffey::button-no-link>
                            <x-tiffey::icon icon="fa-solid fa-hand-pointer" label="Select"/>    
                            {{ __('tables::tables.select.select') }}
                        </x-tiffey::button-no-link>
                    </div>
                    
                </x-slot:button>
                <livewire:select-table :$model :$scope :$multiple />
            </x-tiffey::modal>
        </div>
        
        <input type="hidden" name="{{ $name }}" wire:model="selectedIds" />
    </div>
    </x-forms::fieldset>
</div>
