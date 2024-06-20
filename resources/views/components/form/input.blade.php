@props(['containerClass' => ''])

<div class="relative {{ $containerClass }}">

     @isset($prefixIcon)
     <div
          class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-dark-500 dark:text-dark-400">
          {{ $prefixIcon }}
     </div>
     @endisset

     <input {{ $attributes->class([$errors->has($attributes->get('name')) ? 'border-danger-500
     bg-danger-50 focus:border-danger-600
     focus:ring-danger-600' : 'bg-light-50 border-dark-300 dark:border-dark-600
     focus:border-primary-600 dark:focus:border-primary-500 focus:ring-primary-600 dark:focus:ring-primary-500
     text-dark-900','ps-10' => isset($prefixIcon), 'pe-10'
     => isset($suffixIcon)])->merge(['class'=>'needs-validation border-2 sm:text-sm rounded-lg
     block w-full p-2.5 dark:placeholder-dark-400 dark:text-light-50 dark:bg-dark-900 disabled:bg-light-100
     dark:disabled:bg-dark-800']) }}>

     @isset($suffixIcon)
     <div
          class="absolute z-10 inset-y-0 end-0 flex items-center pe-3.5 pointer-events-none text-dark-500 dark:text-dark-400">
          {{$suffixIcon}}
     </div>
     @endisset

</div>