<x-card class="p-6 flex gap-4 items-center hover:bg-secondary-100 dark:hover:bg-secondary-950">
     <div class="bg-secondary-600 rounded p-3">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6 stroke-light-50">
               <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
          </svg>
     </div>
     <div class="basis-full">
          <p class="text-sm text-dark-600 dark:text-light-500">Contact Submitted</p>
          <div class="flex items-center justify-between gap-4">
               <p class="text-2xl font-semibold text-dark-900 dark:text-light-300">{{
                    number_format($report->submitted, 0, ",", ".") }}
               </p>
          </div>
     </div>
</x-card>