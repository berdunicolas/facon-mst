<x-app-layout>
    <x-slot name="sectionName">
        {{__('Team settings')}}
    </x-slot>

    <x-slot name="sectionId">teams</x-slot>
    
    <main class="container flex-grow-1 p-4">
        <header class="py-5">
            <h5 class="display-5 header-section">{{__('Team settings')}}</h5>
        </header>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                @livewire('teams.update-team-name-form', ['team' => $team])
                @livewire('teams.team-member-manager', ['team' => $team])
                
                @if (Gate::check('delete', $team) && ! $team->personal_team)

                <div class="mt-5">
                    
                @livewire('teams.delete-team-form', ['team' => $team])
                </div>
                @endif
            </div>
        </div>
    </main>

</x-app-layout>
