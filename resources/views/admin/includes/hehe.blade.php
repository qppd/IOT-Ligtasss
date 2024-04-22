@include('includes/header')
@include('includes/modal_home')

<style>
    /* Set the size of the div element that contains the map */
    #map {
        height: 800px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('storage/images/blood-reserve-logo.png') }}" alt="Blood Reserve Logo"
                height="180" width="180">
            <h1>TOPCIT</h1>
        </div>
        @include('includes/navbar')
        @include('includes/menubar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <form class="form-horizontal" method="GET" action="check-count">
                        </form>
                        <div id="map">

                        </div>

            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('includes/footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    

    <!-- jQuery -->
    @include('includes/scripts')

    <script>
        $(document).ready(function() {


            @if (session('default'))
                $("#change").modal("show");
            @endif
        });
    </script>

</body>

</html>
