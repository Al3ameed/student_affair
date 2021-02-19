@extends('layout.master')

@section('body')

<div class="header my-5">
    <h3 class=" float-left"> Governorates</h3>
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
                <option value="" >All Governorates</option>
                <option value="1" {{ request("f_governorate") == "1" ? "selected": "" }}>Cairo</option>
                <option value="2" {{ request("f_governorate") == "2" ? "selected": "" }}> Giza</option>
                <option value="3" {{ request("f_governorate") == "3" ? "selected": "" }}> Alexandria</option>
                <option value="4" {{ request("f_governorate") == "4" ? "selected": "" }}> Dakahlia </option>
                <option value="5" {{ request("f_governorate") == "5" ? "selected": "" }}> Red Sea  </option>
                <option value="6" {{ request("f_governorate") == "6" ? "selected": "" }}> Beheira </option>
                <option value="7" {{ request("f_governorate") == "7" ? "selected": "" }}>Fayoum</option>
                <option value="8" {{ request("f_governorate") == "8" ? "selected": "" }}> Gharbiya</option>
                <option value="9" {{ request("f_governorate") == "9" ? "selected": "" }}> Ismailia</option>
                <option value="10" {{ request("f_governorate") == "10" ? "selected": "" }}> Monofia </option>
                <option value="11" {{ request("f_governorate") == "11" ? "selected": "" }}> Minya </option>
                <option value="12" {{ request("f_governorate") == "12" ? "selected": "" }}> Qaliubiya </option>
                <option value="13" {{ request("f_governorate") == "13" ? "selected": "" }}>New Valley</option>
                <option value="14" {{ request("f_governorate") == "14" ? "selected": "" }}> Suez</option>
                <option value="15" {{ request("f_governorate") == "15" ? "selected": "" }}> Aswan</option>
                <option value="16" {{ request("f_governorate") == "16" ? "selected": "" }}> Assiut </option>
                <option value="17" {{ request("f_governorate") == "17" ? "selected": "" }}> Beni Suef</option>
                <option value="18" {{ request("f_governorate") == "18" ? "selected": "" }}> Port Said </option>
                <option value="19" {{ request("f_governorate") == "19" ? "selected": "" }}> Damietta </option>
                <option value="20" {{ request("f_governorate") == "20" ? "selected": "" }}> Sharkia </option>
                <option value="21" {{ request("f_governorate") == "21" ? "selected": "" }}> South Sinai </option>
                <option value="22" {{ request("f_governorate") == "22" ? "selected": "" }}> Kafr Al sheikh </option>
                <option value="23" {{ request("f_governorate") == "23" ? "selected": "" }}> Matrouh </option>
                <option value="24" {{ request("f_governorate") == "24" ? "selected": "" }}> Luxor </option>
                <option value="25" {{ request("f_governorate") == "25" ? "selected": "" }}> Qena </option>
                <option value="26" {{ request("f_governorate") == "26" ? "selected": "" }}> North Sinai </option>
                <option value="27" {{ request("f_governorate") == "27" ? "selected": "" }}> Sohag </option>
            </select>
        </div>

        <div class="col-md-3 sol-sm-4 pl-0  col-12">
            <select class="form-control" name="f_gender">
                <option value=""> Select Gender</option>
                <option value="0" {{ request("f_gender") == "0" ? "selected" : "" }}> Male</option>
                <option value="1" {{ request("f_gender") == "1" ? "selected" : "" }}> Female</option>
            </select>
        </div>

        <div class="col-md-4 sol-sm-6">
            <button class="btn btn-outline-primary"> Search</button>
        </div>
    </form>
</div>

<div class="table-responsive">

    <form action="" method="get" class="col-12 text-right mb-3">
        <input  type="hidden" name="excel" value="yes">
        <input  type="hidden" name="f_gender" value="{{ request("f_gender") }}">
        <input  type="hidden" name="f_governorate" value="{{ request("f_governorate") }}">
        <button type="submit" class="btn btn-success"> Export Excel  <i class="fas fa-file-csv ml-2"></i> </button>
    </form>

    <table class="table table-light table-striped table-hover">
    <thead>
        <th> # </th>
        <th> ID </th>
        <th> Name </th>
        <th> Email </th>
        <th> Level  </th>
        <th> Gender  </th>
        <th> Governorate</th>
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
                        ($student->gender == 0) ? "Male" : "FeMale"
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
        if ($governate == 1) {return "Cairo"; }
        if ($governate == 2) {return "Giza";}
        if ($governate == 3) {return "Alexandria";}
        if ($governate == 4) {return "Dakahlia";}
        if ($governate == 5) {return "Red Sea";}
        if ($governate == 6) {return "Beheira";}
        if ($governate == 7) {return "Fayoum";}
        if ($governate == 8) {return "Gharbiya";}
        if ($governate == 9) {return "Ismailia";}
        if ($governate == 10) {return "Monofia";}
        if ($governate == 11) {return "Minya";}
        if ($governate == 12) {return "Qaliubiya";}
        if ($governate == 13) {return "New Valley";}
        if ($governate == 14) {return "Suez";}
        if ($governate == 15) {return "Aswan";}
        if ($governate == 16) {return "Assiut";}
        if ($governate == 17) {return "Beni Suef";}
        if ($governate == 18) {return "Port Said";}
        if ($governate == 19) {return "Damietta";}
        if ($governate == 20) {return "Sharkia";}
        if ($governate == 21) {return "South Sinai";}
        if ($governate == 22) {return "Kafr Al sheikh";}
        if ($governate == 23) {return "Matrouh";}
        if ($governate == 24) {return "Luxor";}
        if ($governate == 25) {return "Qena";}
        if ($governate == 26) {return "North Sinai";}
        if ($governate == 27) { return "Sohag";}
    }

?>

@endsection
