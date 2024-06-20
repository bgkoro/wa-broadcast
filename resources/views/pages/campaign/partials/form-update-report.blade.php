<x-header title="{{'Update Report : ' . $campaign->title }}"
          sub-title="You can update report for campaign {{ $campaign->title }} by filling form bellow"/>
<div class="flex flex-wrap">
    <x-form action="{{ route('campaign.update',['campaign' => $campaign->id]) }}" method="POST" novalidate
            class="basis-full md:basis-1/2">
        @method('PUT')
        @csrf
        <div>
            <x-form.input-label for="status">Campaign Status</x-form.input-label>
            <x-form.select id="status" name="status" class="w-full" required>
                <option value="">-- Select Status --</option>
                <option {{ old('status', $campaign->status) == 'onprocess' ? 'selected' : '' }}
                        value="onprocess">On
                    Process
                </option>
                <option {{ old('status', $campaign->status) == 'delivered' ? 'selected' : '' }}
                        value="delivered">Delivered
                </option>
            </x-form.select>
            <x-form.input-error name="status"/>
        </div>
        <div>
            <x-form.input-label for="undelivered">Undelivered Phone Number</x-form.input-label>
            <x-form.textarea id="undelivered" name="undelivered" rows="10" placeholder="088123465798">
            </x-form.textarea>
            <x-form.input-error name="undelivered"/>
        </div>
        <x-button type="submit" class="w-full">Update Report</x-button>
    </x-form>
    <div class="basis-full md:basis-1/2 pt-6 md:ps-6">
        <div class="md:border-s md:ps-6 min-h-full space-y-6">
            <div class="border-2 border-dashed border-dark-200 dark:border-dark-700 rounded-lg p-4">
                <p class="text-dark-600 dark:text-light-500">Contact Submitted</p>
                <p class="text-dark-800 dark:text-light-400 text-lg font-semibold">
                    {{ $campaign_report->submitted}}</p>
            </div>
            <div class="border-2 border-dashed border-dark-200 dark:border-dark-700 rounded-lg p-4">
                <p class="text-dark-600 dark:text-light-500">Delivered</p>
                <p class="text-dark-800 dark:text-light-400 text-lg font-semibold">                        {{ $campaign_report->delivered}}</p>
            </div>
            <div class="border-2 border-dashed border-dark-200 dark:border-dark-700 rounded-lg p-4">
                <p class="text-dark-600 dark:text-light-500">Undelivered</p>
                <p class="text-dark-800 dark:text-light-400 text-lg font-semibold">                        {{ $campaign_report->undelivered}}</p>
            </div>
            <div class="border-2 border-dashed border-dark-200 dark:border-dark-700 rounded-lg p-4">
                <p class="text-dark-600 dark:text-light-500">Rejected</p>
                <p class="text-dark-800 dark:text-light-400 text-lg font-semibold">                        {{ $campaign_report->rejected}}</p>
            </div>
        </div>
    </div>
</div>
