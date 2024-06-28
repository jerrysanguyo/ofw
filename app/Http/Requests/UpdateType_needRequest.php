<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateType_needRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'remarks' => 'nullable|string|max:255',
            'updated_by' =>  'integer|exists:users,id',
        ];
    }
}
