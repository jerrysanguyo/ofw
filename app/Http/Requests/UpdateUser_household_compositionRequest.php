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
            'full_name'         => 'string|max:255',
            'age'               => 'integer|max:255',
            'relation_id'       => 'integer|exists:type_relations,id',
            'birthdate'         => 'date',
            'work'              => 'string|max:255',
            'monthly_income'    => 'integer',
            'voters'            => 'string|in:yes,no',
        ];
    }
}

