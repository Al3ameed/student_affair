@extends('layout.master')

@section('body')

<div class="header my-5 ">
    <a class="d-inline-block" href="{{ route("students.index") }}">
        <i class="fa fa-angle-double-left fa-1x text-secondary" aria-hidden="true"></i>
    </a>
    <h3 class="d-inline-block ml-3"> التحكم بالدرجات </h3>

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
            <button type="button" class="btn btn-outline-danger ml-3" onclick="deleteGradeSections()"> مسح سكشن الدرجات <i class="fa fa-minus" aria-hidden="true"></i> </button>
            <button type="button" class="btn btn-outline-success" onclick="addGradeSections()"> اضافة سكشن بالدرجات <i class="fa fa-plus" aria-hidden="true"></i> </button>
        </div>

        {{-- YEAR + GPA  --}}
        @foreach ($grades as $grade)
            <div class="col-12 row grade-section">
                <div class="col-6">
                    <label> سنه التقدير </label>
                    <input required value="{{ $grade->year }}" type="number"  class="form-control" name="years[]">
                </div>
                <div class="col-6">
                    <label>التقدير السنوى  </label>
                    <input value="{{ $grade->gpa }}" required type="number" step="0.01"  class="form-control" name="gpas[]">
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
            <div class="col-6">
                <label> سنه التقدير </label>
                <input required type="number"  class="form-control" name="years[]">
            </div>
            <div class="col-6">
                <label> التقدير السنوى </label>
                <input required type="number" step="0.01" class="form-control" name="gpas[]">
            </div>
            <hr class="my-5" style="width: 60%; height: 1px;">
        </div>
      `);
    }
    function deleteGradeSections() {
        let sections = document.getElementsByClassName("grade-section");
        if(sections.length > 1)  { sections[0].remove(); }
    }
</script>
@endsection
