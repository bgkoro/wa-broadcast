{{-- table --}}
<x-table>
     <x-table.head>
          <x-table.head-row>
               <x-table.head-col class="w-px whitespace-nowrap">#</x-table.head-col>
               <x-table.head-col>Client Name</x-table.head-col>
               <x-table.head-col>Balance</x-table.head-col>
               <x-table.head-col><span class="sr-only">Actions</span></x-table.head-col>
          </x-table.head-row>
     </x-table.head>
     <tbody>
          @if ($credits->count())
          @php
          $num = $credits->firstItem();
          @endphp
          @foreach ($credits as $credit)
          <x-table.body-row>
               <x-table.body-col>{{ $num++ }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $credit->user->name }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $credit->balance }}</x-table.body-col>
               <x-table.body-col class="flex items-center gap-2 justify-end">
                    <x-button type="button" size="extra-small" color="primary"
                         :href="route('credit.show', ['credit' => $credit->id])">
                         Top Up Balance
                    </x-button>
               </x-table.body-col>
          </x-table.body-row>
          @endforeach
          @else
          <x-table.body-row>
               <x-table.body-col class="text-center" colspan="4">No results found</x-table.body-col>
          </x-table.body-row>
          @endif
     </tbody>
</x-table>
{{-- pagination --}}
<div class="px-6 sm:px-8">
     {{ $credits->links() }}
</div>