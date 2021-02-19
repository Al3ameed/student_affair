@extends('layout.master')

@section('body')

<div class="header my-5 ">
    <a class="d-inline-block" href="{{ route("students.index") }}">
        <i class="fa fa-angle-double-left fa-1x text-secondary" aria-hidden="true"></i>
    </a>
    <h3 class="d-inline-block ml-3"> Create Students </h3>

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
        <span class="mandatory"> * Mandatory </span>
        <div class="col-12 text-center">
            <img src="{{ asset('images/static/default.jpg') }}" class="student_photo" id="output">
        </div>
        {{-- Full Name  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_name">Full Name </label>
            <input required id="s_name" type="text" value="{{ old('name') }}"  class="form-control" name="name">
        </div>

        {{-- Student ID  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_id">Student ID </label>
            <input required id="s_id" value="{{ old('student_id') }}" type="number"  class="form-control" name="student_id">
        </div>

        {{-- DOB --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_date"> BirthDate </label>
            <input required id="s_date" value="{{ old('dob') }}" type="date" class="form-control" name="dob">
        </div>

        {{-- Qualification --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_qualification"> Qualification </label>
            <select required id="s_qualification" value="{{ old('qualification') }}" class="form-control"  name="qualification">
                <option value="0"> Secondary School - Sciense</option>
                <option value="1"> Secondary School - Mathmetics</option>
                <option value="2"> Technical Secondary</option>
                <option value="3"> Arrivals </option>
                <option value="4"> STEM </option>
                <option value="5"> Others </option>
            </select>
        </div>

        {{-- Qualification Year  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_q_year"> Qualification Year </label>
            <input required value="{{ old('qualification_year') }}" id="s_q_year" type="number" class="form-control" name="qualification_year">
        </div>

        {{-- Grade  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_h_grade"> Secondry School Grade </label>
            <input value="{{ old('secondry_grade') }}" min="1" required id="s_h_grade" type="number" class="form-control" name="secondry_grade">
        </div>

        {{-- Gender  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_gender"> Gender </label>
            <select value="{{ old('gender') }}" required id="s_gender" class="form-control"  name="gender">
                <option value="0"> male</option>
                <option value="1"> female</option>
            </select>
        </div>

        {{-- Status  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_status"> Status </label>
            <select value="{{ old('status') }}" class="form-control" id="s_status"  name="status">
                <option value="1" selected> Active</option>
                <option value="0"> InActive</option>
            </select>
        </div>

         {{-- Level  --}}
         <div class="col-md-6 col-12 mb-3">
            <label for="s_level"> Level </label>
            <select value="{{ old('level') }}" class="form-control" id="s_level"  name="level">
                <option value="1" > Level 1</option>
                <option value="2" > Level 2</option>
                <option value="3" > Level 3</option>
                <option value="4" > Level 4</option>
            </select>
        </div>

        {{-- Nationality  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_nationality"> Nationality </label>
            <select value="{{ old('nationality') }}" required id="s_nationality" class="form-control"  name="nationality">
                <option value="0" selected> Egyptian</option>
                <option value="1"> Foreign</option>
            </select>
        </div>

        {{-- National ID  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_national_id"> National ID </label>
            <input value="{{ old('national_id') }}" type="number" required id="s_national_id" class="form-control"  name="national_id">
        </div>

        {{-- Phone Number  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_number"> Student Phone </label>
            <input value="{{ old('student_number') }}" type="number" required id="s_number" class="form-control"  name="student_number">
        </div>

        {{-- University Email  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_u_main"> University E-mail </label>
            <input value="{{ old('university_email') }}" type="email" required id="s_u_main" class="form-control"  name="university_email">
        </div>

        {{-- Image  --}}
        <div class="col-md-6 mb-3 col-12">
            <label for="s_image"> Image </label>
            <input value="{{ old('img') }}" type="file" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" required id="s_image" class="form-control"  name="img">
        </div>

    </div>

    {{-- Parents Data  --}}
    <div class="row mx-0 mt-5 bg-blue p-3 pt-5  d-flex position-relative">
        <span class="mandatory"> * Mandatory </span>

        {{-- Father Name  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_f_name">Father Name </label>
            <input value="{{ old('father_name') }}" required id="s_f_name" type="text"  class="form-control" name="father_name">
        </div>

        {{-- Father Job  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_f_job">Father Job </label>
            <input value="{{ old('father_job') }}" required id="s_f_job" type="text"  class="form-control" name="father_job">
        </div>

        {{-- Mother Name --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_m_name">Mother Name </label>
            <input value="{{ old('mother_name') }}" required id="s_m_name" type="text"  class="form-control" name="mother_name">
        </div>

        {{-- Mother Job  --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_m_job">Mather Job </label>
            <input value="{{ old('mother_job') }}" required id="s_m_job" type="text"  class="form-control" name="mother_job">
        </div>

        {{-- Address --}}
        <div class="col-12 mb-3">
            <label for="s_address">Address</label>
            <textarea required id="s_address" class="form-control" name="Address">{{old('Address')}}</textarea>
        </div>

        {{-- Governace --}}
        <div class="col-md-6 col-12 mb-3">
            <label for="s_governace"> Governorates </label>
            <select value="{{ old('governorate') }}" required id="s_governace" class="form-control"  name="governorate">
                <option value="1">Cairo</option>
                <option value="2"> Giza</option>
                <option value="3"> Alexandria</option>
                <option value="4"> Dakahlia </option>
                <option value="5"> Red Sea  </option>
                <option value="6"> Beheira </option>
                <option value="7">Fayoum</option>
                <option value="8"> Gharbiya</option>
                <option value="9"> Ismailia</option>
                <option value="10"> Monofia </option>
                <option value="11"> Minya </option>
                <option value="12"> Qaliubiya </option>
                <option value="13">New Valley</option>
                <option value="14"> Suez</option>
                <option value="15"> Aswan</option>
                <option value="16"> Assiut </option>
                <option value="17"> Beni Suef</option>
                <option value="18"> Port Said </option>
                <option value="19"> Damietta </option>
                <option value="20"> Sharkia </option>
                <option value="21"> South Sinai </option>
                <option value="22"> Kafr Al sheikh </option>
                <option value="23"> Matrouh </option>
                <option value="24"> Luxor </option>
                <option value="25"> Qena </option>
                <option value="26"> North Sinai </option>
                <option value="27"> Sohag </option>
            </select>
        </div>

    </div>

    {{-- Military State  --}}
    <div class="row mx-0 mt-5 bg-blue p-3 pt-5  d-flex position-relative">
        <span class="optional"> * Optional </span>

        {{-- Military State --}}
        <div class="col-12 mb-3">
            <label for="s_m_state"> Militart State </label>
            <select value="{{ old('military_status') }}" onchange="MilitaryStats(this)" required id="s_m_state" class="form-control"  name="military_status">
                <option value="1">exempt</option>
                <option value="2"> postponement</option>
                <option value="3"> Completed</option>
            </select>
        </div>

        {{-- Military Date  --}}
        <div class="col-md-6 col-12 mb-3 military-section">
            <label for="s_m_state">Militart Date </label>
            <input value="{{ old('military_date') }}" id="s_m_date" type="date" class="form-control" name="military_date">
        </div>

        {{-- Military Number  --}}
        <div class="col-md-6 col-12 mb-3 military-section">
            <label for="s_m_number">Militart Number </label>
            <input value="{{ old('military_number') }}" id="s_m_number" type="number"  class="form-control" name="military_number">
        </div>

         {{-- Reason  --}}
         <div class="col-12 mb-3 military-exempt-section">
            <label for="s_m_reason"> Reason </label>
            <textarea value="{{ old('military_reason') }}" id="s_m_reason" class="form-control" name="military_reason"></textarea>
        </div>

    </div>

    {{-- Military Education  --}}
    <div class="row mx-0 mt-5 bg-blue p-3 pt-5  d-flex position-relative">
        <span class="optional"> * Optional </span>

        <div class="col-12 row d-flex justify-content-between mb-3">
            <label class="col"> Militart Education </label>
            <div class="row d-flex justify-content-between col">
                <div><input  type="radio" name="military_education" value="1"  {{ old('military_education') == "1" ? "checked" : (old('military_education') == null ? "checked" : "") }} > Completed </div>
                <div><input type="radio" name="military_education" value="0" {{ old('military_education') == "0" ? "checked" : "" }} > InCompleted </div>
            </div>
            </select>
        </div>
    </div>

    <div class="row col-12 mx-0 px-0 my-5 justify-content-center">
      <div class="col-md-6 col-12">
        <button class="btn btn-block btn-outline-primary"> Save Student </button>
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
