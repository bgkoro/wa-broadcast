<div class="relative mx-auto border-gray-800  bg-gray-800 border-[14px] rounded-[2.5rem] h-[600px] w-[300px] shadow-xl">
     <div class="w-[148px] h-[18px] bg-gray-800 top-0 rounded-b-[1rem] left-1/2 -translate-x-1/2 absolute">
     </div>
     <div class="h-[46px] w-[3px] bg-gray-800 absolute -start-[17px] top-[124px] rounded-s-lg"></div>
     <div class="h-[46px] w-[3px] bg-gray-800 absolute -start-[17px] top-[178px] rounded-s-lg"></div>
     <div class="h-[64px] w-[3px] bg-gray-800 absolute -end-[17px] top-[142px] rounded-e-lg"></div>
     <div class="rounded-[2rem] overflow-hidden w-[272px] h-[572px] bg-light-50 ">
          <div class="bg-dark-50 border-b border-dark-100 px-2 pt-6 pb-2 flex items-center justify-between">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 me-2 stroke-primary-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
               </svg>
               <div class="flex flex-col items-center">
                    <button type="button"
                         class="flex text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                         <span class="sr-only">Open user menu</span>
                         <img class="w-6 h-6 rounded-full" src="{{ Auth::user()->image_profile }}" alt="user photo">
                    </button>
                    <div class="flex items-center justify-center"><span class="text-xs">{{isset($campaign) ?
                              $campaign->user->name : 'Jhon' }}</span><svg xmlns="http://www.w3.org/2000/svg"
                              fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                              class="w-3 h-3 stroke-dark-300">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                         </svg>
                    </div>
               </div>
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 me-2 stroke-primary-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                         d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
               </svg>
          </div>
          <div class="p-4">
               <div id="message_simulation" class="bg-dark-50 p-4 rounded-xl max-w-fit text-sm">
                    {{ isset($campaign) ? $campaign->message: '....' }}
               </div>
          </div>
     </div>
</div>