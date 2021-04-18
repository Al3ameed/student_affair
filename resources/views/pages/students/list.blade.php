@extends('layout.master')

@section('body')

<div class="header my-5">
    <h3 class=" float-right"> التحكم فى الطلاب </h3>
    <a class="float-left btn btn-success cursor text-white" href="{{ route("students.create") }}">
        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
        اضافة طالب جديد
    </a>
    <div class="clearfix"></div>
</div>

@if ( @session()->has('message') )
    <div class="bg rounded bg-success text-white p-2 m-2">
        {{ session()->get('message') }}
    </div>
@endif

<div class="filter-section">
    <form method="GET" action="" class="row mx-0 px-0 d-flex">
        <div class="col-md-3 pl-0 col-sm-6 col-12">
            <input value="{{request("f_name")}}" class="form-control" placeholder="البحث عن طريق الاسم" name="f_name">
        </div>
        <div class="col-md-3 col-sm-6 col-12 pl-0">
            <input value="{{request("f_id")}}" class="form-control" placeholder="البحث عن طريق الرقم التعريفى" name="f_id">
        </div>
        <div class="col-md-3 col-sm-6 col-12 pl-0">
            <select class="form-control"  name="f_level">
                <option value="all" {{ request("f_level") == "all" || request("f_level") == "null" ? "selected": "" }}> كل المستويات</option>
                <option value="1" {{ request("f_level") == "1" ? "selected": "" }}> المستوى الاول</option>
                <option value="2" {{ request("f_level") == "2" ? "selected": "" }}> المستوى الثانى</option>
                <option value="3" {{ request("f_level") == "3" ? "selected": "" }}> المستوى الثالث</option>
                <option value="4" {{ request("f_level") == "4" ? "selected": "" }}> المستوى الرابع</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-6 col-12 pl-0">
            <select class="form-control"  name="f_status">
                <option value="all" {{ request("f_status") == "all" || request("f_status") == "null" ? "selected": "" }}> الحاله</option>
                <option value="1" {{ request("f_status") == "1"  ? "selected": "" }}> مفعل</option>
                <option value="0" {{ request("f_status") == "0"  ? "selected": "" }}> غير مفعل</option>
            </select>
        </div>
        <div class="col-12 pl-0 d-flex justify-content-center">
            <div class=" col-md-4 col-sm-8 col-12 mt-2 px-0 ">
                <button type="submit" class="btn btn-block btn-outline-dark"> <i class="fas fa-filter"></i> بحث </button>
            </div>
        </div>
    </form>
</div>

<div class="table-responsive">

    <table class="table table-light table-striped table-hover">
    <thead>
        <th> # </th>
        <th> الرقم التعريفى </th>
        <th> اسم الطالب </th>
        <th> البريد الجامعى </th>
        <th> المستوى  </th>
        <th> الحالة </th>
        <th> تحكم </th>
    </thead>
    <tbody>

        @foreach ($students as $student)
            <tr class="{{ $student->id }}">
                <td> <a href="{{ route('students.edit' , $student->id) }}"> {{ $student->id }} </a> </td>
                <td> <a href="{{ route('students.edit' , $student->id) }}"> {{ $student->student_id }} </a> </td>
                <td> {{ $student->name }} </td>
                <td> {{ $student->university_email }} </td>
                <td> {{  $student->level  }} </td>
                <td>
                    @if($student->status == "1")
                        <span class="bg bg-success text-white text-sm px-2 rounded-pill" style="font-size: 11px;"> مفعل </span>
                    @else
                        <span class="bg bg-danger text-white text-sm px-2 rounded-pill" style="font-size: 11px;">غير مفعل </span>
                    @endif
                </td>
                <td>
                    <span class="mx-1"> <a href="{{ route('students.edit' , $student->id) }}"> <i class="fas fa-edit text-info cursor"></i> </a> </span>
                    <span class="mx-1">
                        <a href="students/{{$student->id}}/manage-grades">
                            <i class="fas fa-graduation-cap text-dark"></i>
                        </a>
                    </span>

                    <span class="mx-1">
                        <a href="students/{{$student->id}}/manage-fees">
                            <i class="fas fa-money-bill  text-dark  "></i>
                        </a>
                    </span>

                    <span class="mx-1"> <a onclick="setSelectedId({{ $student->id }})" style="cursor: pointer;" data-toggle="modal" data-target="#DeleteModal"><i class="fa text-danger fa-trash cursor" aria-hidden="true"></i> </a></span>
                </td>
            </tr>
        @endforeach
    </tbody>

 </table>

 <div class="col-12 row d-flex justify-content-center">
    {{ $students->appends($_GET)->links("pagination::bootstrap-4") }}
 </div>

</div>


<!-- Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">مسح الطالب</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         هل انت متأكد انك تريد مسح الطالب  ؟
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
          <button type="button" class="btn btn-primary" onclick="DeleteStudent()">مسح الطالب</button>
        </div>
      </div>
    </div>
  </div>

  <script>
      let selected_id = null;

      function setSelectedId(id) {
        selected_id = id;
      }

      function DeleteStudent() {
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "students/" + selected_id,
            type:"POST",
            data:{
                student:selected_id,
                _token: _token ,
                _method: "DELETE"
            },
            success:function(response){
                if(response) {
                    $('#DeleteModal').modal('toggle');
                    $("."+ selected_id).hide();
                    selected_id = null;
                    // show alert that the student is deleted
                    Swal.fire({
                        title: 'تم المسح',
                        text: 'تم مسح الطالب بنجاح',
                        icon: 'success',
                        confirmButtonText: 'موافق'
                    });
                }
            },
            error:function(response){
                $("."+ selected_id).hide();
                selected_id = null;
                 // show alert that the student is deleted
                 Swal.fire({
                        title: 'Error!',
                        text: 'Something Went Wrong Pleas try Again Later',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    })
            }
        });
      }
 </script>
@endsection
