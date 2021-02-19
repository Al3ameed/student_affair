<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="margin-top: 70px;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
      <div class="sidebar-brand-text mx-1"> SA DASHBOARD</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('students.index') }}">
        <i class="fas fa-users "></i>
        <span>students</span>
      </a>
    </li>

     <!-- Nav Item - Excellent Students -->
     <li class="nav-item active">
        <a class="nav-link" href="{{ route('excellent') }}">
            <i class="fas fa-file-export"></i>
            <span> Excellent Students </span>
        </a>
    </li>

    <!-- Nav Item - Governorates -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('governorates') }}">
            <i class="fas fa-file-export"></i>
            <span> Governorates </span>
        </a>
    </li>

    <!-- Nav Item - Military Education -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('military_education') }}">
            <i class="fas fa-file-export"></i>
            <span> Military Education </span>
        </a>
    </li>

    <!-- Nav Item - Military Education -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('student_ages') }}">
            <i class="fas fa-file-export"></i>
            <span> Student Ages </span>
        </a>
    </li>

    <!-- Nav Item - Foreign Students  -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('foreign_students') }}">
            <i class="fas fa-file-export"></i>
            <span> Foreign Students </span>
        </a>
    </li>


</ul>
  <!-- End of Sidebar -->
