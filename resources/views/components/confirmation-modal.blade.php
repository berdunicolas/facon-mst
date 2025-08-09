@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-4 pt-4 pb-4">
        <div class="d-flex align-items-start">
            <div class="mx-auto d-flex align-items-center justify-content-center rounded-circle bg-danger mx-0">
                <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>

            <div class="mt-3 mt-0 ms-4 text-start">
                <h3 class="">
                    {{ $title }}
                </h3>

                <small class="mt-4 ">
                    {{ $content }}
                </small>
            </div>
        </div>
    </div>

    <div class="d-flex flex-row justify-content-end px-6 py-4 text-end">
        {{ $footer }}
    </div>
</x-modal>
