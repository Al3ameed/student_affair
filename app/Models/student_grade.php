<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_grade extends Model
{
    use HasFactory;
    protected $table = "student_grades";

    protected $fillable = [ 'id', 'year', 'gpa', 'student_id' ];

    public function student () {
        return $this->belongsTo(Student::class , 'student_id' , 'id');
    }

}
