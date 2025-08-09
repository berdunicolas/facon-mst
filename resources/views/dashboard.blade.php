<x-app-layout>
    <x-slot name="sectionName">
        {{__('Dashboard')}}
    </x-slot>

    <x-slot name="sectionId">{{__('dashboard')}}</x-slot>


<main class="container flex-grow-1 p-4">
    <header class="p-5">
        <h5 class="display-5 header-section">{{__('Welcome')}}, {{auth()->user()->name}}!</h5>
    </header>
</main>
</x-app-layout>