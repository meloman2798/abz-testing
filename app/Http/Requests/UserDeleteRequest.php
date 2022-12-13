<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
