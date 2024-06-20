<button {{ $attributes->merge(['class' => 'text-dark-700 hover:text-dark-900 hover:bg-dark-100
    dark:text-dark-300 dark:hover:text-light-50 dark:hover:bg-dark-700 focus:ring-4 focus:ring-dark-300
    dark:focus:ring-dark-600', 'type'=> 'button']) }}>
    {{ $slot }}
</button>