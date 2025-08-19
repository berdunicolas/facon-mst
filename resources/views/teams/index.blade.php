<x-app-layout>
    <x-slot name="sectionName">
        {{__('Teams')}}
    </x-slot>

    <x-slot name="sectionId">teams</x-slot>
    
    <main class="container flex-grow-1 p-4">
        <header class="py-5">
            <h5 class="display-5 header-section">{{__('Teams')}}</h5>
        </header>

        <x-action-section>
            <x-slot name="title">
                {{ __('Your teams') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Manage your teams.') }}
            </x-slot>

            <x-slot name="content">
                <div class="list-group">
                    @foreach ($teams as $team)
                    <a href="{{route('teams.show', $team->id)}}" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$team->name}}</h5>
                            <small>{{__('Created at')}} {{$team->created_at->format('d/m/Y')}}</small>
                        </div>
                        <p class="mb-1">{{__('Created by') . ': ' . $team->owner->name}}</p>
                        <small>{{__('Members') . ': ' . $team->personal_team}}</small>
                    </a>
                    @endforeach
                </div>
            </x-slot>
        </x-action-section>
    </main>

</x-app-layout>
