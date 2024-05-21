<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreType_countryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'created_by' =>  'integer|exists:users,id',
            'updated_by' =>  'integer|exists:users,id',
            'continent_id' =>  'integer|exists:type_continents,id',
        ];
    }
}
