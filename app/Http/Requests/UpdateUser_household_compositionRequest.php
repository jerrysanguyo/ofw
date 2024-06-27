<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser_household_compositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name'         => 'required|string|max:255',
            'age'               => 'required|integer|min:0|max:255',
            'relation_id'       => 'required|integer|exists:type_relations,id',
            'birthdate'         => 'required|date',
            'work'              => 'nullable|string|max:255',
            'monthly_income'    => 'nullable|integer|min:0',
            'voters'            => 'required|string|in:yes,no',
        ];
    }
}

