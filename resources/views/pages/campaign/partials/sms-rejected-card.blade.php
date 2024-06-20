<x-card class="p-6 flex gap-4 items-center hover:bg-danger-100 dark:hover:bg-danger-950">
     <div class="bg-danger-600 rounded p-3">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6 stroke-light-50">
               <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
          </svg>
     </div>
     <div class="basis-full">
          <p class="text-sm text-dark-600 dark:text-light-500">SMS Rejected</p>
          <div class="flex items-center justify-between gap-4">
               <p class="text-2xl font-semibold text-dark-900 dark:text-light-300">{{ number_format($report->rejected,
                    0, ",", ".") }}
               </p>
          </div>
     </div>
</x-card>