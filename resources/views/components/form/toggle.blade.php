@props(['label' =>'', 'value' => ''])
<label class="relative inline-flex items-center cursor-pointer">
    <input {{ $attributes->merge(['type' => 'checkbox','class' => 'sr-only peer
    needs-validation'])
    }} @checked($value)>
    <div
        class="w-11 h-6 bg-light-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-dark-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-light-50 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-light-50 after:border-light-100 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-dark-600 peer-checked:bg-primary-600">
    </div>
    @empty(!$label)
    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $label }}</span>
    @endempty
</label>