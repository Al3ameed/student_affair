@extends('layout.master')

@section('body')

<div class="header my-5">
    <h3 class=" float-right"> اعمار الطلاب </h3>
    <div class="clearfix"></div>
</div>

@if ( @session()->has('message') )
    <div class="bg rounded bg-success text-white p-2 m-2">
        {{  session()->get('message') }}
    </div>
@endif

<div class="filter-section bg-light px-0">
    <form method="get" action="" class="row col-12 mx-0 px-0 d-flex justify-content-start">
        <div class="col-md-4 sol-sm-6 p-0 col-sm-6 col-12">
            <input value="{{ request("f_age")? request("f_age"):"" }}" class="form-control" name="f_age" placeholder="العمر اكبر من او يساوى" >
        </div>
        <div class="col-md-4 sol-sm-6">
            <button class="btn btn-outline-primary"> بحث</button>
        </div>
    </form>
</div>

<div class="table-responsive">

    <form method="get" class="col-12 text-right mb-3">
        <input type="hidden" name="excel" value="yes">
        <input type="hidden" name="f_age" value="{{ request("f_age") }}">
        <button  type="submit" class="btn btn-success"> طباعة التقرير  <i class="fas fa-file-csv ml-2"></i> </button>
    </form>

    <table class="table table-light table-striped table-hover">
    <thead>
        <th> # </th>
        <th> الرقم التعريفى </th>
        <th> اسم الطالب </th>
        <th> البريد الجامعى </th>
        <th> العمر  </th>
    </thead>
    <tbody>

        @forelse ($students as $key=>$student)
            <tr>
                <td> {{ $student->id }}  </td>
                <td> {{ $student->student_id }}  </td>
                <td> {{ $student->name }}  </td>
                <td> {{ $student->university_email }}  </td>
                <td> {{ $student->dob }} </td>
            </tr>
            @empty

        @endforelse

    </tbody>
 </table>

 <div class="col-12 row d-flex justify-content-center">
    {{ $students->appends($_GET)->links("pagination::bootstrap-4") }}
 </div>

</div>

@endsection
