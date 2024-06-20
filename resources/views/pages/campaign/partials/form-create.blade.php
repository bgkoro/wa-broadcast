<x-header title="Create Campaign" sub-title="You can send SMS Broadcast by create a new campaign in the form below" />
<x-form name="create_campaign" action="{{ route('campaign.store') }}" method="POST" novalidate class="w-full"
     enctype="multipart/form-data">
     <div>
          <x-form.input-label for="title">Campaign Name</x-form.input-label>
          <x-form.input type="text" id="title" name="title" placeholder="Campaign Name" value="{{ old('title') }}"
               required />
          <x-form.input-error name="title" />
     </div>
     <div>
          <x-form.input-label for="delivered">Message</x-form.input-label>
          <x-form.textarea id="message" name="message" rows="5" maxlength="160" required>{{ old('message') }}
          </x-form.textarea>
          <x-form.input-error name="message" />
          <p class="text-sm text-dark-700 dark:text-dark-300">(<span id="character_count">160</span>) of (160) Character
               left</p>
     </div>
     <div>
          <x-form.input-label for="phone_number">Upload Contact</x-form.input-label>
          <x-form.input-file id="phone_number" name="phone_number" required accept=".csv,.xlsx" />
          <x-form.input-error name="phone_number" />
          <a href="{{ route('download_csv', ['path' => $template_numbers]) }}" class="text-sm text-primary-600 hover:underline">Download CSV Template</a>
     </div>
     <x-button type="submit" class="w-full">Submit</x-button>
</x-form>
