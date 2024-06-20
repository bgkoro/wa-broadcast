<x-table>
     <x-table.head>
          <x-table.head-row>
               <x-table.head-col class="w-px whitespace-nowrap">#</x-table.head-col>
               <x-table.head-col>Name</x-table.head-col>
               <x-table.head-col>Username</x-table.head-col>
               <x-table.head-col>Email</x-table.head-col>
               <x-table.head-col>Role</x-table.head-col>
               <x-table.head-col><span class="sr-only">Actions</span></x-table.head-col>
          </x-table.head-row>
     </x-table.head>
     <x-table.body>
          @if ($users->count())
          @php
          $num = $users->firstItem();
          @endphp
          @foreach ($users as $user)
          <x-table.body-row>
               <x-table.body-col>{{ $num++ }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $user->name }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $user->username }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $user->email }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $user->role?->name }}</x-table.body-col>
               <x-table.body-col class="flex items-center gap-2 justify-end">
                    <x-button type="button" href="{{ route('user.edit', ['user' => $user->id]) }}" size="extra-small">
                         Edit
                    </x-button>
                    <x-form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST" :space="false">
                         @method('delete')
                         <x-button type="submit" color="danger" size="extra-small"
                              onclick="return confirm('Are you sure want to delete {{ $user->name }} ?')">
                              Delete</x-button>
                    </x-form>
               </x-table.body-col>
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
     {{ $users->links() }}
</div>