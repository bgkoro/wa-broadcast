@foreach (['success', 'info', 'danger'] as $type)
    @if (session()->has($type))
        <x-alert type="{{ $type }}" id="role" class="mx-6 sm:mx-8">
            {{ session($type) }}
        </x-alert>
    @endif
@endforeach
<div class="flex flex-col gap-2 sm:items-center sm:flex-row sm:justify-between px-6 sm:px-8">
     <x-header title="Users" subTitle="Manage all users or create a new one" />
     <x-button.index type="button" href="{{ route('user.create') }}"><svg class="h-3.5 w-3.5 mr-2" fill="currentColor"
               viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
               <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
          </svg>Create User</x-button.index>
</div>
<div class="px-6 sm:px-8 flex gap-2 items-center justify-between">
     <div>
          {{-- form request per page size --}}
          <x-form :space="false">
               @foreach (request()->except(['page','perPage']) as $name => $value)
               <input type="hidden" name="{{ $name }}" value="{{ $value }}">
               @endforeach
               <x-form.select name="perPage" onchange="submit()">
                    <option {{ $users->perPage() == 10 ? 'selected' : '' }} value="10">10
                    </option>
                    <option {{ $users->perPage() == 25 ? 'selected' : '' }} value="25">25
                    </option>
                    <option {{ $users->perPage() == 50 ? 'selected' : '' }} value="50">50
                    </option>
                    <option {{ $users->perPage() == 100 ? 'selected' : '' }} value="100">100
                    </option>
               </x-form.select>
          </x-form>
     </div>
     <div class="w-full sm:w-1/2 md:w-1/3">
          {{-- form search --}}
          <x-form :space="false" class="w-full">
               <x-form.input type="text" id="search" name="search" placeholder="search" value="{{ request('search') }}">
                    <x-slot:prefixIcon>
                         <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                              xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd"
                                   d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                   clip-rule="evenodd" />
                         </svg>
                    </x-slot:prefixIcon>
               </x-form.input>
          </x-form>
     </div>
</div>
