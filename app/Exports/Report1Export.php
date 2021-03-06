<?php

namespace App\Exports;

use App\Models\Student;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class Report1Export implements FromCollection , WithMapping , WithHeadings ,WithColumnWidths
{
    protected $query = null;

    public function __construct($query) {
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query->with('student')->get();
    }

    public function headings(): array
    {
        return [
          'الرقم التعريفى' , 'اسم الطالب' , 'الريد الجامعى' , 'المستوي' , 'عام التقدير ' , '  التقدير السنوى '
        ];
    }

    public function map($query): array
    {
        return [
            $query->student_id,
            $query->student->name,
            $query->student->university_email,
            $query->student->level,
            $query->year,
            $query->gpa,
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
