@props(['sparator'=> 'false'])
<ul {{ $attributes->class(['border-t border-gray-200 dark:border-gray-700' => $sparator == 'true'])->merge(['class'
    =>'space-y-2 font-medium' ]) }}>
    {{ $slot }}
</ul>