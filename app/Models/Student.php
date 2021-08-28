<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "students";

    protected $fillable = [
        'id', 'name', 'dob', 'qualification', 'qualification_year' ,
        'secondry_school' , 'religion' , 'medical_exam' , 'level',
        'civil_registry' , 'pob' , 'foreign_nationality' ,
        'secondry_grade', 'gender', 'status', 'nationality',
        'student_number', 'university_email', 'student_id', 'img', 'father_name',
        'mother_name', 'father_job', 'mother_job', 'Address', 'governorate',
        'military_status', 'military_reason', 'military_date', 'military_number',
        'military_education' ,
        'military_education_date' ,
        'pob_gov' ,
        'three_numbers' ,
        'military_location' ,
        'national_id_date' , 'national_id'
    ];

    public function grades() {
        return $this->hasMany(student_grade::class , "student_id" , "id");
    }

    public function getDobAttribute()
    {
        return $this->attributes['dob'];
    }

    public function getAgeAttribute()
    {
         return Carbon::parse($this->attributes['dob'])->age;
    }

    public function fees() {
        return $this->hasMany(student_fees::class , "student_id" , "id");
    }
}
