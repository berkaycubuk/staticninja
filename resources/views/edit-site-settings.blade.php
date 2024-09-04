<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    <x-filament::section>
        <x-slot name="heading">
            Domain Settings
        </x-slot>

        <div class="flex flex-col gap-4">
            <x-filament::input.wrapper>
                <x-filament::input type="text" value="{{ $domain }}" disabled />
            </x-filament::input.wrapper>

            @if($show_custom_domain)
            Custom domain:

            <x-filament::input.wrapper>
                <x-filament::input type="text" wire:model="custom_domain" />
            </x-filament::input.wrapper>

            @if($custom_domain == '')
            <div>
                <x-filament::button wire:click="add_custom_domain">
                    Save domain
                </x-filament::button>
            </div>
            @endif

            <p>You need to add an <span class="font-mono p-1">A</span> record that points to <span class="font-mono p-1">139.162.164.171</span> address.</p>
            @endif

            @if($ssl_active)
            <div>
                <x-filament::button color="success" icon="heroicon-m-lock-closed" disabled>
                    SSL is active
                </x-filament::button>
            </div>
            @else
                @if($ssl_loading)
                <div>
                    <x-filament::button color="info" icon="heroicon-m-arrow-path" tooltip="This can take up to 24 hours.">
                        Initiating SSL
                    </x-filament::button>
                </div>
                @else
                <div>
                    <x-filament::button color="success" icon="heroicon-m-lock-open" wire:click="initiate_ssl">
                        Initiate SSL
                    </x-filament::button>
                </div>
                @endif
            @endif
        </div>
    </x-filament::section>

    @if (count($relationManagers = $this->getRelationManagers()))
        <x-filament-panels::resources.relation-managers
            :active-manager="$this->activeRelationManager"
            :managers="$relationManagers"
            :owner-record="$record"
            :page-class="static::class"
        />
    @endif
</x-filament-panels::page>
