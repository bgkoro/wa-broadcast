@props(['href','title', 'isActive' => false])
<li>
    <a href="{{ $href }}" @class(['flex items-center w-full p-2 text-dark-900 transition duration-75 rounded-lg pl-11
        group hover:bg-dark-50 dark:text-light-50 dark:hover:bg-dark-700', 'bg-dark-50 dark:bg-dark-700'=> $isActive ==
        true])
        >{{
        $title }}</a>
</li>