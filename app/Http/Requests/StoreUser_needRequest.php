<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser_needRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'user_id' => 'integer|exists:users,id',
            'need_id' => 'required|array',
            'need_id.*' => 'integer|exists:type_needs,id',
        ];
    }
}
