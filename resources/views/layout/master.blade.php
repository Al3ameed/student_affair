<!DOCTYPE html>
<html lang="en">
<head>
      @include('layout.header')
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layout.aside')

        <!-- Main Content -->
        <div id="content-wrapper" class="d-flex flex-column">

              <div id="content" style="margin-top: 80px !important;">

                @include('layout.navbar')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('body')

                </div>
                <!-- /.container-fluid -->

            </div>

            <!-- End of Main Content -->
            @include('layout.footer')

        </div>


    </div>

</body>
</html>
