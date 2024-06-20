@props(['href','title', 'isActive' => false])
<li>
    <a href="{{ $href }}" @class([ 'flex items-center p-2 rounded-lg hover:text-dark-900 hover:bg-dark-50 transition duration-75 
        dark:hover:bg-dark-700 dark:hover:text-light-50 group' , $isActive==true
        ? 'text-dark-900 bg-dark-50 dark:text-light-50 dark:bg-dark-700' : 'text-dark-800  dark:text-light-100' ])>
        @if (isset($icon))
        {{ $icon }}
        @endif
        <span class="flex-1 ms-3 whitespace-nowrap truncate">{{ $title }}</span>
        @if (isset($badge))
        {{ $badge }}
        @endif
    </a>
</li>