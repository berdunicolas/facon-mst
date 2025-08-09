<x-app-layout>
    <x-slot name="sectionName">
        {{__('Profile')}}
    </x-slot>

    <x-slot name="sectionId">profile</x-slot>

    <main class="container flex-grow-1 p-4">
        <header class="p-5">
            <h5 class="display-5 header-section">Perfil</h5>
        </header>
        <div class="mx-auto">
        
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
            @endif
            
    
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-5">
            @livewire('profile.update-password-form')
            </div>    
            @endif
        
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mt-5">
            @livewire('profile.two-factor-authentication-form')
            </div>
            @endif

            <div class="mt-5">
            @livewire('profile.logout-other-browser-sessions-form')
            </div>
        

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div class="mt-5">
                @livewire('profile.delete-user-form')
            </div>
            @endif
        </div>
    </main>

</x-app-layout>
