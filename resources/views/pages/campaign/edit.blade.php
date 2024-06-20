<x-app-layout :$title>
     <div class="px-4 py-6 lg:py-8 space-y-6">
          <x-card class="p-6 sm:p-8 space-y-4">
               @include('pages.campaign.partials.form-update-report')
          </x-card>
     </div>
</x-app-layout>