@extends('layout.master')

@section('body')

<div class="header my-5">
    <h3 class=" float-left"> Military Education</h3>
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
                <option value="" > Military Education Status</option>
                <option value="1" {{ request("f_m_state") == "1" ? "selected" : "" }}> Completed</option>
                <option value="0" {{ request("f_m_state") == "0" ? "selected" : "" }}> InCompleted</option>
            </select>
        </div>
        <div class="col-md-4 sol-sm-6">
            <button class="btn btn-outline-primary"> Search</button>
        </div>
    </form>
</div>

<div class="table-responsive">

    <form action="" method="get" class="col-12 text-right mb-3">
        <input type="hidden" name="excel" value="yes">
        <input type="hidden" name="f_m_state" value="{{ request("f_m_state") }}">
        <button  type="submit" class="btn btn-success"> Export Excel  <i class="fas fa-file-csv ml-2"></i> </button>
    </form>

    <table class="table table-light table-striped table-hover">
    <thead>
        <th> # </th>
        <th> ID </th>
        <th> Name </th>
        <th> Email </th>
        <th> Militart Education State  </th>
    </thead>
    <tbody>

        @forelse ($students as $key=>$student)
            <tr class="{{ ($student->military_education == 1) ? "f_m_state_c" : "f_m_state_ic" }}">
                <td> {{ $student->id }}  </td>
                <td> {{ $student->student_id }}  </td>
                <td> {{ $student->name }}  </td>
                <td> {{ $student->university_email }}  </td>
                <td>
                    {{
                        ($student->military_education == 1) ? "Completed" : "InCompleted"
                    }}
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

@endsection