<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BroadcastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'phone_number' => $this->phone_number,
            'provider' => $this->provider,
            'status' => $this->status,
            'message' => $this->message,
        ];
    }
}
