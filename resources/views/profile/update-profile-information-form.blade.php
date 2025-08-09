<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <div class="row">
            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="col-12 col-sm-4">
                    <!-- Current Profile Photo -->
                    <div class="mt-2 text-center" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="w-50">
                    </div>
    
                    <!-- Profile Photo File Input -->
                    <input type="file" id="photo" class="visually-hidden"
                    wire:model.live="photo"
                    x-ref="photo"
                    x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                    " />
                    
                    <div class="w-100 mt-2 d-flex justify-content-center">
                        <x-secondary-button class="btn btn-sm btn-light " type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Change photo') }}
                        </x-secondary-button>
                    </div>
    
                    @if ($this->user->profile_photo_path)
                        <x-secondary-button type="button" class="mt-2 btn btn-outline-danger" wire:click="deleteProfilePhoto">
                            {{ __('Remove Photo') }}
                        </x-secondary-button>
                    @endif
    
                    <x-input-error for="photo" class="mt-2" />
                </div>
            @endif
    
            <div class="col-12 col-sm-8">
                <!-- Name -->
                <div >
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" type="text" class="mt-1 w-100" wire:model="state.name" required autocomplete="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>
        
                <!-- Email -->
                <div >
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" type="email" class="mt-1 w-100" wire:model="state.email" required autocomplete="username" />
                    <x-input-error for="email" class="mt-2" />
        
                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                        <p class="mt-2 text-end">
                            {{ __('Your email address is unverified.') }}
        
                            <button type="button" class="btn btn-sm btn-outline-primary" wire:click.prevent="sendEmailVerification">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
        
                        @if ($this->verificationLinkSent)
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo" class="btn btn-primary">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
