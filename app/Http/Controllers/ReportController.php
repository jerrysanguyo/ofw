<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_household_composition;
use App\Models\User_info;
use App\Models\User_need;
use App\Models\User_address;
use App\Models\User_previous_job;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    public function index()
    {
        return view('Report.index');
    }

    public function getAgeCount(Request $request)
    {
        $startAge = $request->input('startAge');
        $endAge = $request->input('endAge');
    
        $result = [];
    
        if ($startAge && $endAge) {
            for ($age = $startAge; $age <= $endAge; $age++) {
                $count = User_household_composition::where('age', $age)->count();
                if ($count > 0) {
                    $result[$age] = $count;
                }
            }
        }
    
        return response()->json(['counts' => $result]);
    }    

    public function ageExcel(Request $request)
    {
        $startAge = $request->input('startAge');
        $endAge = $request->input('endAge');
    
        $userMain = User::with([
            'userInfo.religion',
            'userInfo.gender',
            'userInfo.civil',
            'userInfo.education',
            'userAddress.barangay',
            'userAddress.city',
            'userAddress.residence',
            'userPrevious.job',
            'userPrevious.subJob',
            'userPrevious.continent',
            'userPrevious.country',
            'userPrevious.contract',
            'userPrevious.owwa',
            'userHousehold.relationship',
            'userNeeds',
        ])
        ->whereHas('userHousehold', function($query) use ($startAge, $endAge) {
            $query->whereBetween('age', [$startAge, $endAge]);
        })
        ->get();
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // HEADER
        $headers = [
            'FULL NAME', 'EMAIL ADDRESS', 'CONTACT NUMBER', 'BIRTHDATE', 'AGE',
            'GENDER', 'BIRTHPLACE', 'RELIGION', 'CIVIL STATUS','PRESENT JOB',
            'EDUCATIONAL ATTAINMENT', 'VOTERS?', 'ADDRESS', 'YEARS OF RESIDENCE IN TAGUIG', 'TYPE OF RESIDENCE',
            'JOB TYPE', 'JOB', 'SUB JOB', 'CONTINENT', 'COUNTRY', 'YEARS IN ABROAD', 'CONTRACT', 'LAST DEPARTURE', 'LAST ARRIVAL', 'OWWA', 'INTENT TO RETURN?',
            'FULL NAME', 'RELATIONSHIP', 'BIRTHDATE', 'AGE', 'WORK', 'MONTHLY INCOME', 'VOTERS?',
            'NEEDS',
        ];
        $sheet->fromArray($headers, null, 'A2');
        
        // Merge cells for main headers
        foreach (range('A', 'Z') as $columnID) {
            $sheet->mergeCells("{$columnID}1:{$columnID}2");
            $sheet->setCellValue("{$columnID}1", $headers[ord($columnID) - ord('A')]);
        }

        // Merge cells for "Beneficiaries" header
        $sheet->mergeCells('AA1:AH1');
        $sheet->setCellValue('AA1', 'Beneficiaries');
        $beneficiariesStyleArray = [
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => ['argb' => 'FF000000'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFFF00'
                ]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ]
        ];
        $sheet->getStyle('Y1:AG1')->applyFromArray($beneficiariesStyleArray);
        
        // HEADER STYLE
        $headerStyleArray = [
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => ['argb' => 'FF000000'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFFF00'
                ]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ]
        ];
        $sheet->getStyle('A1:AH2')->applyFromArray($headerStyleArray);
    
        // DATA
        $row = 3;
        foreach ($userMain as $main) {
            $filteredHouseholdData = $main->userHousehold->filter(function($household) use ($startAge, $endAge) {
                return $household->age >= $startAge && $household->age <= $endAge;
            });
    
            $needsData = [];
            foreach ($main->userNeeds as $needs) {
                $needsData[] = $needs->needs ?? '';
            }
    
            foreach ($filteredHouseholdData as $household) {
                $data = [
                    $main->last_name . ', ' . $main->first_name . ' ' . $main->middle_name,
                    $main->email,
                    $main->contact_number,
                    $main->userInfo->birthdate ?? '',
                    $main->userInfo->age ?? '',
                    $main->userInfo->gender->name ?? '',
                    $main->userInfo->birthplace ?? '',
                    $main->userInfo->religion->name ?? '',
                    $main->userInfo->civil->name ?? '',
                    $main->userInfo->present_job ?? '',
                    $main->userInfo->education->name ?? '',
                    $main->userInfo->voters ?? '',
                    $main->userAddress->house_number . ' ' . $main->userAddress->barangay->name . ' ' . $main->userAddress->street . ' ' . $main->userAddress->city->name ?? '',
                    $main->userAddress->residence_years ?? '',
                    $main->userAddress->residence->name ?? '',
                    $main->userPrevious->job_type ?? '',
                    $main->userPrevious->job->name ?? '',
                    $main->userPrevious->subjob->name ?? '',
                    $main->userPrevious->continent->name ?? '',
                    $main->userPrevious->country->name ?? '',
                    $main->userPrevious->years_abbroad ?? '',
                    $main->userPrevious->contract->name ?? '',
                    $main->userPrevious->last_departure ?? '',
                    $main->userPrevious->last_arrival ?? '',
                    $main->userPrevious->owwa->name ?? '',
                    $main->userPrevious->intent_return ?? '',
                    $household->full_name ?? '',
                    $household->relationship->name ?? '',
                    $household->birthdate ?? '',
                    $household->age ?? '',
                    $household->work ?? '',
                    $household->monthly_income ?? '',
                    $household->voters ?? '',
                    implode(', ', $needsData)
                ];
    
                $sheet->fromArray($data, null, 'A' . $row++);
            }
        }
    
        // BORDER TO ALL CELL
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ]
        ];
        $sheet->getStyle('A1:AH' . ($row - 1))->applyFromArray($styleArray);

        // AUTO RESIZE
        function getColumnRange($start, $end) {
            $columns = [];
            for ($i = $start; $i <= $end; $i++) {
                $columns[] = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i);
            }
            return $columns;
        }
        
        // Usage
        $startColumn = 1; 
        $endColumn = 34;
        
        $columns = getColumnRange($startColumn, $endColumn);
        
        foreach ($columns as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    
        $writer = new Xlsx($spreadsheet);
        $fileName = "AgeReport.xlsx";
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);
    
        return response()->download($temp_file, $fileName, ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }
}