@extends('layout.master')

@section('body')

<div class="header my-5 ">
    <a class="d-inline-block" href="{{ route("students.index") }}">
        <i class="fa fa-angle-double-left fa-1x text-secondary" aria-hidden="true"></i>
    </a>
    <h3 class="d-inline-block ml-3"> اضافة طالب </h3>

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

<form action="{{ route("students.store") }}" method="post" enctype="multipart/form-data">
    @csrf
    {{-- Student Data  --}}
    <div class="row mx-0 bg-blue p-3  d-flex position-relative">
        <span class="mandatory"> * مطلوب </span>
        <div class="col-12 text-center">
            <img src="{{ asset('images/static/default.jpg') }}" class="student_photo" id="output">
        </div>
        {{-- Full Name  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_name">الاسم بالكامل</label>
            <input required id="s_name" type="text" value="{{ old('name') }}"  class="form-control" name="name">
        </div>

        {{-- Student ID  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_id">الرقم التعريفى </label>
            <input required id="s_id" value="{{ old('student_id') }}" type="number"  class="form-control" name="student_id">
        </div>

        {{-- DOB --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_date"> تاريخ الميلاد </label>
            <input required id="s_date" value="{{ old('dob') }}" type="date" class="form-control" name="dob">
        </div>

        {{-- Qualification --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_qualification"> المؤهل </label>
            <select required id="s_qualification" value="{{ old('qualification') }}" class="form-control"  name="qualification">
                <option value="0"> علمى علوم</option>
                <option value="1"> علمى رياضة</option>
                <option value="2"> ثانوية فنيه</option>
                <option value="3"> الوافدين </option>
                <option value="4"> ستيم </option>
                <option value="5"> اخري </option>
            </select>
        </div>

        {{-- Qualification Year  --}}
        <div class="col-md-6 col-12 mb-3">
            <div class="row col-12 mx-0 px-0">
                <label for="s_q_year_f" class="col-12">  سنه التخرج  ( من - الى )</label>
                <div class="col">
                    {{-- Qualification Years --}}
                    <input required placeholder="من" value="{{ old('qualification_year_from') }}" id="s_q_year_f" type="number"
                        class="form-control" name="qualification_year_from">
                </div>
                <div class="col-1 btn btn-light text-center"> / </div>
                <div class="col">
                    {{-- Qualification Years --}}
                    <input required placeholder="الى" value="{{ old('qualification_year_to') }}" id="s_q_year_t" type="number"
                        class="form-control" name="qualification_year_to">
                </div>
            </div>
        </div>

        {{-- Grade  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_h_grade"> درجة المؤهل قبل الجامعى </label>
            <input value="{{ old('secondry_grade') }}" min="1" required id="s_h_grade" type="number" class="form-control" name="secondry_grade">
        </div>

        {{-- Gender  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_gender"> النوع </label>
            <select value="{{ old('gender') }}" required id="s_gender" class="form-control"  name="gender">
                <option value="0"> ذكر</option>
                <option value="1"> انثى</option>
            </select>
        </div>

        {{-- Status  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_status"> الحاله </label>
            <select value="{{ old('status') }}" class="form-control" id="s_status"  name="status">
                <option value="1" selected> مفعل</option>
                <option value="0"> غير مفعل</option>
            </select>
        </div>

         {{-- Level  --}}
         <div class="col-md-6 col-12 mb-3">
            <label for="s_level"> المستوى </label>
            <select value="{{ old('level') }}" class="form-control" id="s_level"  name="level">
                <option value="1" > المستوى الاول</option>
                <option value="2" > المستوى الثاني</option>
                <option value="3" > المستوى الثالث</option>
                <option value="4" > المستوى الرابع</option>
            </select>
        </div>

        {{-- Nationality  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_nationality"> الجنسيه </label>
            <select value="{{ old('nationality') }}" required id="s_nationality" class="form-control"  name="nationality">
                <option value="0" selected> مصرى</option>
                <option value="1"> اجنبى</option>
            </select>
        </div>

        {{-- National ID  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_national_id"> الرقم القومى </label>
            <input value="{{ old('national_id') }}" type="number" required id="s_national_id" class="form-control"  name="national_id">
        </div>

        {{-- Phone Number  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_number"> رقم الهاتف </label>
            <input value="{{ old('student_number') }}" type="number" required id="s_number" class="form-control"  name="student_number">
        </div>

        {{-- University Email  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_u_main">البريد الجامعى  </label>
            <input value="{{ old('university_email') }}" type="email" id="s_u_main" class="form-control"  name="university_email">
        </div>

        {{-- Image  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_image"> الصورة </label>
            <input value="{{ old('img') }}" type="file" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" id="s_image" class="form-control"  name="img">
        </div>

    </div>

    {{-- Parents Data  --}}
    <div class="row mx-0 mt-5 bg-blue p-3 pt-5  d-flex position-relative">
        <span class="optional"> * اخيتارى </span>

        {{-- Father Name  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_f_name"> اسم الاب</label>
            <input value="{{ old('father_name') }}"  id="s_f_name" type="text"  class="form-control" name="father_name">
        </div>

        {{-- Father Job  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_f_job">وظيفة الاب  </label>
            <input value="{{ old('father_job') }}"  id="s_f_job" type="text"  class="form-control" name="father_job">
        </div>

        {{-- Mother Name --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_m_name">اسم الام</label>
            <input value="{{ old('mother_name') }}"  id="s_m_name" type="text"  class="form-control" name="mother_name">
        </div>

        {{-- Mother Job  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_m_job">وظيفة الام</label>
            <input value="{{ old('mother_job') }}"  id="s_m_job" type="text"  class="form-control" name="mother_job">
        </div>

        {{-- Address --}}
        <div class="col-12 mb-3">
            <label for="s_address">العنوان</label>
            <textarea required id="s_address" class="form-control" name="Address">{{old('Address')}}</textarea>
        </div>

        {{-- Governace --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_governace"> المحافظة </label>
            <select value="{{ old('governorate') }}" required id="s_governace" class="form-control"  name="governorate">
                <option value="1">القاهرة</option>
                <option value="2"> الجيزة</option>
                <option value="3"> الاسكندرية</option>
                <option value="4"> الدقهلية </option>
                <option value="5"> البحر الاحمر  </option>
                <option value="6"> البحيره </option>
                <option value="7">الفيوم</option>
                <option value="8"> الغربية</option>
                <option value="9"> الاسماعيلية</option>
                <option value="10"> المنوفيه </option>
                <option value="11"> المنيا </option>
                <option value="12"> القليوبية </option>
                <option value="13">الوادى الجديد</option>
                <option value="14"> سينا</option>
                <option value="15"> اسوان</option>
                <option value="16"> اسيوط </option>
                <option value="17"> بنى سويف</option>
                <option value="18"> بورسعيد </option>
                <option value="19"> دمياط </option>
                <option value="20"> شرقيه </option>
                <option value="21"> جنوب سينا </option>
                <option value="22"> كفر الشيخ </option>
                <option value="23"> مطروح </option>
                <option value="24"> الاقصر </option>
                <option value="25"> قنا </option>
                <option value="26"> شمال سينا </option>
                <option value="27"> سوهاج </option>
            </select>
        </div>

    </div>

    {{-- Military State  --}}
    <div class="row mx-0 mt-5 bg-blue p-3 pt-5  d-flex position-relative">
        <span class="optional"> * اختيارى </span>

        {{-- Military State --}}
        <div class="col-12 mb-3">
            <label for="s_m_state"> الخدمة العسكريه </label>
            <select value="{{ old('military_status') }}" onchange="MilitaryStats(this)" required id="s_m_state" class="form-control"  name="military_status">
                <option value="1">اعفاء</option>
                <option value="2"> مؤجل</option>
                <option value="3"> تم اداء الخدمة</option>
            </select>
        </div>

        {{-- Military Date  --}}
        <div class="col-md-6 col-12 mb-3 military-section">
            <label for="s_m_state">تاريخ اداء الخدمة العسكريه </label>
            <input value="{{ old('military_date') }}" id="s_m_date" type="date" class="form-control" name="military_date">
        </div>

        {{-- Military Number  --}}
        <div class="col-md-6 col-12 mb-3 military-section">
            <label for="s_m_number">رقم قرار الخدمة العسكرية </label>
            <input value="{{ old('military_number') }}" id="s_m_number" type="number"  class="form-control" name="military_number">
        </div>

         {{-- Reason  --}}
         <div class="col-12 mb-3 military-exempt-section">
            <label for="s_m_reason"> ملاحظات </label>
            <textarea value="{{ old('military_reason') }}" id="s_m_reason" class="form-control" name="military_reason"></textarea>
        </div>

    </div>

    {{-- Military Education  --}}
    <div class="row mx-0 mt-5 bg-blue p-3 pt-5  d-flex position-relative">
        <span class="optional"> * اختيارى </span>

        <div class="col-12 row d-flex justify-content-between mb-3">
            <label class="col"> التربيه العسكريه </label>
            <div class="row d-flex justify-content-between col">
                <div><input  type="radio" name="military_education" value="1"  {{ old('military_education') == "1" ? "checked" : (old('military_education') == null ? "checked" : "") }} > تم اادء التربية العسكريه </div>
                <div><input type="radio" name="military_education" value="0" {{ old('military_education') == "0" ? "checked" : "" }} > لم يتم اداء التربية العسكريه </div>
            </div>
            </select>
        </div>
    </div>

    <div class="row col-12 mx-0 px-0 my-5 justify-content-center">
      <div class="col-md-6 col-12">
        <button class="btn btn-block btn-outline-primary">تسجل طالب جديد  </button>
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
</script>
@endsection
