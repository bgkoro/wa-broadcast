{{-- table --}}
<x-table>
     <x-table.head>
          <x-table.head-row>
               <x-table.head-col class="w-px whitespace-nowrap">#</x-table.head-col>
               <x-table.head-col>Role Name</x-table.head-col>
               <x-table.head-col><span class="sr-only">Actions</span></x-table.head-col>
          </x-table.head-row>
     </x-table.head>
     <tbody>
          @if ($roles->count())
          @php
          $num = $roles->firstItem();
          @endphp
          @foreach ($roles as $role)
          <x-table.body-row>
               <x-table.body-col>{{ $num++ }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $role->name }}</x-table.body-col>
               <x-table.body-col class="flex items-center gap-2 justify-end">
                    <x-button type="button" size="extra-small" color="success"
                         :href="route('role.show', ['role' => $role->id])">
                         Permissions
                    </x-button>
                    <x-button type="button" size="extra-small" :href="route('role.edit', ['role' => $role->id])">Edit
                    </x-button>
                    <x-form action="{{ route('role.destroy', ['role' => $role]) }}" method="POST" :space="false">
                         @method('delete')
                         <x-button type="submit" color="danger" size="extra-small"
                              onclick="return confirm('Are you sure want to delete {{ $role->name }} ?')">
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
     </tbody>
</x-table>
{{-- pagination --}}
<div class="px-6 sm:px-8">
     {{ $roles->links() }}
</div>