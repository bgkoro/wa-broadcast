<x-app-layout :$title>

     <div class="px-4 py-6 lg:py-8 space-y-6">
          <div class="flex flex-col md:flex-row md:items-center">
               <div class="basis-full lg:basis-8/12 grid grid-cols-1 gap-4">
                    <div class="flex flex-wrap gap-4 mb-4">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                              stroke="currentColor" class="w-14 h-14 stroke-primary-500">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                   d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                         </svg>
                        <div>
                              <p class="text-md capitalize text-dark-600 dark:text-dark-400">Campaign Report</p>
                              <p class="text-xl font-semibold capitalize text-dark-800 dark:text-dark-200">{{
                                   $campaign->title }}</p>
                         </div>
                    </div>

                    @foreach (['success', 'info', 'danger'] as $type)
                       @if (session()->has($type))
                           <x-alert type="{{ $type }}" id="campaign-created" class="mx-6 sm:mx-8">
                               {{ session($type) }}
                           </x-alert>
                       @endif
                    @endforeach
                    @include('pages.campaign.partials.sms-submitted-card')
                    @include('pages.campaign.partials.sms-delivered-card')
                    @include('pages.campaign.partials.sms-undelivered-card')
                    @include('pages.campaign.partials.sms-rejected-card')
                    @livewire('download-button-report', ['campaignId' => $campaign->id, 'campaignTitle'=> $campaign->title,'route' => 'campaign.download_report'])
               </div>
               <div class="basis-full md:basis-6/12 mt-4 lg:mt-0 md:ms-4">
                    @include('pages.campaign.partials.device-simulator')
               </div>
          </div>
     </div>
</x-app-layout>
