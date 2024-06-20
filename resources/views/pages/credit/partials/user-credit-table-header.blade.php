{{-- table header --}}
@foreach (['success', 'info', 'danger'] as $type)
    @if (session()->has($type))
        <x-alert type="{{ $type }}" id="credit_balance" class="mx-6 sm:mx-8">
            {{ session($type) }}
        </x-alert>
    @endif
@endforeach
<x-header class="px-6 sm:px-8" title="{{ ucfirst($credit->user->name) . ' Credit Balance' }}"
     sub-title="Credit history" />

<div class="px-6 sm:px-8 flex gap-2 items-center justify-between">
     <div>
          {{-- form request per page size --}}
          <x-form :space="false">
               @foreach (request()->except(['page','perPage']) as $name => $value)
               @if (is_array($value))
               @foreach ($value as $i => $v)
               <input type="hidden" name="{{ $i }}" value="{{ $v }}">
               @endforeach
               @else
               <input type="hidden" name="{{ $name }}" value="{{ $value }}">
               @endif
               @endforeach
               <x-form.select name="perPage" onchange="submit()">
                    <option {{ $creditHistories->perPage() == 10 ? 'selected' : '' }} value="10">10</option>
                    <option {{ $creditHistories->perPage() == 25 ? 'selected' : '' }} value="25">25</option>
                    <option {{ $creditHistories->perPage() == 50 ? 'selected' : '' }} value="50">50</option>
                    <option {{ $creditHistories->perPage() == 100 ? 'selected' : '' }} value="100">100</option>
               </x-form.select>
          </x-form>
     </div>
     <div class="w-full md:w-1/2">
          <x-form>
               <div date-rangepicker class="flex items-center gap-4" id="dateRangePicker">
                    <x-form.input type="text" name="start" id="start" placeholder="Select date start"
                         value="{{ request('periode')['start'] }}" readonly autocomplete="off">
                         <x-slot:prefixIcon>
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                   stroke="currentColor" class="w-5 h-5">
                                   <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                              </svg>
                         </x-slot:prefixIcon>
                    </x-form.input>
                    <span class=" text-dark-500">to</span>
                    <x-form.input type="text" name="end" id="end" placeholder="Select date end"
                         value="{{request('periode')['end'] }}" readonly autocomplete="off">
                         <x-slot:prefixIcon>
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                   stroke="currentColor" class="w-5 h-5">
                                   <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                              </svg>
                         </x-slot:prefixIcon>
                    </x-form.input>
                    <x-button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                              stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                   d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                         </svg>
                    </x-button>
               </div>
          </x-form>
     </div>
</div>
