<x-app-layout :$title>
     <div class="px-4 py-6 lg:py-8 space-y-6">
          <div class="flex flex-wrap">
               <div class="basis-full md:basis-6/12">
                    <x-card class="p-6 sm:p-8 space-y-4">
                        <livewire:form-create-campaign-component />
                    </x-card>
               </div>
               <div class="basis-full md:basis-6/12 hidden md:block">
                    @include('pages.campaign.partials.device-simulator')
               </div>
          </div>

     </div>
</x-app-layout>
