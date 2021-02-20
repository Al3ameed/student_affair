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
        'id', 'name', 'dob', 'qualification', 'qualification_year_from' ,
        'qualification_year_to' , 'level',
        'secondry_grade', 'gender', 'status', 'nationality', 'national_id',
        'student_number', 'university_email', 'student_id', 'img', 'father_name',
        'mother_name', 'father_job', 'mother_job', 'Address', 'governorate',
        'military_status', 'military_reason', 'military_date', 'military_number',
        'military_education'
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
}
