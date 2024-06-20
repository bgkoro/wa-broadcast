<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DashboardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'start' => ['date', 'date_format:Y-m-d', 'before_or_equal:end'],
            'end' => ['date', 'date_format:Y-m-d', 'after_or_equal:start'],
            'status' => ['string', 'in:submitted,delivered,undelivered,rejected'],
        ];
    }
}
