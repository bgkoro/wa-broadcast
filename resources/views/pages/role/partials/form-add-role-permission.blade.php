<x-card class="p-6 sm:p-8 space-y-4">
     <x-header title="Add Permission to {{ ucfirst($role->name) }}"
          subTitle="You can add a new permission to role by filling in the form below" />
     <x-form action="{{ route('role.permission.store',['role' => $role->id]) }}" method="POST" novalidate>
          <div class="flex gap-4 flex-col sm:flex-row items-start justify-between">
               <div class="w-full">
                    <x-form.select name="permission" class="w-full" required>
                         <option value="">-- select Permission --</option>
                         @foreach ($permissions as $permission)
                         <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                         @endforeach
                    </x-form.select>
                    <x-form.input-error name="permission" />
               </div>
               <div class="w-full sm:w-auto flex flex-row gap-x-2">
                    <x-button type="submit" class="w-full">Submit</x-button>
               </div>
          </div>
     </x-form>
</x-card>