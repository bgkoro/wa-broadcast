<x-app-layout :$title>
     <div class="px-4 lg:px-8 py-6 lg:py-8 space-y-6">
          @include('pages.role.partials.form-add-role-permission')
          <x-card class="py-6 sm:py-8 space-y-4">
               @include('pages.role.partials.role-permission-table-header')
               @include('pages.role.partials.role-permission-table')
          </x-card>
     </div>
</x-app-layout>