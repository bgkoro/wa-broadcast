@props(['id', 'width' => 'max-w-xl', 'header'=>''])
{{-- Main modal --}}
<div id="{{ $id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-h-full {{ $width }}">
        <!-- Modal content -->
        <div class="relative bg-light-50 rounded-lg shadow dark:bg-dark-900">
            {{-- close btn --}}
            <button type="button"
                class="absolute -end-2 -top-2 text-dark-600 bg-dark-100 hover:bg-dark-200 hover:text-dark-800 rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:bg-dark-700 dark:hover:bg-dark-600 dark:text-dark-300 dark:hover:text-dark-50"
                data-modal-hide="{{ $id }}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            {{-- Modal header --}}
            @empty(!$header)
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-dark-600">
                <h3 class="text-xl font-semibold text-dark-900 dark:text-dark-200">
                    {{ $header }}
                </h3>
            </div>
            @endempty

            <!-- Modal body -->
            <div class="p-4 md:p-5">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>