<?php

namespace App\Livewire;

use App\Jobs\ImportNumberJob;
use App\Rules\NumericArrayValues;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Livewire\Component;

class FormCreateCampaignComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $message;
    public $phone_number;
    public $schedule;
    public $text_area_phone_number;
    public $order;
    public $count = 0;
    public string $messageInfo = "";

    public function getListeners(): array
    {
        return [
            'broadcast' => 'broadcast',
        ];
    }

    public function broadcast(array $event): void
    {
        $this->messageInfo = "Campaign Anda dengan judul: [" . $event['campaign']['title'] . "] sedang diproses, harap tunggu sebentar. Jumlah total : " . $event['total'] . " \n Diproses: " . $event['ke'];
    }

    public function submitForm()
    {
        $user = Auth::user();
        $data = $this->validate([
            'title' => 'required|string|max:255',
            'order' => [
                'required',
                'int',
                function ($attribute, $value, $fail) use ($user) {
                    if ($user->credit->balance < $value) {
                        $fail('Kredit tidak mencukupi, Anda punya ' . $user->credit->saldo . ' kredit. Anda membutuhkan ' . $value . 'kredit untuk mengirimkan kampanye ini.');
                    }
                }
            ],
            'message' => 'required|string',
            'schedule' => ['nullable', 'date'],
            'phone_number' => [
                'nullable',
                'file',
                'required_without:text_area_phone_number',
                'extensions:xlsx,csv,txt'
            ],
            'text_area_phone_number' => ['nullable', 'required_without:phone_number', new NumericArrayValues()],
        ]);
        $data['title'] = str_replace('\\', '-', $data['title']);
        $data['title'] = str_replace('/', '-', $data['title']);
        if ($data['phone_number'] && $data['text_area_phone_number']) {
            return redirect()->route('campaign.create')->with('danger',
                'Anda tidak bisa mengirimkan file dan text area bersamaan');
        }
        if ($data['phone_number']) {
            $phoneNumberReq = $data['phone_number'];
            $name = $phoneNumberReq->hashName();
            $filePath = $phoneNumberReq->storeAs('public', 'telepon-' . $name);
            unset($data['phone_number']);
        } else {
            $filePath = "";
        }
        ImportNumberJob::dispatch($user, $data, $filePath, $data['order']);
        return redirect()->route('campaign.index')->with('success',
            __('app_sms.campaign_processing_into_queue', ['title' => $data['title']]));
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.form-create-campaign', [
            'template_numbers' => "template_numbers.csv",
            'template_numbers_xlsx' => "template_numbers.xlsx",
        ]);
    }
}
