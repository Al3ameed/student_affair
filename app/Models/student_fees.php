<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_fees extends Model
{
    use HasFactory;
    protected $table = "student_fees";

    protected $fillable = ['student_id' , 'id', 'amount', 'date', 'voucher_number'];

    public function student () {
        return $this->belongsTo(Student::class , 'student_id' , 'id');
    }
}
