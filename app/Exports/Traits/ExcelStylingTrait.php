<?php

namespace App\Exports\Traits;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Events\AfterSheet;

trait ExcelStylingTrait
{
    public function styles(Worksheet $sheet)
    {
        return [
            2 => [
                'font' => [
                    'bold' => true,
                    'size' => 13,
                    'color' => ['argb' => 'FF000000'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFFF00'],
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ],
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Apply styles to the header
                $sheet->getStyle('A1:Z1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 13,
                        'color' => ['argb' => 'FF000000'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFFF00'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Merge cells for main headers
                foreach (range('A', 'Z') as $columnID) {
                    $sheet->mergeCells("{$columnID}1:{$columnID}2");
                    $sheet->setCellValue("{$columnID}1", $this->headings()[ord($columnID) - ord('A')]);
                }

                // Merge cells for "Beneficiaries" header
                $sheet->mergeCells('AA1:AH1');
                $sheet->setCellValue('AA1', 'Beneficiaries');
                $sheet->getStyle('AA1:AH1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 13,
                        'color' => ['argb' => 'FF000000'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFFF00'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Apply border to all cells
                $sheet->getStyle('A1:AH' . ($sheet->getHighestRow()))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Auto-size columns
                $columnRange = array_merge(range('A', 'Z'), range('AA', 'AH'));
                foreach ($columnRange as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}
