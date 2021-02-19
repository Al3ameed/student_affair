@extends('layout.master')

@section('body')

<div class="header my-5">
    <h3 class=" float-left"> Foreign Students </h3>
    <div class="clearfix"></div>
</div>

@if ( @session()->has('message') )
    <div class="bg rounded bg-success text-white p-2 m-2">
        {{  session()->get('message') }}
    </div>
@endif

<div class="table-responsive">

    <form action="" method="get" class="col-12 text-right mb-3">
        <input type="hidden" name="excel" value="yes">
        <button  type="submit" class="btn btn-success"> Export Excel  <i class="fas fa-file-csv ml-2"></i> </button>
    </form>

    <table class="table table-light table-striped table-hover">
        <thead>
            <th> # </th>
            <th> Student ID </th>
            <th> Name </th>
            <th> Gender </th>
            <th> University Email </th>
        </thead>
    <tbody>

        @forelse ($students as $key=>$student)
            <tr>
                <td> {{ $student->id }}  </td>
                <td> {{ $student->student_id }}  </td>
                <td> {{ $student->name }}  </td>
                <td> {{ $student->gender == "0" ? "Male" : "FeMale" }}  </td>
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
