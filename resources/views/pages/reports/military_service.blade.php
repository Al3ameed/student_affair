@extends('layout.master')

@section('body')

<div class="header my-5">
    <h3 class=" float-right">حاله الخدمة العسكريه</h3>
    <div class="clearfix"></div>
</div>

@if ( @session()->has('message') )
    <div class="bg rounded bg-success text-white p-2 m-2">
        {{  session()->get('message') }}
    </div>
@endif

<div class="filter-section bg-light px-0">
    <form method="get"  class="row col-12 mx-0 px-0 d-flex justify-content-start">
        <div class="col-md-3 sol-sm-4 pl-0  col-12">
            <select class="form-control" name="f_m_state">
                <option value="" >حاله الخدمة العسكريه</option>
                <option value="1" {{ request("f_m_state") == "1" ? "selected" : "" }}>اعفاء</option>
                <option value="2" {{ request("f_m_state") == "2" ? "selected" : "" }}> مؤجل</option>
                <option value="3" {{ request("f_m_state") == "3" ? "selected" : "" }}> تم اداء الخدمة</option>
                <option value="4" {{ request("f_m_state") == "4" ? "selected" : "" }}> لم يتم تحديد موقفة من التجنيد</option>
            </select>
        </div>

        <div class="col-md-2 sol-sm-6  col-sm-6 col-12">
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
        <input type="hidden" name="f_m_state" value="{{ request("f_m_state") }}">
        <input type="hidden" name="f_level" value="{{ request("f_level") }}">
        <input type="hidden" name="f_sort" value="{{ request("f_sort") }}">
        <button  type="submit" class="btn btn-success"> طباعة التقرير  <i class="fas fa-file-csv ml-2"></i> </button>
    </form>

    <table class="table table-light table-striped table-hover">
    <thead>
        <th> # </th>
        <th> الرقم التعريفى </th>
        <th> اسم الطالب </th>
        <th>  الخدمة العسكرية </th>
        <th> رقم القرار   </th>
        <th> التاريخ </th>
        <th> الرقم الثلاثى </th>
        <th> منطقة التجنيد </th>
    </thead>
    <tbody>

        @forelse ($students as $key=>$student)
            <tr class="{{ ($student->military_status == 1 || $student->military_status == 3) ? "f_m_state_c" : "f_m_state_ic" }}">
                <td> {{ $student->id }}  </td>
                <td> {{ $student->student_id }}  </td>
                <td> {{ $student->name }}  </td>

                <td>
                    @if ($student->military_status == 1)
                        اعفاء
                    @elseif($student->military_status == 2)
                        مؤجل
                    @elseif($student->military_status == 3)
                        تم اداء الخدمة
                    @elseif($student->military_status == 4)
                        لم يتم تحديد موقفة
                    @endif
                </td>

                <td> {{ $student->military_number }}  </td>
                <td> {{ $student->military_date }}  </td>
                <td> {{ $student->three_numbers }}  </td>
                <td> {{ $student->military_location }}  </td>

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
