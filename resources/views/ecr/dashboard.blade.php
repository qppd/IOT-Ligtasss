@include('ecr/includes/header')
{{-- @include('includes/modal_municipalities') --}}

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('storage/images/login-logo.png') }}" alt="Ligtasss" height="180"
                width="180">
            <h1>Ligtasss</h1>
        </div>
        <!-- Preloader -->

        @include('ecr/includes/navbar')
        @include('ecr/includes/menubar')

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

                        <div class="col-sm-12 col-md-6 col-lg-6">

                            <div class="card">
                                <div class="card-header bg-orange">
                                    <h3 class="card-title">
                                        <i class="fas fa-bell mr-1"></i>
                                        Notifications
                                    </h3>

                                </div><!-- /.card-header -->

                                <!-- /.card-header -->
                                <div class="card-body">



                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">

                            <div class="card">
                                <div class="card-header bg-navy">
                                    <h3 class="card-title">
                                        <i class="fas fa-users mr-1"></i>
                                        Quick Counts
                                    </h3>

                                </div><!-- /.card-header -->
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <!-- Small boxes (Stat box) -->
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <!-- small box -->
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    @foreach ($employee_count as $employee)
                                                        <h3>{{ $employee['employee_count'] }}</h3>
                                                    @endforeach

                                                    <p>Smart Gate</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-door-open"></i>
                                                </div>
                                                <a href="{{ url('/admin/gate') }}" class="small-box-footer">More info <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <!-- small box -->
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    @foreach ($employee_count as $employee)
                                                        <h3>{{ $employee['employee_count'] }}</h3>
                                                    @endforeach

                                                    <p>Smart Room</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-door-closed"></i>
                                                </div>
                                                <a href="{{ url('/admin/rooms') }}" class="small-box-footer">More info
                                                    <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>



                                        <!-- ./col -->
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <!-- small box -->
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    @foreach ($employee_count as $employee)
                                                        <h3>{{ $employee['employee_count'] }}</h3>
                                                    @endforeach

                                                    <p>Employees</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-tie"></i>
                                                </div>
                                                <a href="{{ url('/admin/employees') }}" class="small-box-footer">More
                                                    info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <!-- small box -->
                                            <div class="small-box bg-blue">
                                                <div class="inner">
                                                    @foreach ($student_count as $student)
                                                        <h3>{{ $student['student_count'] }}</h3>
                                                    @endforeach

                                                    <p>Students</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                                <a href="{{ url('/admin/students') }}" class="small-box-footer">More
                                                    info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                    </div>
                                    <!-- /.row -->


                                    {{-- <div class="alert alert-info alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-info"></i> Alert!</h5>
                                        Info alert preview. This alert is dismissable.
                                    </div>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                        Warning alert preview. This alert is dismissable.
                                    </div>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                                        Success alert preview. This alert is dismissable.
                                    </div> --}}
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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
    @include('ecr/includes/footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    @include('ecr/includes/scripts')


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var alertShown = false; // Flag to track whether the alert has been shown

            function fetchData() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(this.responseText);
                        getData(data);
                    }
                };
                xhr.open("GET", "/ecr/dashboard/fetch", true);
                xhr.send();
            }

            function getData(datas) {
                for (var key in datas) {
                    if (datas.hasOwnProperty(key)) {
                        var nodes = datas[key];
                        if (key == "modules") {
                            decodeFireDetectionModulesJson(nodes);
                        } else if (key == "rooms") {
                            decodeRoomDevicesJson(nodes);
                        }
                    }
                }
            }

            function decodeFireDetectionModulesJson(nodes) {
                var fire_detection_modules = @json($fire_detection_modules);

                for (var key in fire_detection_modules) {
                    if (fire_detection_modules.hasOwnProperty(key)) {
                        var module_id = fire_detection_modules[key];
                        // Check if alert has not been shown and conditions for alert are met
                        if (!alertShown && nodes[module_id].temperature >= 90 && nodes[module_id].humidity <= 20) {
                            // Show alert
                            showAlert("FIRE ALERT!",
                                `A fire has been detected by module ${module_id}. Please respond immediately.`);
                        }
                    }
                }
            }

            function decodeRoomDevicesJson(nodes) {
                var room_devices = @json($room_devices);

                for (var key in room_devices) {
                    if (room_devices.hasOwnProperty(key)) {
                        var device_id = room_devices[key];
                        // Check if alert has not been shown and conditions for alert are met
                        if (!alertShown && nodes[device_id].reed == 0 && nodes[device_id].status == 0) {
                            // Show alert
                            showAlert("Room Alert!",
                                `There is a trespasser in room ${device_id}. Please take action.`);
                        }
                    }
                }
            }

            // Function to show alert
            function showAlert(title, message) {
                var alertHtml = `<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="dismissAlert()">&times;</button>
                            <h5><i class="icon fas fa-fire"></i>${title}</h5>
                            ${message}
                        </div>`;
                // Append the alert to the card body
                document.querySelector('.card-body').insertAdjacentHTML('beforeend', alertHtml);
                alertShown = true; // Set the flag to true after showing the alert

                sendNotification(title, message);
            }

            function sendNotification() {

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        //var data = JSON.parse(this.responseText);
                        //console.log(data);
                    }
                };
                xhr.open("GET", "/ecr/dashboard/send", true);
                xhr.send();
            }

            // Global function to dismiss alert
            window.dismissAlert = function() {
                alertShown = false; // Reset the flag when the alert is dismissed
            };

            // Call fetchData() immediately
            fetchData();

            // Call fetchData() every 5 seconds
            setInterval(fetchData, 10000);
        });
    </script>


</body>

</html>
