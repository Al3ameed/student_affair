@extends('layout.master')

@section('body')

<div class="header my-5 ">
    <a class="d-inline-block" href="{{ route("students.index") }}">
        <i class="fa fa-angle-double-left fa-1x text-secondary" aria-hidden="true"></i>
    </a>
    <h3 class="d-inline-block ml-3"> التحكم بالمعاملات المالية </h3>

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

<form action="{{ route("update_fees", $id) }}" method="post" >
    @csrf
    {{-- Student Data  --}}
    <div class="row mx-0 bg-blue p-3 py-5  d-flex position-relative gradeContainer">
        <span class="mandatory"> * اجبارى </span>

        {{-- Add New Grade  --}}
        <div class="col-12 d-flex justify-content-end mb-5">
            <button type="button" class="btn btn-outline-danger ml-3" onclick="deleteSection()"> مسح  معامله ماليه <i class="fa fa-minus" aria-hidden="true"></i> </button>
            <button type="button" class="btn btn-outline-success" onclick="addSections()"> اضافة معامله ماليه <i class="fa fa-plus" aria-hidden="true"></i> </button>
        </div>

        {{-- YEAR + GPA  --}}
        @foreach ($fees as $fee)
            <div class="col-12 row grade-section">

                <div class="col-4">
                    <label> المبلغ </label>
                    <input  value="{{ $fee->amount }}" step="0.01" type="number"  class="form-control" name="amount[]">
                </div>

                <div class="col-4">
                    <label> تاريخ المعامله </label>
                    <input  value="{{ $fee->date }}" type="date"  class="form-control" name="date[]">
                </div>

                <div class="col-4">
                    <label> رقم قسيمه</label>
                    <input value="{{ $fee->voucher_number }}"  type="text" class="form-control" name="voucher_number[]">
                </div>

                <hr class="my-5" style="width: 60%; height: 1px;">
            </div>
        @endforeach


    </div>

    <div class="row col-12 mx-0 px-0 my-5 justify-content-center">
      <div class="col-md-6 col-12">
        <button class="btn btn-block btn-outline-primary"> تحديث المعاملات المالية </button>
      </div>
    </div>

</form>

<script>
    function addSections() {
      $(".gradeContainer").append(`
        <div class="col-12 row grade-section">

            <div class="col-4">
                <label> المبلغ </label>
                <input   type="number" step="0.01"  class="form-control" name="amount[]">
            </div>

            <div class="col-4">
                <label> تاريخ المعامله </label>
                <input  type="date"  class="form-control" name="date[]">
            </div>

            <div class="col-4">
                <label> رقم قسيمه</label>
                <input type="text" class="form-control" name="voucher_number[]">
            </div>

            <hr class="my-5" style="width: 60%; height: 1px;">
        </div>
      `);
    }
    function deleteSection() {
        let sections = document.getElementsByClassName("grade-section");
        if(sections.length >= 1)  { sections[sections.length - 1].remove(); }
    }
</script>
@endsection
