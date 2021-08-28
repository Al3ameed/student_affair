@extends('layout.master')

@section('body')

<div class="header my-5 ">
    <a class="d-inline-block" href="{{ route("students.index") }}">
        <i class="fa fa-angle-double-left fa-1x text-secondary" aria-hidden="true"></i>
    </a>
    <h3 class="d-inline-block ml-3"> التحكم بحالة الطالب </h3>

    <div class="clearfix"></div>
</div>

@if ( @session()->has('message') )
    <div class="bg rounded bg-success text-white p-2 my-2 mx-0">
        {{  session()->get('message') }}
    </div>
@endif

@foreach ($errors->all() as $message)
    <div class="bg rounded bg-danger text-white p-2 m-2 mx-0">
        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
        {{  $message }}
    </div>
@endforeach

<form action="{{ route("update_grade", $id) }}" method="post" >
    @csrf
    {{-- Student Data  --}}
    <div class="row mx-0 bg-blue p-3 py-5  d-flex position-relative gradeContainer">
        <span class="mandatory"> * اجبارى </span>

        {{-- Add New Grade  --}}
        <div class="col-12 d-flex justify-content-end mb-5">
            <button type="button" class="btn btn-outline-danger ml-3" onclick="deleteGradeSections()"> مسح حالة الطالب <i class="fa fa-minus" aria-hidden="true"></i> </button>
            <button type="button" class="btn btn-outline-success" onclick="addGradeSections()">اضافة حالة الطالب  <i class="fa fa-plus" aria-hidden="true"></i> </button>
        </div>

        {{-- YEAR + GPA  --}}
        @foreach ($grades as $grade)
            <div class="col-12 row grade-section">
                <div class="col-md-2 col-sm-4">
                    <label> سنه التقدير </label>
                    <input required value="{{ $grade->year }}" type="number"  class="form-control" name="years[]">
                </div>
                <div class="col-md-2 col-sm-4">
                    <label>التقدير السنوى  </label>
                    <input value="{{ $grade->gpa }}" required type="number" step="0.01"  class="form-control" name="gpas[]">
                </div>

                <div class="col-md-2">
                    <label for="student_Status">  قيد الطالب </label>
                    <select value="{{ old('student_Status') }}"  id="student_Status" class="form-control"  name="student_Status[]">
                        <option value="" disabled selected > برجاء الأختيار</option>
                        <option value="0" {{ $grade->student_Status == "0" ? "selected": "" }}> مستجد</option>
                        <option value="1" {{ $grade->student_Status == "1" ? "selected": "" }}> منقول</option>
                        <option value="2" {{ $grade->student_Status == "2" ? "selected": "" }}> مستمر</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="excellence_award">  مكأفاة التفوق </label>
                    <select value="{{ old('excellence_award') }}"  id="excellence_award" class="form-control"  name="excellence_award[]">
                        <option value="" disabled selected > برجاء الأختيار</option>
                        <option value="0" {{ $grade->excellence_award == "0" ? "selected": "" }}> امتياز</option>
                        <option value="1" {{ $grade->excellence_award == "1" ? "selected": "" }}> جيد جدا</option>
                        <option value="2" {{ $grade->excellence_award == "2" ? "selected": "" }}> جيد</option>
                        <option value="3" {{ $grade->excellence_award == "3" ? "selected": "" }}> لا توجد</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="excellence_award_recieved"> حصل على المكافأة  </label>
                    <select value="{{ old('excellence_award_recieved') }}"  id="excellence_award" class="form-control"  name="excellence_award_recieved[]">
                        <option value="" disabled selected > برجاء الأختيار</option>
                        <option value="1" {{ $grade->excellence_award_recieved == "1" ? "selected": "" }}> نعم </option>
                        <option value="0" {{ $grade->excellence_award_recieved == "0" ? "selected": "" }}> لا </option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="is_success"> النتيجة </label>
                    <select value="{{ old('is_success') }}"  id="is_success" class="form-control"  name="is_success[]">
                        <option value="" disabled selected > برجاء الأختيار</option>
                        <option value="1" {{ $grade->is_success == "1" ? "selected": "" }}> ناجح </option>
                        <option value="0" {{ $grade->is_success == "0" ? "selected": "" }}> راسب </option>
                    </select>
                </div>

                <hr class="my-5" style="width: 60%; height: 1px;">
            </div>
        @endforeach


    </div>

    <div class="row col-12 mx-0 px-0 my-5 justify-content-center">
      <div class="col-md-6 col-12">
        <button class="btn btn-block btn-outline-primary"> تحديث الدرجات </button>
      </div>
    </div>

</form>

<script>
    function addGradeSections() {
      $(".gradeContainer").append(`
        <div class="col-12 row grade-section">
            <div class="col-md-2 col-sm-4">
                <label> سنه التقدير </label>
                <input required type="number"  class="form-control" name="years[]">
            </div>

            <div class="col-md-2 col-sm-4">
                <label> التقدير السنوى </label>
                <input required type="number" step="0.01" class="form-control" name="gpas[]">
            </div>

            <div class="col-md-2">
                <label for="student_Status">  قيد الطالب </label>
                <select  id="student_Status" class="form-control"  name="student_Status[]">
                    <option value="" disabled selected > برجاء الأختيار</option>
                    <option value="0"> مستجد</option>
                    <option value="1"> منقول</option>
                    <option value="2"> مستمر</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="excellence_award">  مكأفاة التفوق </label>
                <select  id="excellence_award" class="form-control"  name="excellence_award[]">
                    <option value="" disabled selected > برجاء الأختيار</option>
                    <option value="0" > امتياز</option>
                    <option value="1" > جيد جدا</option>
                    <option value="2" > جيد</option>
                    <option value="3" > لا توجد</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="excellence_award_recieved"> حصل على المكافأة  </label>
                <select  id="excellence_award" class="form-control"  name="excellence_award_recieved[]">
                    <option value="" disabled selected > برجاء الأختيار</option>
                    <option value="1" > نعم </option>
                    <option value="0" > لا </option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="is_success"> النتيجة </label>
                <select  id="is_success" class="form-control"  name="is_success[]">
                    <option value="" disabled selected > برجاء الأختيار</option>
                    <option value="1" > ناجح </option>
                    <option value="0" > راسب </option>
                </select>
            </div>

            <hr class="my-5" style="width: 60%; height: 1px;">
        </div>
      `);
    }
    function deleteGradeSections() {
        let sections = document.getElementsByClassName("grade-section");
        if(sections.length >= 1)  { sections[sections.length - 1].remove(); }
    }
</script>
@endsection
