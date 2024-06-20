<div>
    @foreach (['success', 'info', 'danger'] as $type)
        @if (session()->has($type))
            <x-alert type="{{ $type }}" id="campaign-created" class="mx-6 sm:mx-8">
                {{ session($type) }}
            </x-alert>
        @endif
    @endforeach
    <x-header title="Create Campaign"
              sub-title="{{ __('app_sms.sub-title-create-campaign') }}"/>
    <x-form name="create_campaign" wire:submit.prevent="submitForm" enctype="multipart/form-data" method="POST"
            novalidate class="w-full">
        <div>
            <x-form.input-label for="title">Campaign Name</x-form.input-label>
            <x-form.input type="text" id="title" wire:model.defer="title" name="title" placeholder="Campaign Name"
                          value="{{ old('title') }}"/>
            <x-form.input-error name="title"/>
        </div>
        <div>
            <x-form.input-label for="order">Total Order SMS</x-form.input-label>
            <x-form.input type="number" id="order" wire:model.defer="order" name="order" placeholder="Total SMS"
                          value="{{ old('order') }}"/>
            <x-form.input-error name="order"/>
        </div>
        <div>
            <x-form.input-label for="message">Message</x-form.input-label>
            <x-form.textarea id="message" name="message" rows="5" maxlength="160"
                             wire:model.defer="message">{{ old('message') }}
            </x-form.textarea>
            <x-form.input-error name="message"/>
            <p class="text-sm text-dark-700 dark:text-dark-300">(<span id="character_count">160</span>) of (160)
                Character
                left</p>
        </div>
        <div>
            <x-form.input-label for="schedule">Jadwal</x-form.input-label>
            <x-form.input type="datetime-local" id="schedule" wire:model.defer="schedule" name="schedule"
                              value="{{ old('order') }}"/>
            <x-form.input-error name="schedule"/>
        </div>

        <h6 class="text-lg font-bold dark:text-white">Pilih salah satu</h6>

        <div>
            <x-form.input-label for="text_area_phone_number">1. Nomor</x-form.input-label>
            <x-form.textarea id="text_area_phone_number" name="text_area_phone_number" rows="5"
                             placeholder="628220000098"
                             wire:model.defer="text_area_phone_number">{{ old('text_area_phone_number') }}
            </x-form.textarea>
            <x-form.input-error name="text_area_phone_number"/>
        </div>
        <div>
            <div
                x-data="{ uploading: false, progress: 0 }"
                x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false"
                x-on:livewire-upload-cancel="uploading = false"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <x-form.input-label for="phone_number">2. Unggah Berkas Nomor</x-form.input-label>
                <x-form.input-file wire:model.defer="phone_number" id="phone_number" name="phone_number"
                                   accept=".csv,.xlsx"/>
                <x-form.input-error name="phone_number"/>
                <!-- Progress Bar -->
                <div x-show="uploading">
                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                        <div
                            class="bg-primary-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                            :style="`width: ${progress}%`" x-text="`${progress}%`"></div>
                    </div>
                </div>
            </div>
            <a href="{{ route('download_csv', ['path' => $template_numbers]) }}"
               class="text-sm text-primary-600 hover:underline">Download CSV Template</a>
            <br>
            <a href="{{ route('download_csv', ['path' => $template_numbers_xlsx]) }}"
               class="text-sm text-primary-600 hover:underline">Download Xlsx Template</a>
        </div>
        <x-button type="button" class="w-full" wire:click="submitForm">Submit</x-button>
        <div wire:loading>
            <ul class="max-w-md space-y-2 text-gray-500 list-inside dark:text-gray-400">
                <li class="flex items-center">
                    <div role="status">
                        <svg aria-hidden="true"
                             class="w-4 h-4 me-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                             viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor"/>
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                    Mohon tunggu yahh...
                </li>
            </ul>
        </div>
    </x-form>
</div>
