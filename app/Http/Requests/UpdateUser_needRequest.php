<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser_needRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'user_id' => 'integer|exists:users,id',
            'needs' => 'required|string|max:255',
        ];
    }
}
