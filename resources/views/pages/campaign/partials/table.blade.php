{{-- table --}}
<x-table>
    <x-table.head>
        <x-table.head-row>
            <x-table.head-col class="w-px whitespace-nowrap">#</x-table.head-col>
            <x-table.head-col>Tanggal</x-table.head-col>
            <x-table.head-col>Nama Kamapain</x-table.head-col>
            <x-table.head-col>Jadwal</x-table.head-col>
            <x-table.head-col>Nama</x-table.head-col>
            <x-table.head-col>Total SMS</x-table.head-col>
            <x-table.head-col>Total Tertolak</x-table.head-col>
            <x-table.head-col><span class="sr-only">Actions</span></x-table.head-col>
        </x-table.head-row>
    </x-table.head>
    <tbody>
    @if ($campaigns->count())
        @php
            $num = $campaigns->firstItem();
        @endphp
        @foreach ($campaigns as $campaign)
            <x-table.body-row>
                <x-table.body-col>{{ $num++ }}</x-table.body-col>
                <x-table.body-col>{{ $campaign->created_at }}</x-table.body-col>
                <x-table.body-col>{{ $campaign->title }}</x-table.body-col>
                <x-table.body-col>{{ $campaign->schedule }}</x-table.body-col>
                <x-table.body-col>{{ $campaign->user->name }}</x-table.body-col>
                <x-table.body-col>{{ $campaign->campaign_reports->submitted }}</x-table.body-col>
                <x-table.body-col>{{ $campaign->campaign_reports->rejected }}</x-table.body-col>
                <x-table.body-col class="flex items-center gap-2 justify-end">
                    @if($campaign->campaign_reports->submitted != $campaign->campaign_reports->rejected)
                        @if (request('status') != 'delivered')
                            @can('has-permission', 'manage_campaigns')
                                @livewire('download-button-report', ['campaignId' => $campaign->id, 'campaignTitle'=> $campaign->title,'route' => 'campaign.download_numbers'])
                                <x-button type="button" size="extra-small"
                                          :href="route('campaign.edit',['campaign' => $campaign->id])">
                                    Update Report
                                </x-button>
                            @endcan
                        @else
                            <x-button type="button" size="extra-small"
                                      :href="route('campaign.show',['campaign' => $campaign->id])">
                                View Report
                            </x-button>
                        @endif
                    @else
                        <x-button color="warning" type="button" size="extra-small"
                                  href="#">
                          {{__('app_sms.cant_process')}}
                        </x-button>
                    @endif

                </x-table.body-col>
            </x-table.body-row>
        @endforeach
    @else
        <x-table.body-row>
            <x-table.body-col class="text-center" colspan="6">No results found</x-table.body-col>
        </x-table.body-row>
    @endif
    </tbody>
</x-table>
{{-- pagination --}}
<div class="px-6 sm:px-8">
    {{ $campaigns->links() }}
</div>
