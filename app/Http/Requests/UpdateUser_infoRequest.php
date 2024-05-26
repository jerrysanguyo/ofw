<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser_infoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'user_id' =>  'integer|exists:users,id', 
            'house_number' => 'required|string|max:255',
            'barangay_id' => 'integer|exists:type_barangays,id',
            'street' => 'required|string|max:255',
            'city_id' => 'integer|exists:type_cities,id',
            'residence_years' => 'required|integer',
            'residence_id' => 'integer|exists:type_residences,id',
            'birthdate' => 'required|date',
            'age' => 'required|integer',
            'gender_id' => 'integer|exists:type_genders,id',
            'birthplace' => 'required|string|max:255',
            'religion_id' => 'integer|exists:type_religions,id',
            'civil_id' => 'integer|exists:type_civil_statuses,id',
            'present_job' => 'required|string|max:255',
            'education_id' => 'integer|exists:type_educational_attainments,id',
            'voters' => 'required|string|in:Yes,No',
        ];
    }
}
