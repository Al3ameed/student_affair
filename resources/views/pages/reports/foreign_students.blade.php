@extends('layout.master')

@section('body')

<div class="header my-5">
    <h3 class=" float-right"> الطلاب الاجانب</h3>
    <div class="clearfix"></div>
</div>

@if ( @session()->has('message') )
    <div class="bg rounded bg-success text-white p-2 m-2">
        {{  session()->get('message') }}
    </div>
@endif

<div class="filter-section bg-light px-0">
    <form method="get" action="" class="row col-12 mx-0 px-0 d-flex justify-content-start">

        <div class="col-md-3 sol-sm-6  col-sm-6 col-12">
            <select class="form-control" placeholder="Select Level" class="form-control" name="f_level">
                <option value="" > جميع المستويات </option>
                <option value="1" {{ request("f_level") == "1" ? "selected" : "" }}>  المستوى الاول</option>
                <option value="2" {{ request("f_level") == "2" ? "selected" : "" }}> المستوى الثاني</option>
                <option value="3" {{ request("f_level") == "3" ? "selected" : "" }}>  المستوى الثالث</option>
                <option value="4" {{ request("f_level") == "4" ? "selected" : "" }}>  المستوى الرابع</option>
            </select>
        </div>

        <div class="col-md-2 sol-sm-6  col-sm-6 col-12">
            <select class="form-control" placeholder="فلترة" class="form-control" name="f_sort">
                <option value="" > فلتر </option>
                <option value="asc" {{ request("f_sort") == "asc" ? "selected" : "" }}>  ابجدى ( أ - ى )</option>
                <option value="desc" {{ request("f_sort") == "desc" ? "selected" : "" }}>  ابجدى ( ى - أ )</option>
            </select>
        </div>

        <div class="col-md-4 sol-sm-6">
            <button class="btn btn-outline-primary"> بحث</button>
        </div>
    </form>
</div>

<div class="table-responsive">

    <form action="" method="get" class="col-12 text-right mb-3">
        <input type="hidden" name="excel" value="yes">
        <input type="hidden" name="f_level" value="{{ request("f_level") }}">
        <input type="hidden" name="f_sort" value="{{ request("f_sort") }}">
        <button  type="submit" class="btn btn-success"> طباعة التقرير  <i class="fas fa-file-csv ml-2"></i> </button>
    </form>

    <table class="table table-light table-striped table-hover">
        <thead>
            <th> # </th>
            <th> الرقم التعريفى </th>
            <th> اسم الطالب </th>
            <th> النوع </th>
            <th> البريد الجامعى </th>
        </thead>
    <tbody>

        @forelse ($students as $key=>$student)
            <tr>
                <td> {{ $student->id }}  </td>
                <td> {{ $student->student_id }}  </td>
                <td> {{ $student->name }}  </td>
                <td> {{ $student->gender == "0" ? "ذكر" : "انثي" }}  </td>
                <td> {{ $student->university_email }}  </td>
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
