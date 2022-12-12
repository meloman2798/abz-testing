<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
