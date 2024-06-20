@props(['type' => 'button', 'href'])
@if (isset($href))
<a {{ $attributes->merge(['type' => $type, 'href' => $href, 'class' => 'w-full text-left py-2 px-4 text-sm
    hover:text-dark-900
    hover:bg-light-100 dark:hover:bg-dark-800 dark:hover:text-light-50']) }}>{{ $slot }}</a>
@else
<button {{ $attributes->merge(['type' => $type, 'class' => 'w-full text-left py-2 px-4 text-sm hover:text-dark-900
    hover:bg-light-100 dark:hover:bg-dark-800 dark:hover:text-light-50']) }}
    >{{ $slot }}
</button>
@endif