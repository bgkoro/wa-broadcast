{{-- table --}}
<x-table>
     <x-table.head>
          <x-table.head-row>
               <x-table.head-col class="w-px whitespace-nowrap">#</x-table.head-col>
               <x-table.head-col>Date</x-table.head-col>
               <x-table.head-col>Description</x-table.head-col>
               <x-table.head-col>Debit</x-table.head-col>
               <x-table.head-col>Credit</x-table.head-col>
               <x-table.head-col>Balance</x-table.head-col>
          </x-table.head-row>
     </x-table.head>
     <x-table.body>
          @if ($creditHistories->count())
          @php
          $num = $creditHistories->firstItem();
          @endphp
          @foreach ($creditHistories as $creditHistory)
          <x-table.body-row>
               <x-table.body-col>{{ $num++ }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ date_format($creditHistory->created_at,'l, d M Y H:i:s')
                    }}
               </x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $creditHistory->description }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $creditHistory->debit }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $creditHistory->credit }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $creditHistory->ending_balance }}</x-table.body-col>
          </x-table.body-row>
          @endforeach
          @else
          <x-table.body-row>
               <x-table.body-col class="text-center" colspan="3">No results found</x-table.body-col>
          </x-table.body-row>
          @endif
     </x-table.body>
</x-table>
<div class="px-6 sm:px-8">
     {{ $creditHistories->withQueryString()->links() }}
</div>