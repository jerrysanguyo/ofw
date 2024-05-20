<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreType_civil_statusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'created_by' =>  'integer|exists:users,id',
            'updated_by' =>  'integer|exists:users,id',
        ];
    }
}
