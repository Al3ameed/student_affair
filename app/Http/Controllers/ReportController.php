<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\student_grade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Report1Export;
use App\Exports\Report2Export;
use App\Exports\Report3Export;
use App\Exports\Report4Export;
use App\Exports\Report5Export;

class ReportController extends Controller
{

    function excellent_students() {
        $query = student_grade::OrderBy("gpa" , "desc");
        if(request("f_year") && request("f_year") != null) {
            $query = $query->where("year" , request("f_year"));
        }
        if(request("f_level") && request("f_level") != null) {
            $query = $query->whereHas('student' , function (Builder $q)  {
                $q->where("level" , request("f_level"));
            });
        }
        if(request('excel') && request('excel') != null) {
            return Excel::download(new Report1Export($query), 'report.xlsx');
        }

        $grades = $query->groupBy(['student_id'])->paginate(10);
        return view('pages.reports.excellent_students' , [
            'grades' => $grades
        ]);
    }

    function governorates () {
        $query = new Student();
        if(request("f_gender") != null) {
            $query = $query->where("gender" , request("f_gender"));
        }
        if(request("f_governorate") && request("f_governorate") != null) {
            $query = $query->where("governorate" , request("f_governorate"));
        }
        if(request("f_level") && request("f_level") != null) {
            $query = $query->where("level" , request("f_level"));
        }
        if(request("f_sort") && request("f_sort") != null) {
            $query = $query->orderBy("name" ,request('f_sort'));
        } else {
            $query = $query->orderBy("governorate" , "asc");
        }
        if(request('excel') && request('excel') != null) {
            return Excel::download(new Report3Export($query), 'report.xlsx');
        }
        $students = $query->paginate(10);
        return view('pages.reports.governorates' , ['students' => $students]);
    }

    function military_education () {
        $query = new Student();
        if(request("f_m_state") != null) {
            $query = $query->where("military_education" , request("f_m_state"));
        }
        if(request("f_level") && request("f_level") != null) {
            $query = $query->where("level" , request("f_level"));
        }
        if(request("f_sort") && request("f_sort") != null) {
            $query = $query->orderBy("name" ,request('f_sort'));
        } else {
            $query = $query->orderBy("name" , "asc");
        }
        if(request('excel') && request('excel') != null) {
            return Excel::download(new Report4Export($query), 'report.xlsx');
        }
        $students = $query->paginate(10);
        return view('pages.reports.military_education', ['students' => $students]);
    }

    function student_ages () {
        $query = new Student();
        if(request("f_age") != null) {
            $age = Carbon::now()->subYear(request("f_age"))->toDateTimeString();
            $query = $query->where("dob" , "<=" , $age);
        }
        if(request("f_level") && request("f_level") != null) {
            $query = $query->where("level" , request("f_level"));
        }
        if(request("f_sort") && request("f_sort") != null) {
            $query = $query->orderBy("name" ,request('f_sort'));
        } else {
            $query = $query->orderBy("name" , "asc");
        }
        if(request('excel') && request('excel') != null) {
            return Excel::download(new Report5Export($query), 'report.xlsx');
        }
        $students = $query->paginate(10);
        return view('pages.reports.student_ages', ['students' => $students]);
    }

    function foreign_students () {
        $query = new Student();
        if(request("f_level") && request("f_level") != null) {
            $query = $query->where("level" , request("f_level"));
        }
        if(request("f_sort") && request("f_sort") != null) {
            $query = $query->orderBy("name" ,request('f_sort'));
        } else {
            $query = $query->orderBy("name" , "asc");
        }
        $query = $query->where("nationality" , "1");
        if(request('excel') && request('excel') != null) {
            return Excel::download(new Report2Export($query), 'report.xlsx');
        }
        $students = $query->paginate(10);
        return view('pages.reports.foreign_students' ,['students' => $students]);
    }
}
