  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow fixed-top">

    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        style="height: 100%; " href="{{ route('home') }}">
      <img src="{{ asset('images/static/logo.png') }}" style="height: 100%; object-fit: contain;">
    </a>

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>



    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="home" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">المدير</span>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in p-3" >
            <form method="post" action="{{ route("logout") }}">
                @csrf
                <button type="submit" class="w-100 btn btn-outline-dark btn-block">
                    <i class="fas px-0 fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                     خروج
                </button>
            </form>
        </div>
      </li>

    </ul>

  </nav>
  <!-- End of Topbar -->
