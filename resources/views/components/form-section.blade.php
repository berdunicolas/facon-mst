@props(['submit'])

<div class="bg-light rounded-1 shadow">
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="">
        <form wire:submit="{{ $submit }}">
            <div class="px-4 py-4 {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end text-end px-4 pb-4">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
