<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class Report7Export implements FromCollection , WithMapping , WithHeadings ,WithColumnWidths
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
          'الرقم التعريفى' ,
          'اسم الطالب' ,
          ' البريد الجامعى' ,
          'حالة القيد'
        ];
    }

    public function map($query): array
    {
        $status = null;
        if($query->latest_grades) {
            if ($query->latest_grades->student_Status == 0) {   $status = "مستجد";}
            else if($query->latest_grades->student_Status == 1)
            {   $status = "منقول";}
            else if($query->latest_grades->student_Status == 2)
            {   $status = "مستمر";}
            else {
                $status = "غير محددة" ;
            }
        } else {
            $status = "غير محددة" ;
        }

        return [
            $query->id,
            $query->student_id,
            $query->university_email,
            $status
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
