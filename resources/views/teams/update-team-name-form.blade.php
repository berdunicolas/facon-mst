<x-form-section submit="updateTeamName">
    <x-slot name="title">
        {{ __('Team Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The team\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="d-flex flex-row flex-wrap">
            {{--
            <div class="me-4 mb-4">
                <x-label value="{{ __('Team Owner') }}" />
    
                <div class="d-flex flex-column mt-2">
                    <img src="{{ $team->owner->profile_photo_url }}" alt="{{ $team->owner->name }}">
    
                    <div class="">
                        <div class="text-secondary">{{ $team->owner->name }}</div>
                        <small class="text-secondary">{{ $team->owner->email }}</small>
                    </div>
                </div>
            </div>
            --}}
            <!-- Team Name -->
            <div class="flex-grow-1">
                <div class="form-floating mb-3">
                    <x-input id="name"
                                type="text"
                                class="mt-1 form-control-lg d-block w-100"
                                wire:model="state.name"
                                :disabled="! Gate::check('update', $team)" />
                    <x-label for="name" value="{{ __('Team Name') }}" />
                </div>
    
    
                <x-input-error for="name" class="mt-2" />
            </div>
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
        <x-slot name="actions">
            <x-button class="btn-primary">
                {{ __('Save') }}
            </x-button>

            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>
        </x-slot>
    @endif
</x-form-section>
