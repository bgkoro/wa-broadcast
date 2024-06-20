@props(['title','subTitle'])
<header {{ $attributes }}>
    <h2 class="text-lg font-medium text-dark-900 dark:text-dark-100">{{ $title }}</h2>
    @isset($subTitle)
    <p class="mt-1 text-sm text-dark-600 dark:text-dark-400">
        {{ $subTitle }}
    </p>
    @endisset
</header>