<?php

namespace App\Exports;

use App\Models\Student;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class Report2Export implements FromCollection , WithMapping , WithHeadings ,WithColumnWidths
{
    protected $query = null;

    public function __construct($query) {
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query->get();
    }

    public function headings(): array
    {
        return [
          'الرقم التعريفى' , 'اسم الطالب' , 'النوع' , 'البريد الجامعى'
        ];
    }

    public function map($query): array
    {
        return [
            $query->id,
            $query->name,
            $query->gender == "0" ? "ذكر" : "انثي" ,
            $query->university_email
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
        ];
    }
}
