<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CampaignProgressComponent extends Component
{

    public string $messageInfo = "";
    public bool $isProcessed = false;

    public function getListeners(): array
    {
        return [
            "echo-private:importNumberEvent,.ImportNumberEvent" => 'broadcast',
            "echo-private:importNumberDoneEvent,.ImportNumberDoneEvent" => 'reloadPageImportDone',
        ];
    }


    public function reloadPageImportDone(array $event): void
    {
        $user = Auth::user()->makeHidden(['email_verified_at', 'created_at', 'updated_at', 'email', 'phone', 'image_profile', 'role_id']);
        $role = $user->role->name;
        if (($user->id == $event['userId']) || ($role == 'admin')) {
            $this->dispatch('reloadPage');
        }
    }

    public function broadcast(array $event): void
    {
        $user = Auth::user();
        $role = $user->role->name;
        if ($event['total'] === $event['ke']) {
            $this->messageInfo = __('app_sms.campaign_processing_into_db_done', [
                'title' => $event['campaign']['title'],
                'total' => $event['total'],
            ]);
            $this->isProcessed = false;
        } else {
            $this->isProcessed = true;
        }
        if (($user->id == $event['userId']) || ($role == 'admin')) {
            $this->messageInfo = __('app_sms.campaign_processing_into_db', [
                'title' => $event['campaign']['title'],
                'total' => $event['total'],
                'ke' => $event['ke'],
            ]);
        }
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.campaign-progress-component');
    }
}
