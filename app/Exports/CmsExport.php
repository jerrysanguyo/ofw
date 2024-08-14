<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithMapping,
    WithHeadings,
    ShouldAutoSize,
};
use Illuminate\Support\Collection;

class CmsExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    protected $model;

    public function __construct($modelClass)
    {
        $this->model = new $modelClass;
    }

    public function collection(): Collection
    {
        return $this->model->with(['createdBy', 'updatedBy'])->get();
    }

    public function map($model): array
    {
        return [
            $model->name,
            optional($model->createdBy)->first_name . ' ' . optional($model->createdBy)->middle_name . ' ' . optional($model->createdBy)->last_name  ?? 'N/A',
            optional($model->updatedBy)->first_name . ' ' . optional($model->updatedBy)->middle_name . ' ' . optional($model->updatedBy)->last_name ?? 'N/A',
            $model->remarks ?? 'N/A',
            $model->created_at->format('Y-m-d H:i:s'),
            $model->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Created By',
            'Updated By',
            'Remarks',
            'Created At',
            'Updated At',
        ];
    }
}