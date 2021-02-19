@extends('layout.master')

@section('body')

<div class="header my-5 ">
    <a class="d-inline-block" href="{{ route("students.index") }}">
        <i class="fa fa-angle-double-left fa-1x text-secondary" aria-hidden="true"></i>
    </a>
    <h3 class="d-inline-block ml-3">
        تعديل الطالب
        <span class="font-weight-bolder text-dark">
             {{ $student->name }}
        </span>
    </h3>

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

<form action="{{ route("students.update" , $student->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    {{-- Student Data  --}}
    <div class="row mx-0 bg-blue p-3  d-flex position-relative">
        <span class="mandatory"> * مطلوب </span>
        <div class="col-12 text-center">
            <img class="student_photo" onerror="onImgError(this)" src="{{ URL::to('/images/students')."/" .$student->img }}" id="output">
        </div>
        {{-- Full Name  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_name">الاسم بالكامل </label>
            <input required id="s_name" type="text" value="{{ $student->name }}"  class="form-control" name="name">
        </div>

        {{-- Student ID  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_id">الرقم التعريفى</label>
            <input required id="s_id" value="{{ $student->student_id }}" type="number"  class="form-control" name="student_id">
        </div>

        {{-- DOB --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_date"> تاريخ الميلاد </label>
            <input required id="s_date" value="{{ $student->dob }}" type="date" class="form-control" name="dob">
        </div>

        {{-- Qualification --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_qualification"> المؤهل </label>
            <select required id="s_qualification"  class="form-control"  name="qualification">
                <option value="0" {{ $student->qualification == "0" ? "selected": "" }}> علمى علوم</option>
                <option value="1" {{ $student->qualification == "1" ? "selected": "" }}> علمى رياضة</option>
                <option value="2" {{ $student->qualification == "2" ? "selected": "" }}> ثانوية فنيه</option>
                <option value="3" {{ $student->qualification == "3" ? "selected": "" }}> الوافدين </option>
                <option value="4" {{ $student->qualification == "4" ? "selected": "" }}> ستيم </option>
                <option value="5" {{ $student->qualification == "5" ? "selected": "" }}> اخري </option>
            </select>
        </div>

        {{-- Qualification Year  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_q_year"> سنه التخرج </label>
            <input required value="{{ $student->qualification_year}}" id="s_q_year" type="number" class="form-control" name="qualification_year">
        </div>

        {{-- Grade  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_h_grade">  درجة المؤهل قبل الجامعى </label>
            <input value="{{ $student->secondry_grade }}" min="1" required id="s_h_grade" type="number" class="form-control" name="secondry_grade">
        </div>

        {{-- Gender  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_gender"> النوع </label>
            <select  required id="s_gender" class="form-control"  name="gender">
                <option {{ $student->gender == "0" ? "selected": "" }} value="0"> ذكر</option>
                <option {{ $student->gender == "1" ? "selected": "" }} value="1"> انثى</option>
            </select>
        </div>

        {{-- Status  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_status"> الحاله </label>
            <select  class="form-control" id="s_status"  name="status">
                <option {{ $student->status == "1" ? "selected": "" }} value="1"> مفعل</option>
                <option {{ $student->status == "0" ? "selected": "" }} value="0"> غير مفعل</option>
            </select>
        </div>

         {{-- Level  --}}
         <div class="col-md-6 col-12 mb-3">
            <label for="s_level"> المستوى </label>
            <select  class="form-control" id="s_level"  name="level">
                <option value="1" {{ $student->level == "1" ? "selected": "" }}> المستوى الاول</option>
                <option value="2" {{ $student->level == "2" ? "selected": "" }}> المستوى الثاني</option>
                <option value="3" {{ $student->level == "3" ? "selected": "" }}> المستوى الثالث</option>
                <option value="4" {{ $student->level == "4" ? "selected": "" }}> المستوى الرابع</option>
            </select>
        </div>

        {{-- Nationality  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_nationality"> الجنسيه </label>
            <select value="{{ $student->nationality }}" required id="s_nationality" class="form-control"  name="nationality">
                <option value="0" selected> مصرى</option>
                <option value="1"> اجنبى</option>
            </select>
        </div>

        {{-- National ID  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_national_id">الرقم القومى</label>
            <input value="{{ $student->national_id }}" type="number" required id="s_national_id" class="form-control"  name="national_id">
        </div>

        {{-- Phone Number  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_number"> رقم الهاتف</label>
            <input value="{{ $student->student_number }}" type="number" required id="s_number" class="form-control"  name="student_number">
        </div>

        {{-- University Email  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_u_main"> البريد الجامعى </label>
            <input value="{{ $student->university_email }}" type="email" required id="s_u_main" class="form-control"  name="university_email">
        </div>

        {{-- Image  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_image"> الصورة </label>
            <input type="file" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" id="s_image" class="form-control"  name="img">
        </div>

    </div>

    {{-- Parents Data  --}}
    <div class="row mx-0 mt-5 bg-blue p-3 pt-5  d-flex position-relative">
        <span class="mandatory"> * اخيتارى </span>

        {{-- Father Name  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_f_name"> اسم الاب</label>
            <input value="{{ $student->father_name }}" required id="s_f_name" type="text"  class="form-control" name="father_name">
        </div>

        {{-- Father Job  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_f_job">وظيفة الاب </label>
            <input value="{{ $student->father_job }}" required id="s_f_job" type="text"  class="form-control" name="father_job">
        </div>

        {{-- Mother Name --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_m_name">اسم الام</label>
            <input value="{{$student->mother_name }}" required id="s_m_name" type="text"  class="form-control" name="mother_name">
        </div>

        {{-- Mother Job  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_m_job">وظيفة الام</label>
            <input value="{{ $student->mother_job }}" required id="s_m_job" type="text"  class="form-control" name="mother_job">
        </div>

        {{-- Address --}}
        <div class="col-12 mb-3">
            <label for="s_address">العنوان</label>
            <textarea required id="s_address" class="form-control" name="Address">{{$student->Address}}</textarea>
        </div>

        {{-- Governace --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_governace"> المحافظة </label>
            <select required id="s_governace" class="form-control"  name="governorate">
                <option value="1" {{ $student->governorate == "1" ? "selected": "" }}>القاهرة</option>
                <option value="2" {{ $student->governorate == "2" ? "selected": "" }}> الجيزة</option>
                <option value="3" {{ $student->governorate == "3" ? "selected": "" }}> الاسكندرية</option>
                <option value="4" {{ $student->governorate == "4" ? "selected": "" }}> الدقهلية </option>
                <option value="5" {{ $student->governorate == "5" ? "selected": "" }}> البحر الاحمر   </option>
                <option value="6" {{ $student->governorate == "6" ? "selected": "" }}> البحيره </option>
                <option value="7" {{ $student->governorate == "7" ? "selected": "" }}>الفيوم</option>
                <option value="8" {{ $student->governorate == "8" ? "selected": "" }}> الغربية</option>
                <option value="9" {{ $student->governorate == "9" ? "selected": "" }}> الاسماعيلية</option>
                <option value="10" {{ $student->governorate == "10" ? "selected": "" }}> المنوفيه </option>
                <option value="11" {{ $student->governorate == "11" ? "selected": "" }}> المنيا </option>
                <option value="12" {{ $student->governorate == "12" ? "selected": "" }}> القليوبية </option>
                <option value="13" {{ $student->governorate == "13" ? "selected": "" }}>الوادى الجديد</option>
                <option value="14" {{ $student->governorate == "14" ? "selected": "" }}> سينا</option>
                <option value="15" {{ $student->governorate == "15" ? "selected": "" }}> اسوان</option>
                <option value="16" {{ $student->governorate == "16" ? "selected": "" }}> اسيوط </option>
                <option value="17" {{ $student->governorate == "17" ? "selected": "" }}> بنى سويف</option>
                <option value="18" {{ $student->governorate == "18" ? "selected": "" }}> بورسعيد </option>
                <option value="19" {{ $student->governorate == "19" ? "selected": "" }}> دمياط </option>
                <option value="20" {{ $student->governorate == "20" ? "selected": "" }}> شرقيه </option>
                <option value="21" {{ $student->governorate == "21" ? "selected": "" }}> جنوب سينا </option>
                <option value="22" {{ $student->governorate == "22" ? "selected": "" }}> كفر الشيخ </option>
                <option value="23" {{ $student->governorate == "23" ? "selected": "" }}> مطروح </option>
                <option value="24" {{ $student->governorate == "24" ? "selected": "" }}> الاقصر </option>
                <option value="25" {{ $student->governorate == "25" ? "selected": "" }}> قنا </option>
                <option value="26" {{ $student->governorate == "26" ? "selected": "" }}> شمال سينا </option>
                <option value="27" {{ $student->governorate == "27" ? "selected": "" }}> سوهاج </option>
            </select>
        </div>

    </div>

    {{-- Military State  --}}
    <div class="row mx-0 mt-5 bg-blue p-3 pt-5  d-flex position-relative">
        <span class="optional"> * اختيارى </span>

        {{-- Military State --}}
        <div class="col-12 mb-3">
            <label for="s_m_state"> الخدمة العسكريه </label>
            <select onchange="MilitaryStats(this)" required id="s_m_state" class="form-control"  name="military_status">
                <option value="1" {{ $student->military_status == "1" ? "selected": "" }}>اعفاء</option>
                <option value="2" {{ $student->military_status == "2" ? "selected": "" }}> مؤجل</option>
                <option value="3" {{ $student->military_status == "3" ? "selected": "" }}> تم اداء الخدمة</option>
            </select>
        </div>

        {{-- Military Date  --}}
        <div class="col-md-6 col-12 mb-3 military-section">
            <label for="s_m_state">تاريخ اداء الخدمة العسكريه</label>
            <input value="{{ $student->military_date }}" id="s_m_date" type="date" class="form-control" name="military_date">
        </div>

        {{-- Military Number  --}}
        <div class="col-md-6 col-12 mb-3 military-section">
            <label for="s_m_number">رقم قرار الخدمة العسكرية</label>
            <input value="{{ $student->military_number}}" id="s_m_number" type="number"  class="form-control" name="military_number">
        </div>

         {{-- Reason  --}}
         <div class="col-12 mb-3 military-exempt-section">
            <label for="s_m_reason"> ملاحظات </label>
            <textarea value="{{ $student->military_reason }}" id="s_m_reason" class="form-control" name="military_reason"></textarea>
        </div>

    </div>

    {{-- Military Education  --}}
    <div class="row mx-0 mt-5 bg-blue p-3 pt-5  d-flex position-relative">
        <span class="optional"> * اختيارى </span>

        <div class="col-12 row d-flex justify-content-between mb-3">
            <label class="col"> التربيه العسكريه </label>
            <div class="row d-flex justify-content-between col">
                <div><input  type="radio" name="military_education" value="1"  {{ $student->military_education == "1" ? "checked" : "" }} > تم اادء التربية العسكريه </div>
                <div><input type="radio" name="military_education" value="0" {{ $student->military_education == "0" ? "checked" : "" }} > لم يتم اداء التربية العسكريه </div>
            </div>
            </select>
        </div>
    </div>

    <div class="row col-12 mx-0 px-0 my-5 justify-content-center">
      <div class="col-md-6 col-12">
        <button class="btn btn-block btn-outline-primary"> تعديل بيانات الطالب </button>
      </div>
    </div>

</form>

<script>
    // when change militart Status
    function MilitaryStats (status) {
        var state = document.getElementById("s_m_state").value;
        if (state == 3) {
            document.getElementsByClassName("military-exempt-section")[0].style.display = "none";
            document.getElementsByClassName("military-section")[0].style.display = "block";
            document.getElementsByClassName("military-section")[1].style.display = "block";
        } else {
            document.getElementsByClassName("military-exempt-section")[0].style.display = "block";
            document.getElementsByClassName("military-section")[0].style.display = "none";
            document.getElementsByClassName("military-section")[1].style.display = "none";
        }
    }
    function onImgError(source) {
        source.src =  "https://dummyimage.com/150x150/e8ecf8/050505.png&text=++";
        // disable onerror to prevent endless loop
        source.onerror = "";
        return true;
    }
</script>
@endsection
