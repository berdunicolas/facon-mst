<div class="pt-4 px-4 d-flex justify-content-between">
    <div class="">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $title }}</h3>

        <p class="mt-1">
            {{ $description }}
        </p>
    </div>

    <div class="">
        {{ $aside ?? '' }}
    </div>
</div>
