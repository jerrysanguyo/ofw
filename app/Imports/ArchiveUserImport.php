<?php

namespace App\Imports;

use App\Models\{
    ArchiveUser, 
    ArchiveAddress, 
    Type_city, 
    Type_barangay, 
    Type_residence, 
    Type_educational_attainment, 
    Type_gender, 
    Type_civil_status, 
    Type_religion,
    Type_job,
    Type_sub_job,
    Type_continent,
    Type_country,
    Type_contract,
    Type_owwa,
};
use Maatwebsite\Excel\Concerns\{ToModel, WithHeadingRow};
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class ArchiveUserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return DB::transaction(function () use ($row) {
            try {
                $city = Type_city::findByNameOrFail($row['city']);
                $barangay = Type_barangay::findByNameOrFail($row['barangay']);
                $residence = Type_residence::findByNameOrFail($row['residence']);
                $gender = Type_gender::findByNameOrFail($row['gender']);
                $education = Type_educational_attainment::findByNameOrFail($row['educational_attainment']);
                $civil = Type_civil_status::findByNameOrFail($row['civil_status']);
                $religion = Type_religion::findByNameOrFail($row['religion']);
                $job = Type_job::findByNameOrFail($row['job']);
                $sub_job = Type_sub_job::findByNameOrFail($row['sub_job']);
                $continent = Type_continent::findByNameOrFail($row['continent']);
                $country = Type_country::findByNameOrFail($row['country']);
                $contract = Type_contract::findByNameOrFail($row['contract']);
                $owwa = Type_owwa::findByNameOrFail($row['contract']);

                $archiveUser = ArchiveUser::updateOrCreate(
                    ['email' => $row['email']],
                    [
                        'first_name'     => $row['first_name'],
                        'middle_name'    => $row['middle_name'],
                        'last_name'      => $row['last_name'],
                        'contact_number' => $row['contact_number'],
                    ]
                );

                if (!empty($row['house_number']) || !empty($row['street'])) {
                    $this->updateOrCreateAddress($archiveUser, $row, $city, $barangay, $residence);
                }
                
                if (!empty($row['birthdate']) || !empty($row['age'])) {
                    $this->updateOrCreateInfo($archiveUser, $row, $gender, $education, $civil, $religion);
                }
                
                if (!empty($row['job_type']) || !empty($row['intent_return'])) {
                    $this->updateOrCreatePrevious($archiveUser, $row, $job, $sub_job, $continent, $country, $contract, $owwa);
                }

                return $archiveUser;
            } catch (ModelNotFoundException $e) {    
                \Log::error('Import Error: Related model not found.', [
                    'email'             => $row['email'],
                    'city'              => $row['city'],
                    'barangay'          => $row['barangay'],
                    'residence'         => $row['residence'],
                    'exception_message' => $e->getMessage(),
                ]);
                return null;
            }
        });
    }
    protected function updateOrCreateAddress($archiveUser, array $row, $city, $barangay, $residence)
    {
        $archiveUser->userArchiveAddress()->updateOrCreate(
            ['user_archive_id' => $archiveUser->id],
            [
                'house_number'    => $row['house_number'],
                'street'          => $row['street'],
                'city_id'         => $city->id,
                'barangay_id'     => $barangay->id,
                'residence_years' => $row['residence_years'] ?? null,
                'residence_id'    => $residence->id,
            ]
        );
    }

    protected function updateOrCreateInfo($archiveUser, array $row, $gender, $education, $civil, $religion)
    {
        $birthdate = Carbon::createFromFormat('m/d/Y', $row['birthdate'])->format('Y-m-d');

        $archiveUser->userArchiveInfo()->updateOrCreate(
            ['user_archive_id' => $archiveUser->id],
            [
                'birthdate'     => $birthdate,
                'age'           => $row['age'],
                'gender_id'     => $gender->id,
                'birthplace'    => $row['birthplace'],
                'religion_id'   => $religion->id,
                'civil_id'      => $civil->id,
                'present_job'   => $row['present_job'],
                'education_id'  => $education->id,
            ]
        );
    }

    protected function updateOrCreatePrevious($archiveUser, array $row, $job, $sub_job, $continent, $country, $contract, $owwa)
    {
        $departure = Carbon::createFromFormat('m/d/y', $row['departure'])->format('Y-m-d');
        $arrival = Carbon::createFromFormat('m/d/y', $row['arrival'])->format('Y-m-d');

        $archiveUser->userArchivePrevious()->updateOrCreate(
            ['user_archive_id'  =>  $archive->id],
            [
                'job_type'  =>  $row['job_type'],
                'job_id'    =>  $job->id,
                'sub_job_id'    =>  $sub_job->id,
                'continent_id'  =>  $continent->id,
                'country_id'    =>  $country->id,
                'years_abbroad' => $row['years_abroad'],
                'contract_id'    =>  $contract->id,
                'last_departure'    =>  $departure,
                'last_arrival'    =>  $arrival,
                'owwa_id'   =>  $owwa->id,
                'intent_return' =>  $row['intent_return']
            ]
        );

    }
}