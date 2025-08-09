<div {{ $attributes->merge(['class' => 'bg-light rounded-4 shadow']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="">
        <div class="px-4 py-5">
            {{ $content }}
        </div>
    </div>
</div>