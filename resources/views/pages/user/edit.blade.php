<x-app-layout :$title>
     <div class="px-4 lg:px-8 py-6 lg:py-8 space-y-6">
          <x-card class="p-6 sm:p-8 space-y-4">
               <x-header title="Edit User" subTitle="You can edit user by filling in the form below" />
               <x-form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" novalidate>
                    @method('put')
                    <div class="grid md:grid-cols-2 gap-4">
                         <div>
                              <x-form.input-label for="name">Name</x-form.input-label>
                              <x-form.input type="text" id="name" name="name" placeholder="Name"
                                   value="{{ old('name', $user->name) }}" required />
                              <x-form.input-error name="name" />
                         </div>
                         <div>
                              <x-form.input-label for="username">Username</x-form.input-label>
                              <x-form.input type="text" id="username" name="username" placeholder="Username"
                                   value="{{ old('username', $user->username) }}" required />
                              <x-form.input-error name="username" />
                         </div>
                         <div>
                              <x-form.input-label for="email">Email</x-form.input-label>
                              <x-form.input type="email" id="email" name="email" placeholder="email@yourcompany.com"
                                   value="{{ old('email', $user->email) }}" required />
                              <x-form.input-error name="email" />
                         </div>
                         <div>
                              <x-form.input-label for="role_id">User Role</x-form.input-label>
                              <x-form.select id="role_id" name="role_id" class="w-full" required>
                                   <option value="">-- Select Role --</option>
                                   @foreach ($roles as $role)
                                   <option {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }} value="{{
                                        $role->id }}">{{
                                        $role->name }}</option>
                                   @endforeach
                              </x-form.select>
                              <x-form.input-error name="role_id" />
                         </div>
                    </div>
                    <x-button type="submit">Update</x-button>
               </x-form>
          </x-card>
     </div>
</x-app-layout>