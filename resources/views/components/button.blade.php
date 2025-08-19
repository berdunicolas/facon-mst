<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn rounded-1']) }}>
    {{ $slot }}
</button>
