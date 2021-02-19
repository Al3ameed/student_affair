<?php

namespace App\Exports;

use App\Models\Student;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class Report3Export implements FromCollection , WithMapping , WithHeadings ,WithColumnWidths
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
          'البريد الجامعى' ,
          'المستوى' ,
          'النوع' ,
          'المحافظة'
        ];
    }

    public function map($query): array
    {
        return [
            $query->id,
            $query->name,
            $query->university_email,
            $query->level,
            $query->gender == "0" ? "ذكر" : "انثي" ,
            $this->getGovernate($query->governorate)
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

    function getGovernate($governate) {
        if ($governate == 1) {return "Cairo"; }
        if ($governate == 2) {return "Giza";}
        if ($governate == 3) {return "Alexandria";}
        if ($governate == 4) {return "Dakahlia";}
        if ($governate == 5) {return "Red Sea";}
        if ($governate == 6) {return "Beheira";}
        if ($governate == 7) {return "Fayoum";}
        if ($governate == 8) {return "Gharbiya";}
        if ($governate == 9) {return "Ismailia";}
        if ($governate == 10) {return "Monofia";}
        if ($governate == 11) {return "Minya";}
        if ($governate == 12) {return "Qaliubiya";}
        if ($governate == 13) {return "New Valley";}
        if ($governate == 14) {return "Suez";}
        if ($governate == 15) {return "Aswan";}
        if ($governate == 16) {return "Assiut";}
        if ($governate == 17) {return "Beni Suef";}
        if ($governate == 18) {return "Port Said";}
        if ($governate == 19) {return "Damietta";}
        if ($governate == 20) {return "Sharkia";}
        if ($governate == 21) {return "South Sinai";}
        if ($governate == 22) {return "Kafr Al sheikh";}
        if ($governate == 23) {return "Matrouh";}
        if ($governate == 24) {return "Luxor";}
        if ($governate == 25) {return "Qena";}
        if ($governate == 26) {return "North Sinai";}
        if ($governate == 27) { return "Sohag";}
    }
}
