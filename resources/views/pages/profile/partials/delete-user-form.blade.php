<section class="space-y-6">
     <header>
          @error('password','userDeletion')
          <x-alert type="danger" id="deleteAlert" class="mb-4">{{ $message }}</x-alert>
          @enderror
          <h2 class="text-lg font-medium text-dark-900 dark:text-dark-100">
               {{ __('Delete Account') }}
          </h2>

          <p class="mt-1 text-sm text-dark-600 dark:text-dark-400">
               {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before
               deleting your account, please download any data or information that you wish to retain.') }}
          </p>
     </header>

     <x-button type="button" color="danger" data-modal-target="confirm-delete-account"
          data-modal-toggle="confirm-delete-account">DELETE
          ACCOUNT</x-button>

     <x-modal id="confirm-delete-account" width="max-w-lg">
          <p class="text-xl font-semibold text-dark-900 dark:text-dark-200 mb-2">Are you sure you want to delete your
               account?</p>
          <p class="text-dark-600 dark:text-dark-400">
               {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.
               Please enter your password to confirm you would like to permanently delete your account.') }}
          </p>
          <x-form method="post" action="{{ route('profile.destroy') }}" novalidate>
               @method('delete')
               <div>
                    <x-form.input-label for="password" class="sr-only"></x-form.input-label>
                    <x-form.input id="password" name="password" type="password" placeholder="{{ __('Password') }}"
                         required />
                    <x-form.input-error name="password" />
               </div>
               <div class="flex justify-end">
                    <x-button type="button" color="netral" class="me-4" data-modal-hide="confirm-delete-account">
                         {{ __('Cancel') }}
                    </x-button>

                    <x-button type="submit" color="danger">
                         {{ __('Delete Account') }}
                    </x-button>
               </div>
          </x-form>
     </x-modal>
</section>