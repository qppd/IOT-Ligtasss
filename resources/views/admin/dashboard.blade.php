@include('admin/includes/header')
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
                                        {{-- <div class="col-sm-12 col-md-6 col-lg-6">
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
                                        </div> --}}



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

            var alertShown = false; // Flag to track whether the alert has been shown
            var flood_counter = 0; //added by angelo

            function fetchData() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(this.responseText);
                        getData(data);
                    }
                };
                xhr.open("GET", "/admin/dashboard/fetch", true);
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
                        } else if (key == "flood_detection_modules") {
                            decodeFloodDetectionModulesJson(nodes);
                        } else if (key == "rfid"){
                            decodeRFIDData(nodes);
                        }
                        // else if(key == "flood_detection_modules"){

                        // }
                    }
                }
            }
            
            function decodeRFIDData(nodes){
                var data = {
                    EntryType: nodes.EntryType,
                    UID: nodes.UID
                }
                console.log(data);

                // Check if alert has not been shown and conditions for alert are met
                if (!alertShown && nodes.EntryType == "force") { // if >= 170 and  <= 180 and != 0 
                            // Show Flood alert
                            sendSms();
                            // showFloodAlert("INTRUDER ALERT!",
                                // `Someone open the door by forced at SHS Laboratory. Please evacuate immediately by going outside our main gate.`);
                            showIntruderAlert1();
                }
            }


            function decodeFloodDetectionModulesJson(nodes) {
                // Get all flood detection modules saved in mysql database
                var flood_detection_module = @json($flood_detection_modules);                
                // Iterate all flood detection modules
                for (var key in flood_detection_module) {
                    if (flood_detection_module.hasOwnProperty(key)) {

                        // Flood detection module device id
                        var module_id = flood_detection_module[key];
                        console.log(nodes[module_id].distance);
                        console.log(flood_counter);


                        var data = {
                            device_id: module_id,
                            distance: nodes[module_id].distance,
                        };

                        // Send POST request to save flood log
                        fetch('/admin/dashboard/save-flood', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                                },
                                body: JSON.stringify(data)
                            })
                            .then(response => {
                                // POST request success
                                if (response.ok) {
                                    // Receive JSON response from detect-fire
                                    return response.json();
                                } else {
                                    throw new Error('Failed to save flood log');
                                }
                            })
                            .then(data => {
                                
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });

                        // Check if alert has not been shown and conditions for alert are met
                        if (!alertShown && nodes[module_id].distance >= 160 && nodes[module_id].distance <= 170 &&
                            nodes[module_id].distance != 0) { // if >= 170 and  <= 180 and != 0 
                            flood_counter = flood_counter + 1;//added by angelo
                            if (flood_counter >= 10){ //added by angelo
                                // Show Flood alert
                                // sendSms();
                                showFloodAlert("FLOOD ALERT!",
                                    `FLood has been detected by module ${module_id}. Please evacuate immediately by going outside our main gate.`);
                            }//added by angelo
                        }else{
                            flood_counter = 0;
                        }
                    }
                }
            }

            function decodeFireDetectionModulesJson(nodes) {
                // Get all fire detection modules saved in mysql database
                var fire_detection_modules = @json($fire_detection_modules);

                // Iterate all fire detection modules
                for (var key in fire_detection_modules) {
                    if (fire_detection_modules.hasOwnProperty(key)) {

                        // Fire detection module id
                        var module_id = fire_detection_modules[key];

                        // Set fire detection data for JSON

                        var data = {
                            module_id: module_id,
                            temperature: nodes[module_id].temperature,
                            humidity: nodes[module_id].humidity,
                            smoke: nodes[module_id].smoke,
                            flame: nodes[module_id].flame
                        };

                        console.log(data);

                        // Send POST request for RandomForest Algorithm
                        fetch('/admin/dashboard/detect-fire', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                                },
                                body: JSON.stringify(data)
                            })
                            .then(response => {
                                // POST request success
                                if (response.ok) {
                                    // Receive JSON response from detect-fire
                                    return response.json();
                                } else {
                                    throw new Error('Failed to detect fire');
                                }
                            })
                            .then(data => {
                                if (!alertShown && data.result == "1") {
                                    // Show fire alert level 1
                                    // sendSms();
                                    showFireAlert("FIRE ALERT!",
                                        `A possible fire has been detected by module ${module_id}. Please respond immediately.`
                                    );
                                } else if (!alertShown && data.result == "2") {
                                    // Show fire alert level 2
                                    // sendSms();
                                    showFireAlert("FIRE ALERT!",
                                        `A fire has been detected by module ${module_id}. Please respond immediately.`
                                    );

                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }
                }
            }

            function sendSms() {
                var data = {
                    '_token': '{{ csrf_token() }}'
                };

                //Send AJAX request to send message using semaphore
                $.ajax({
                    type: "POST",
                    url: '/admin/dashboard/send-message',
                    data: data,
                    success: function(response) {
                        console.log(response);
                        // Handle success response here
                        // You can update UI, show a success message, etc.
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error response here
                        // You can show an error message or handle the error accordingly
                    }
                });
            }

            function decodeRoomDevicesJson(nodes) {
                var room_devices = @json($room_devices);
                for (var key in room_devices) {
                    if (room_devices.hasOwnProperty(key)) {
                        var device_id = room_devices[key];
                        // Check if alert has not been shown and conditions for alert are met
                        // if (!alertShown && nodes[device_id].reed == 0 && nodes[device_id].status == 0) {
                        //     // Show alert
                        //     showAlert("Room Alert!",
                        //         `There is a trespasser in room ${device_id}. Please take action.`);
                        // }

                    }
                }
            }

            // Function to show fire alert
            function showFireAlert(title, message) {
                var alertHtml = `<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="dismissAlert()">&times;</button>
                            <h5><i class="icon fas fa-fire"></i>${title}</h5>
                            ${message}
                        </div>`;
                // Append the alert to the card body
                document.querySelector('.card-body').insertAdjacentHTML('beforeend', alertHtml);
                alertShown = true; // Set the flag to true after showing the alert

                document.addEventListener('click', function() {
                    audio = new Audio('{{ url('storage/audio/Alarm.mp3') }}');
                    audio.play();
                }, {
                    once: true
                }); // Use { once: true } to ensure the event listener is triggered only once

                console.log("send notif");
                sendNotification(title, message);
                sendSms();
            }

            // Function to show flood alert
            function showFloodAlert(title, message) {
                var alertHtml = `<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="dismissAlert()">&times;</button>
                            <h5><i class="icon fas fa-water"></i>${title}</h5>
                            ${message}
                        </div>`;
                // Append the alert to the card body
                document.querySelector('.card-body').insertAdjacentHTML('beforeend', alertHtml);
                alertShown = true; // Set the flag to true after showing the alert

                document.addEventListener('click', function() {
                    audio = new Audio('{{ url('storage/audio/Alarm.mp3') }}');
                    audio.play();
                }, {
                    once: true
                }); // Use { once: true } to ensure the event listener is triggered only once
                sendNotification(title, message);
                //sendSms();
            }
            

            // Function to show flood alert
            function showIntruderAlert(title, message) {
                var alertHtml = `<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="dismissAlert()">&times;</button>
                            <h5><i class="icon fas fa-person-through-window"></i>${title}</h5>
                            ${message}
                        </div>`;
                // Append the alert to the card body
                document.querySelector('.card-body').insertAdjacentHTML('beforeend', alertHtml);
                alertShown = true; // Set the flag to true after showing the alert

                document.addEventListener('click', function() {
                    audio = new Audio('{{ url('storage/audio/Alarm.mp3') }}');
                    audio.play();
                }, {
                    once: true
                }); // Use { once: true } to ensure the event listener is triggered only once
                sendNotification(title, message);
                sendSms();
            }
             // Function to show flood alert
             function showIntruderAlert1() {
                var alertHtml = `<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="dismissAlert()">&times;</button>
                            <h5><i class="icon fas fa-person-through-window"></i>Intruder Alert!</h5>
                            Someone open the door by forced at SHS Laboratory.
                        </div>`;
                // Append the alert to the card body
                document.querySelector('.card-body').insertAdjacentHTML('beforeend', alertHtml);
                alertShown = true; // Set the flag to true after showing the alert

                document.addEventListener('click', function() {
                    audio = new Audio('{{ url('storage/audio/Alarm.mp3') }}');
                    audio.play();
                }, {
                    once: true
                }); // Use { once: true } to ensure the event listener is triggered only once
            }

            // Function to send notification to server
            function sendNotification(title, message) {

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        //var data = JSON.parse(this.responseText);
                        //console.log(data);
                    }
                };
                // xhr.open("GET", "/admin/dashboard/send", true);
                // xhr.send();
                var url = "/admin/dashboard/send";
                var params = "title=" + title + "&message=" + message + "&_token=" + encodeURIComponent(
                    '{{ csrf_token() }}'); // Include CSRF token
                xhr.open("POST", url, true);

                // Set the appropriate headers for a POST request
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send(params);


            }

            // Global function to dismiss alert
            window.dismissAlert = function() {
                alertShown = false; // Reset the flag when the alert is dismissed
            };
            // Call fetchData() immediately
            fetchData();
            // Call fetchData() every 5 seconds
            setInterval(fetchData, 5000);
        });
    </script>


</body>

</html>
