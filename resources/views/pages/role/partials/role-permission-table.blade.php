{{-- table --}}
<x-table>
     <x-table.head>
          <x-table.head-row>
               <x-table.head-col class="w-px whitespace-nowrap">#</x-table.head-col>
               <x-table.head-col>Permission</x-table.head-col>
               <x-table.head-col><span class="sr-only">Actions</span></x-table.head-col>
          </x-table.head-row>
     </x-table.head>
     <x-table.body>
          @if ($rolesPermissions->count())
          @php
          $num = $rolesPermissions->firstItem();
          @endphp
          @foreach ($rolesPermissions as $rolePermission)
          <x-table.body-row>
               <x-table.body-col>{{ $num++ }}</x-table.body-col>
               <x-table.body-col class="whitespace-nowrap">{{ $rolePermission->name }}</x-table.body-col>
               <x-table.body-col class="flex items-center gap-2 justify-end">
                    <x-form
                         action="{{ route('role.permission.destroy', ['role' => $role->id , 'permission' => $rolePermission->id]) }}"
                         method="POST" :space="false">
                         @method('delete')
                         <x-button type="submit" color="danger" size="extra-small"
                              onclick="return confirm('Are you sure want to delete {{ $rolePermission->name }} ?')">
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
     {{ $rolesPermissions->withQueryString()->links() }}
</div>