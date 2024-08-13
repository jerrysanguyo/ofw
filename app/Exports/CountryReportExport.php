<?php

namespace App\Exports;

use App\Models\{User, Type_country};
use Maatwebsite\Excel\Concerns\{WithMapping, WithHeadings, FromCollection, WithStyles, WithCustomStartCell, WithEvents};
use App\Exports\Traits\ExcelStylingTrait;

class CountryReportExport implements WithMapping, WithHeadings, FromCollection, WithStyles, WithCustomStartCell, WithEvents
{
    use ExcelStylingTrait; 
    
    protected $country;

    public function __construct(Type_country $country)
    {
        $this->country = $country;
    }

    public function collection()
    {
        return User::whereHas('userPrevious', function ($query) {
            $query->where('country_id', $this->country->id);
        })
        ->with(['userInfo', 'userAddress', 'userPrevious', 'userHousehold', 'userNeeds'])
        ->get();
    }

    public function map($user): array
    {
        $householdNames = $user->userHousehold->pluck('full_name')->implode(', ');
        $householdRelationships = $user->userHousehold->pluck('relationship.name')->implode(', ');
        $householdBirthdates = $user->userHousehold->pluck('birthdate')->implode(', ');
        $householdAges = $user->userHousehold->pluck('age')->implode(', ');
        $householdWorks = $user->userHousehold->pluck('work')->implode(', ');
        $householdIncomes = $user->userHousehold->pluck('monthly_income')->implode(', ');
        $householdVoters = $user->userHousehold->pluck('voters')->implode(', ');
        $userNeeds = $user->userNeeds->pluck('typeNeeds.name')->implode(', ');

        return [
            $user->last_name . ', ' . $user->first_name . ' ' . $user->middle_name,
            $user->userAddress->house_number . ' ' . $user->userAddress->barangay->name . ' ' . $user->userAddress->street . ' ' . $user->userAddress->city->name ?? '',
            $user->contact_number,
            $user->userInfo->birthdate ?? '',
            $user->userInfo->age ?? '',
            $user->userInfo->gender->name ?? '',
            $user->userInfo->civil->name ?? '',
            $user->email,
            $user->userInfo->birthplace ?? '',
            $user->userInfo->religion->name ?? '',
            $user->userInfo->present_job ?? '',
            $user->userInfo->education->name ?? '',
            $user->userInfo->voters ?? '',
            $user->userAddress->residence_years ?? '',
            $user->userAddress->residence->name ?? '',
            $user->userPrevious->job_type ?? '',
            $user->userPrevious->job->name ?? '',
            $user->userPrevious->subjob->name ?? '',
            $user->userPrevious->continent->name ?? '',
            $this->country->name,
            $user->userPrevious->years_abbroad ?? '',
            $user->userPrevious->contract->name ?? '',
            $user->userPrevious->last_departure ?? '',
            $user->userPrevious->last_arrival ?? '',
            $user->userPrevious->owwa->name ?? '',
            $user->userPrevious->intent_return ?? '',
            $householdNames,
            $householdRelationships,
            $householdBirthdates,
            $householdAges,
            $householdWorks,
            $householdIncomes,
            $householdVoters,
            $userNeeds,
        ];
    }

    public function headings(): array
    {
        return [
            'FULL NAME', 'ADDRESS', 'CONTACT NUMBER', 'BIRTHDATE', 'AGE', 'GENDER', 'CIVIL STATUS',
            'EMAIL ADDRESS', 'BIRTHPLACE', 'RELIGION', 'PRESENT JOB',
            'EDUCATIONAL ATTAINMENT', 'VOTERS?', 'YEARS OF RESIDENCE IN TAGUIG', 'TYPE OF RESIDENCE',
            'JOB TYPE', 'JOB', 'SUB JOB', 'CONTINENT', 'COUNTRY', 'YEARS IN ABROAD', 'CONTRACT', 'LAST DEPARTURE', 'LAST ARRIVAL', 'OWWA', 'INTENT TO RETURN?',
            'HOUSEHOLD NAMES', 'RELATIONSHIPS', 'BIRTHDATES', 'AGES', 'WORKS', 'INCOMES', 'VOTERS?',
            'NEEDS',
        ];
    }
}