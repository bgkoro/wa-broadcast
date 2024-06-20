@props(['type' => 'primary', 'id' => '', 'dismissible' => true])
<div {{ $attributes->class(['bg-primary-100 text-primary-900'=> $type ==
    'primary', 'bg-secondary-100 text-secondary-900' => $type == 'secondary', 'bg-danger-100 text-danger-900' => $type
    ==
    'danger', 'bg-warning-100 text-warning-900' => $type == 'warning','bg-success-100 text-success-900' => $type ==
    'success','bg-light-100 text-light-900 dark:bg-dark-800 dark:text-dark-300' => $type == 'netral',
    ])->merge(['id' => $id, 'class' => 'flex p-4 rounded-lg']) }} role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
        viewBox="0 0 20 20">
        <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <div class="ms-3 text-sm font-medium">
        {{ $slot }}
    </div>
    @if ($dismissible)
    <button type="button" @class(['ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center
        justify-center h-8 w-8','bg-primary-100 text-primary-500 focus:ring-primary-400 hover:bg-primary-200'=> $type ==
        'primary','bg-secondary-100 text-secondary-500 focus:ring-secondary-400 hover:bg-secondary-200'=> $type ==
        'secondary', 'bg-danger-100 text-danger-500 focus:ring-danger-400 hover:bg-danger-200'=> $type ==
        'danger', 'bg-warning-100 text-warning-900 focus:ring-warning-400 hover:bg-warning-200'=> $type ==
        'warning','bg-success-100 text-success-900 focus:ring-success-400 hover:bg-success-200'=> $type ==
        'success','bg-light-100 dark:bg-dark-800 text-light-900 dark:text-dark-300 focus:ring-light-400
        hover:bg-light-200
        dark:hover:bg-dark-700'=> $type ==
        'netral',])
        data-dismiss-target="{{ '#' . $id }}" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
    @endif
</div>