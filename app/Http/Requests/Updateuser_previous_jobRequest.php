<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Updateuser_previous_jobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'job_type'          => 'required|string|in:landbase,seabase',
            'job_id'            => 'integer|exists:type_jobs,id',
            'sub_job_id'        => 'integer|exists:type_sub_jobs,id',
            'continent_id'      => 'integer|exists:type_continents,id',
            'country_id'        => 'integer|exists:type_countries,id',
            'years_abbroad'     => 'required|integer',
            'contract_id'       => 'integer|exists:type_contracts,id',
            'last_departure'    => 'required|date',
            'last_arrival'      => 'required|date',
            'owwa_id'           => 'integer|exists:type_owwas,id',
            'intent_return'     => 'required|in:yes,no',
        ];
    }
}
