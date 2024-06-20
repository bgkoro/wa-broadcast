<x-header title="{{ isset($role) ? 'Update Role' : 'Create Role'}}"
     sub-title="{{ isset($role) ? 'You can update role in the form below' : 'You can create a new role by filling in the form below' }}" />
<x-form action="{{ isset($role)? route('role.update', [$role->id]) : route('role.store') }}" method="POST" novalidate>
     @isset($role)
     @method('put')
     @endisset
     <div class="flex gap-4 flex-col sm:flex-row items-start justify-between">
          <div class="w-full">
               <x-form.input type="text" name="name" placeholder="Role Name"
                    value="{{ old('name',isset($role) ? $role->name :'') }}" required />
               <x-form.input-error name="name" />
          </div>
          <div class="w-full sm:w-auto flex flex-row gap-x-2">
               @isset($role)
               <x-button type="button" href="{{ route('role.index') }}" class="w-full" color="danger">Cancel
               </x-button>
               @endisset
               <x-button type="submit" class="w-full">Submit</x-button>
          </div>
     </div>
</x-form>