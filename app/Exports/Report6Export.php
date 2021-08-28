<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class Report6Export implements FromCollection , WithMapping , WithHeadings ,WithColumnWidths
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
          'الخدمة العسكرية' ,
          'رقم القرار  ' ,
          'التاريخ' ,
          'الرقم الثلاثى' ,
          'منطقة التجنيد'  ,
          'ملاحظات'
        ];
    }

    public function map($query): array
    {
        $military_status = null;
        if ($query->military_status == 1) {   $military_status = "اعفاء";}
        else if($query->military_status == 2)
        {   $military_status = "مؤجل";}
        else if($query->military_status == 3)
        {   $military_status = "تم اداء الخدمة";}
        else if($query->military_status == 4)
        {   $military_status = "لم يتم تحديد موقفة";}

        return [
            $query->id,
            $query->name,
            $military_status,
            $query->military_number,
            $query->military_date,
            $query->three_numbers,
            $query->military_location,
            $query->military_reason
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
