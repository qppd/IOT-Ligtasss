@include('admin/includes/header')
{{-- @include('includes/modal_municipalities') --}}

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('storage/images/login-logo.png') }}" alt="IOT Ligtas" height="180"
                width="180">
            <h1>IOT Ligtas</h1>
        </div>
        <!-- Preloader -->

        @include('admin/includes/navbar')
        @include('admin/includes/menubar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">

                @if ($errors->any())
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-warning'></i> Error!</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check'></i> Success!</h4>
                        <ul>
                            {{ session()->get('success') }}
                        </ul>
                    </div>
                @endif

                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">

                        <div class="card" style="width:100%;">
                            <div class="card-header">
                                {{-- <a href="#add" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i
                                        class="fas fa-plus"></i> New</a> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <!-- Widget: user widget style 1 -->
                                        <div class="card card-widget widget-user">
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                            <div class="widget-user-header text-white"
                                                style="background: url({{ url('storage/images/module.png') }}) center center;">
                                                <h3 class="widget-user-username text-right">Module 1</h3>
                                            </div>

                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-sm-3 border-right">
                                                        <div class="description-block">
                                                            <h5 id="temperatureValue1" class="description-header">0
                                                                °C</h5>
                                                            <span class="description-text">TEMPERATURE</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-3 border-right">
                                                        <div class="description-block">
                                                            <h5 id="flameValue1" class="description-header">0</h5>
                                                            <span class="description-text">FLAME</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-3">
                                                        <div class="description-block">
                                                            <h5 id="humidityValue1" class="description-header">0 %</h5>
                                                            <span class="description-text">HUMIDITY</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="description-block">
                                                            <h5 id="smokeValue1" class="description-header">0 %
                                                            </h5>
                                                            <span class="description-text">SMOKE</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                        </div>
                                        <!-- /.widget-user -->
                                    </div>
                                    <!-- /.col -->
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <!-- Widget: user widget style 1 -->
                                        <div class="card card-widget widget-user">
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                            <div class="widget-user-header text-white"
                                                style="background: url({{ url('storage/images/module.png') }}) center center;">
                                                <h3 class="widget-user-username text-right">Module 2</h3>
                                            </div>

                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-sm-3 border-right">
                                                        <div class="description-block">
                                                            <h5 id="temperatureValue2" class="description-header">0
                                                                °C</h5>
                                                            <span class="description-text">TEMPERATURE</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-3 border-right">
                                                        <div class="description-block">
                                                            <h5 id="flameValue2" class="description-header">0</h5>
                                                            <span class="description-text">FLAME</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-3">
                                                        <div class="description-block">
                                                            <h5 id="humidityValue2" class="description-header">0 %
                                                            </h5>
                                                            <span class="description-text">HUMIDITY</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="description-block">
                                                            <h5 id="smokeValue2" class="description-header">0 %
                                                            </h5>
                                                            <span class="description-text">SMOKE</span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                        </div>
                                        <!-- /.widget-user -->
                                    </div>
                                    <!-- /.col -->
                                </div>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin/includes/footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    @include('admin/includes/scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function fetchData() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(this.responseText);
                        // Do something with the fetched data
                        //console.log(data);

                        for (var key in data) {
                            if (data.hasOwnProperty(
                                    key)) { // Check if the property belongs to the object directly
                                var value = data[key]; // Get the corresponding value
                                document.getElementById("temperatureValue1").innerText = data["0000000001"]
                                    .temperature.toFixed(2) + " °C";

                                // Update humidity value
                                document.getElementById("humidityValue1").innerText = data["0000000001"]
                                    .humidity
                                    .toFixed(2) + " %";

                                // Update flame value
                                document.getElementById("flameValue1").innerText = data["0000000001"]
                                    .flame;

                                // Update smoke value
                                document.getElementById("smokeValue1").innerText = data["0000000001"]
                                    .smoke + " %";




                                document.getElementById("temperatureValue2").innerText = data["0000000002"]
                                    .temperature.toFixed(2) + " °C";

                                // Update humidity value
                                document.getElementById("humidityValue2").innerText = data["0000000002"]
                                    .humidity
                                    .toFixed(2) + " %";

                                // Update flame value
                                document.getElementById("flameValue2").innerText = data["0000000002"]
                                    .flame;

                                // Update smoke value
                                document.getElementById("smokeValue1").innerText = data["0000000001"]
                                    .smoke + " %";




                            }
                        }
                    }
                };
                xhr.open("GET", "/admin/dashboard/fetch", true);
                xhr.send();
            }

            // Call fetchData() immediately
            fetchData();

            // Call fetchData() every second
            setInterval(fetchData, 10000);
        });
    </script>

</body>

</html>
