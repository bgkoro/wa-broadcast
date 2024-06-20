<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DownloadButtonReport extends Component
{
    public int $campaignId;
    public string $campaignTitle;
    public string $file;
    public string $valueButton;
    public string $route;


    public function getListeners(): array
    {
        return [
            "echo-private:generateNumberAdminDoneEvent.{$this->campaignId},.GenerateNumberAdminDoneEvent" => 'reloadNumberAdminDone',
            "echo-private:prosesGenerateNumberAdminEvent.{$this->campaignId},.ProsesGenerateNumberAdminEvent" => 'prosesGenerateNumberAdminEvent',
        ];
    }

    public function mount($campaignId, $campaignTitle, $route): void
    {
        $forWhat = "report";
        switch ($route) {
            case 'campaign.download_report':
                $this->file = route($route, ['campaign' => $campaignId]);
                $this->route = $this->file;
                break;
            case 'campaign.download_numbers':
                $forWhat = "for_processes";
                $this->file = route($route, ['campaign' => $campaignId]);
                $this->route = $this->file;
                break;
        }

        $this->file = "#";
        $this->valueButton = "Mohon Tunggu";
        $file = "app/public/$forWhat/" . config('custom.prefix_name_report') . $campaignId . "_" . str_replace(' ',
                '_',
                trim(strtolower($campaignTitle))) . '.csv';
        if (file_exists(storage_path($file))) {
            $this->valueButton = "Download";
            $this->file = route($route, ['campaign' => $campaignId]);
            $this->route = $this->file;
        }
    }

    public function reloadNumberAdminDone(array $event): void
    {
        $user = Auth::user()->makeHidden([
            'email_verified_at',
            'created_at',
            'updated_at',
            'email',
            'phone',
            'image_profile',
            'role_id'
        ]);
        $role = $user->role->name;
        if (($user->id == $event['userId']) || ($role == 'admin')) {
            $this->file = $this->route;
            $this->valueButton = "Download";
        }
    }

    public function prosesGenerateNumberAdminEvent(array $event): void
    {
        $user = Auth::user()->makeHidden([
            'email_verified_at',
            'created_at',
            'updated_at',
            'email',
            'phone',
            'image_profile',
            'role_id'
        ]);

        // "{\"userId\":4,\"campaign\":{\"schedule\":\"2024-03-03 02:12:29\",\"status\":\"delivered\"},\"total\":100000,\"ke\":99500}"
        $role = $user->role->name;
        if (($event['total'] === $event['ke']) && (($role == 'admin') || $user->id == $event['userId'])) {
            $this->file = $this->route;
            $this->valueButton = "Download";
        }
        if (($event['total'] !== $event['ke']) && (($role == 'admin') || $user->id == $event['userId'])) {
            $percentage = ($event['ke'] / $event['total']) * 100;
            $this->file = "#";
            $this->valueButton = "Mohon Tunggu $percentage%";
        }
    }

    public function render(
    ): View|Application|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.download-button-report');
    }
}
