@props(['href' => '#','isActive' => false])
<li class="me-2">
    <a {{ $attributes->class([$isActive == true ? 'text-primary-600
        border-primary-600 dark:text-primary-500 dark:border-primary-500' : 'border-transparent hover:text-dark-600
        hover:border-dark-300 dark:hover:text-dark-300'])->merge(['class'=>'inline-block p-4 border-b-2
        rounded-t-lg','href' => $href]) }} >{{ $slot }}</a>
</li>