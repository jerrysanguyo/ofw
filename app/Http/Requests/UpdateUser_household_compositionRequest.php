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
            'user_id'           => 'integer|exists:users,id',
            'full_name'         => 'required|string|max:255',
            'relation_id'       => 'integer|exists:type_relations,id',
            'birthdate'         => 'required|date',
            'age'               => 'required|integer',
            'work'              => 'required|string|max:255',
            'monthly_income'    => 'required|integer',
            'voters'            => 'required|string|enum:yes,no',
            'updated_by'        => 'integer|exists:users,id',
        ];
    }
}
