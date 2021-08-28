<?php

namespace App\Http\Controllers;

use App\Http\Requests\studentRequest;
use App\Models\Student;
use App\Models\student_fees;
use App\Models\student_grade;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function home () {
        return view('pages.home');
    }

    public function index (Request $request) {
        $conditions = $this->getFilters($request);
        $query = new Student();
        $query = $conditions != [] ? $query->where($conditions) : $query;
        $query = $query->paginate(10);
        return view('pages.students.list' , ['students'=> $query]);
    }

    public function create () {
        return view('pages.students.add');
    }

    public function store (studentRequest $request) {
        try {
            $attributes = $request->all();
            if($request->img) {
                // SAVE Image First
                $imageName = $this->uploadImage($request->img , $request , false);
                $attributes['img'] =  $imageName;
            }
            // SAVE STUDENT DATA
            Student::Create($attributes);
            return redirect()->back()->with(["message" => "تم اضافة الطالب بنجاح"]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => "حدث خطأ برجاء المحاولة مرة اخرى"]);
        }
    }

    public function edit (studentRequest $request) {
        $student = Student::findOrFail($request->student);
        return view('pages.students.edit' , ['student' => $student]);
    }

    public function update (studentRequest $request) {
        try {
            $attributes = $request->all();
            $student = Student::find($attributes['student']);
            // SAVE Image First
            if($request->img) {
                $imageName = $this->uploadImage($request->img , $request , $student->img);
                $attributes['img'] =  $imageName;
            }
            // UPDATE STUDENT DATA
            $student->update($attributes);
            return redirect()->back()->with(["message" => "تم تحديث بيانات الطالب بنجاح"]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => "حدث خطأ برجاء المحاولة مرة اخرى"]);
        }
    }

    public function grades($id) {
        $student = Student::findOrFail($id);
        return view('pages.students.grade' , [
            'grades' => $student->grades ,
            'id' => $id
        ]);
    }

    public function update_grades(Request $request ,$id) {
        $request->validate([
            'years' => 'array' ,
            'years.*' => 'required|numeric|digits:4' ,
            'gpas' => 'array' ,
            'gpas.*' => 'required|numeric|min:.1|max:4' ,

            'student_Status' => 'array' ,
            'student_Status.*' => 'nullable|numeric|between:0,2' ,

            'excellence_award' => 'array' ,
            'excellence_award.*' => 'nullable|numeric|between:0,3' ,

            'excellence_award_recieved' => 'array' ,
            'excellence_award_recieved.*' => 'nullable|numeric|between:0,1' ,

            'is_success' => 'array' ,
            'is_success.*' => 'nullable|numeric|between:0,1' ,

        ]);
        $student = Student::findOrFail($id);
        $student->grades()->delete();
        if($request->years) {
            foreach($request->years as $index=>$key) {
                student_grade::Create([
                    'student_id' => $id ,
                    'year' => $request->years[$index] ,
                    'gpa' => $request->gpas[$index],

                    'student_Status' => $request->student_Status[$index],
                    'excellence_award' => $request->excellence_award[$index],
                    'excellence_award_recieved' => $request->excellence_award_recieved[$index],
                    'is_success' => $request->is_success[$index],

                ]);
            }
        }
        return redirect()->back()->with(["message" => "تم تحديث درجات الطالب بنجاح"]);
    }

    public function fees($id) {
        $student = Student::findOrFail($id);
        return view('pages.students.fees' , [
            'fees' => $student->fees ,
            'id' => $id
        ]);
    }

    public function update_fees(Request $request ,$id) {
        $request->validate([
            'amount' => 'array' ,
            'amount.*' => 'required|numeric' ,

            'date' => 'array' ,
            'date.*' => 'required|date' ,

            'voucher_number' => 'array' ,
            'voucher_number.*' => 'required|string' ,
        ]);
        $student = Student::findOrFail($id);
        $student->fees()->delete();
        if($request->date) {
            foreach($request->date as $index=>$key) {
                student_fees::Create([
                    'student_id' => $id ,
                    'amount' => $request->amount[$index] ,
                    'date' => $request->date[$index] ,
                    'voucher_number' => $request->voucher_number[$index]
                ]);
            }
        }
        return redirect()->back()->with(["message" => "تم تحديث المعاملات المالية للطالب بنجاح"]);
    }

    public function uploadImage ($img , $request , $delete_old) {
        $imageName = time().'.'.$img->extension();
        $request->img->move(public_path('images/students'), $imageName);
        if ($delete_old != false) {
                $file_path = public_path().'/images/students/'.$delete_old;
                if(file_exists($file_path)) {  unlink($file_path); }
        }
        return $imageName;
    }

    public function getFilters($request) {
        $filter = [];
        if($request->f_name && $request->f_name != null) { $filter[] = ['name' , 'like' , '%' .$request->f_name. '%'];}
        if($request->f_id && $request->f_id != null) { $filter[] = ['student_id' ,'like' , '%' .$request->f_id. '%'];}
        if($request->f_level && $request->f_level != "all") { $filter[] = ['level' , $request->f_level];}
        if($request->f_status != null && $request->f_status != "all") { $filter[] = ['status', $request->f_status];}
        return $filter;
    }

    public function destroy (studentRequest $request) {
        $student = Student::find($request->student);
        $student->grades()->delete();
        $student->delete();
        return response()->json("student deleted successfully" , 200);
    }
}
