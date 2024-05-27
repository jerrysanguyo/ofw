<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser_household_compositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'user_id'           => 'exists:users,id',
            'full_name'         => 'required|max:255',
            'relation_id'       => 'exists:type_relations,id',
            'birthdate'         => 'required',
            'age'               => 'required',
            'work'              => 'required|max:255',
            'monthly_income'    => 'required',
            'voters'            => 'required',
        ];
    }
}
