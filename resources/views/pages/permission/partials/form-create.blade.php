<x-header title="{{ isset($permission) ? 'Update Permission' : 'Create Permission'}}"
     sub-title="{{ isset($permission) ? 'You can update permission in the form below' : 'You can create a new permission by filling in the form below' }}" />
<x-form action="{{ isset($permission)? route('permission.update', [$permission->id]) : route('permission.store') }}"
     method="POST" novalidate>
     @isset($permission)
     @method('put')
     @endisset
     <div class="flex gap-4 flex-col sm:flex-row items-start justify-between">
          <div class="w-full">
               <x-form.input type="text" name="name" placeholder="Permission Name"
                    value="{{ old('name',isset($permission) ? $permission->name :'') }}" required />
               <x-form.input-error name="name" />
          </div>
          <div class="w-full sm:w-auto flex flex-row gap-x-2">
               @isset($permission)
               <x-button type="button" href="{{ route('permission.index') }}" class="w-full" color="danger">Cancel
               </x-button>
               @endisset
               <x-button type="submit" class="w-full">Submit</x-button>
          </div>
     </div>
</x-form>