@extends('layout.master')

@section('body')

<div class="header my-5">
    <h3 class=" float-right"> المحافظات</h3>
    <div class="clearfix"></div>
</div>

@if ( @session()->has('message') )
    <div class="bg rounded bg-success text-white p-2 m-2">
        {{  session()->get('message') }}
    </div>
@endif

<div class="filter-section bg-light px-0">
    <form method="get" action="" class="row col-12 mx-0 px-0 d-flex justify-content-start">

        <div class="col-md-3 sol-sm-4 pl-0  col-12">
            <select id="s_governace" class="form-control"  name="f_governorate">
                <option value="1" {{ request("f_governorate") == "1" ? "selected": "" }}>القاهرة</option>
                <option value="2" {{ request("f_governorate") == "2" ? "selected": "" }}> الجيزة</option>
                <option value="3" {{ request("f_governorate") == "3" ? "selected": "" }}> الاسكندرية</option>
                <option value="4" {{ request("f_governorate") == "4" ? "selected": "" }}> الدقهلية </option>
                <option value="5" {{ request("f_governorate") == "5" ? "selected": "" }}> البحر الاحمر   </option>
                <option value="6" {{ request("f_governorate") == "6" ? "selected": "" }}> البحيره </option>
                <option value="7" {{ request("f_governorate") == "7" ? "selected": "" }}>الفيوم</option>
                <option value="8" {{ request("f_governorate") == "8" ? "selected": "" }}> الغربية</option>
                <option value="9" {{ request("f_governorate") == "9" ? "selected": "" }}> الاسماعيلية</option>
                <option value="10" {{ request("f_governorate") == "10" ? "selected": "" }}> المنوفيه </option>
                <option value="11" {{ request("f_governorate") == "11" ? "selected": "" }}> المنيا </option>
                <option value="12" {{ request("f_governorate") == "12" ? "selected": "" }}> القليوبية </option>
                <option value="13" {{ request("f_governorate") == "13" ? "selected": "" }}>الوادى الجديد</option>
                <option value="14" {{ request("f_governorate") == "14" ? "selected": "" }}> سينا</option>
                <option value="15" {{ request("f_governorate") == "15" ? "selected": "" }}> اسوان</option>
                <option value="16" {{ request("f_governorate") == "16" ? "selected": "" }}> اسيوط </option>
                <option value="17" {{ request("f_governorate") == "17" ? "selected": "" }}> بنى سويف</option>
                <option value="18" {{ request("f_governorate") == "18" ? "selected": "" }}> بورسعيد </option>
                <option value="19" {{ request("f_governorate") == "19" ? "selected": "" }}> دمياط </option>
                <option value="20" {{ request("f_governorate") == "20" ? "selected": "" }}> شرقيه </option>
                <option value="21" {{ request("f_governorate") == "21" ? "selected": "" }}> جنوب سينا </option>
                <option value="22" {{ request("f_governorate") == "22" ? "selected": "" }}> كفر الشيخ </option>
                <option value="23" {{ request("f_governorate") == "23" ? "selected": "" }}> مطروح </option>
                <option value="24" {{ request("f_governorate") == "24" ? "selected": "" }}> الاقصر </option>
                <option value="25" {{ request("f_governorate") == "25" ? "selected": "" }}> قنا </option>
                <option value="26" {{ request("f_governorate") == "26" ? "selected": "" }}> شمال سينا </option>
                <option value="27" {{ request("f_governorate") == "27" ? "selected": "" }}> سوهاج </option>
            </select>
        </div>

        <div class="col-md-3 sol-sm-4 pl-0  col-12">
            <select class="form-control" name="f_gender">
                <option value=""> اختار النوع</option>
                <option value="0" {{ request("f_gender") == "0" ? "selected" : "" }}> ذكر</option>
                <option value="1" {{ request("f_gender") == "1" ? "selected" : "" }}> انثى</option>
            </select>
        </div>

        <div class="col-md-4 sol-sm-6">
            <button class="btn btn-outline-primary"> بحث</button>
        </div>
    </form>
</div>

<div class="table-responsive">

    <form action="" method="get" class="col-12 text-right mb-3">
        <input  type="hidden" name="excel" value="yes">
        <input  type="hidden" name="f_gender" value="{{ request("f_gender") }}">
        <input  type="hidden" name="f_governorate" value="{{ request("f_governorate") }}">
        <button type="submit" class="btn btn-success"> طباعة التقرير  <i class="fas fa-file-csv ml-2"></i> </button>
    </form>

    <table class="table table-light table-striped table-hover">
    <thead>
        <th> # </th>
        <th> الرقم التعريفى </th>
        <th> اسم الطالب </th>
        <th> البريد الجامعى </th>
        <th> المستوى  </th>
        <th> النوع  </th>
        <th> المحافظة</th>
    </thead>
    <tbody>

        @forelse ($students as $key=>$student)
            <tr>
                <td> {{ $student->id }}  </td>
                <td> {{ $student->student_id }}  </td>
                <td> {{ $student->name }}  </td>
                <td> {{ $student->university_email }}  </td>
                <td> {{ $student->level }}  </td>
                <td>
                    {{
                        ($student->gender == 0) ? "ذكر" : "انثي"
                    }}
                </td>
                <td>
                    <?php echo getGovernate($student->governorate); ?>
                </td>
            </tr>
            @empty

        @endforelse

    </tbody>
 </table>

 <div class="col-12 row d-flex justify-content-center">
    {{ $students->appends($_GET)->links("pagination::bootstrap-4") }}
 </div>

</div>

<?php

    function getGovernate($governate) {
        if ($governate == 1) {return "القاهرة"; }
        if ($governate == 2) {return "الجيزة";}
        if ($governate == 3) {return "الاسكندرية";}
        if ($governate == 4) {return "الدقهلية";}
        if ($governate == 5) {return "البحر الاحمر";}
        if ($governate == 6) {return "البحيره";}
        if ($governate == 7) {return "الفيوم";}
        if ($governate == 8) {return "الغربية";}
        if ($governate == 9) {return "الاسماعيلية";}
        if ($governate == 10) {return "المنوفيه";}
        if ($governate == 11) {return "المنيا";}
        if ($governate == 12) {return "القليوبية";}
        if ($governate == 13) {return "الوادى الجديد";}
        if ($governate == 14) {return "سينا";}
        if ($governate == 15) {return "اسوان";}
        if ($governate == 16) {return "اسيوط";}
        if ($governate == 17) {return "بنى سويف";}
        if ($governate == 18) {return "بورسعيد";}
        if ($governate == 19) {return "دمياط";}
        if ($governate == 20) {return "شرقيه";}
        if ($governate == 21) {return "جنوب سينا";}
        if ($governate == 22) {return "كفر الشيخ";}
        if ($governate == 23) {return "مطروح";}
        if ($governate == 24) {return "الاقصر";}
        if ($governate == 25) {return "قنا";}
        if ($governate == 26) {return "شمال سينا";}
        if ($governate == 27) { return "سوهاج";}
    }

?>

@endsection
