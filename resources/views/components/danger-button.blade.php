<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-danger rounded-1']) }}>
    {{ $slot }}
</button>
