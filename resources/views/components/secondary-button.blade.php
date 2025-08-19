<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-secondary rounded-1']) }}>
    {{ $slot }}
</button>
