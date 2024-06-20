{{-- table --}}
<x-table>
     <x-table.head>
          <x-table.head-row>
               <x-table.head-col class="w-px whitespace-nowrap">#</x-table.head-col>
               <x-table.head-col>Permission Name</x-table.head-col>
               <x-table.head-col><span class="sr-only">Actions</span></x-table.head-col>
          </x-table.head-row>
     </x-table.head>
     <tbody>
          @if ($permissions->count())
          @php
          $num = $permissions->firstItem();
          @endphp
          @foreach ($permissions as $permission)
          <x-table.body-row>
               <x-table.body-col>{{ $num++ }}</x-table.body-col>
               <x-table.body-col>{{ $permission->name }}</x-table.body-col>
               <x-table.body-col class="flex items-center gap-2 justify-end">
                    <x-button type="button" size="extra-small"
                         :href="route('permission.edit', ['permission' => $permission->id])">Edit
                    </x-button>
                    <x-form action="{{ route('permission.destroy', ['permission' => $permission->id]) }}" method="POST"
                         :space="false">
                         @method('delete')
                         <x-button type="submit" color="danger" size="extra-small"
                              onclick="return confirm('Are you sure want to delete {{ $permission->name }} ?')">
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
     {{ $permissions->links() }}
</div>