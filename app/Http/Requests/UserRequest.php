<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('has-permission', 'manage_users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'lowercase', 'max:255', Rule::unique(User::class)->ignore($this->user)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'role_id' => ['required']
        ];

        if (Request()->isMethod('post')) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        return $rules;
    }
}
