<script src="{{ url('storage/faceapi/face-api.min.js') }}" defer></script>
@include('includes/header')
@include('includes/modal_gate')

<style>
    #cameraView {
        width: 240px;
        height: 160px;
        margin: 0 auto;
        background: black;
        border: 5px solid black;
        border-radius: 10px;
        box-shadow: 0 5px 50px #333
    }
</style>

<body class="hold-transition layout-boxed layout-top-nav">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('storage/images/login-logo.png') }}" alt="IOT Ligtas" height="180"
                width="180">
            <h1>Ligtas</h1>
        </div>
        <!-- Preloader -->

        @include('includes/navbar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Smart Gate</h1>
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



                                {{-- @foreach ($cameras as $index => $camera)
                                        <div class="col-md-12 col-lg-6 col-xl-4">
                                            <div class="card mb-2">
                                                <img class="card-img-top"
                                                    src="{{ url('storage/images/cctv-image.png') }}" alt="Dist Photo 3">
                                                <div class="card-img-overlay">
                                                    <h5 class="card-title text-primary">Camera {{ $index + 1 }}</h5>
                                                    <br>
                                                    <h5 class="card-title text-primary">ID: {{ $camera['camera_id'] }}
                                                    </h5>
                                                    <br>
                                                    <h5 class="card-title text-primary">TYPE: {{ $camera['type'] }}</h5>
                                                    <p class="card-text pb-1 pt-1 text-white">
                                                        <br>
                                                        <br>
                                                        <br> <br>
                                                        <br>
                                                    </p>
                                                    <a href="/ecr/cameras/live/{{ $camera['camera_id'] }}" class="text-primary">View Live Camera Feed</a>
                                                    <br>

                                                    <button type="button" class="btn btn-danger btn-sm delete"
                                                        data-id="{{ $camera['id'] }}"><i class="fas fa-trash"></i>
                                                        Remove</button>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach --}}

                                <table id="example4" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Face</th>
                                            <th>Temperature</th>
                                            <th>Metal</th>
                                            <th>Status</th>
                                            {{-- <th>Tools</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>

                                        {{-- @foreach ($gates as $gate)
                                                <tr>
                                                    <td>{{ $gate['staff'] }}</td>
                                                    <td>{{ $gate['face_id'] }}</td>
                                                    <td>{{ $gate['body_temperature'] }}</td>
                                                    <td>{{ $gate['metal_detection'] }}</td>
                                                    <td>{{ $gate['status'] }}</td>
                                                </tr>
                                            @endforeach --}}

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="cameraContainer">
                                            <canvas id="faceCanvas" width="480" height="320"
                                                style="position: absolute;"></canvas>
                                            {{-- <video id="cameraView" autoplay playsinline muted></video> --}}
                                            <img id="cameraView"></img>
                                        </div>
                                    </div>
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
        let fetchFaceRecognitionData;
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
                xhr.open("GET", "/fetch", true);
                xhr.send();
            }

            function getData(datas) {
                for (var key in datas) {
                    if (datas.hasOwnProperty(key)) {
                        var nodes = datas[key];
                        if (key == "reading") {
                            decodeGateJson(nodes);
                        }
                    }
                }
            }

            function decodeCamerasModulesJson(nodes) {

                var cameras = nodes["AB8XFH8K5L"];
                console.log(cameras);


            }

            function decodeGateJson(nodes) {
                var temperature = nodes["temperature"];
                var metal1 = nodes["metal1"];
                var metal2 = nodes["metal2"];
                var scan = nodes["scan"];
                var ultrasonic1 = nodes["ultrasonic1"];

                console.log("Temperature:" + temperature);
                console.log("Metal 1:" + metal1);
                console.log("Metal 2:" + metal2);
                console.log("Scan:" + scan);
                console.log("Ultrasonic 1:" + ultrasonic1);

                // Check if ultrasonic value is less than 15
                if (parseFloat(ultrasonic1) < 15) {
                    // Only fetch face recognition data if ultrasonic value is less than 15
                    fetchFaceRecognitionData();
                }
            }



            // Fetch datas from firebase
            fetchData();

            setInterval(fetchData, 10000);
        });
    </script>


    <script>
        $(document).ready(function() {
            $(document).on("click", ".delete", function() {
                $('#delete').modal('show');
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        });
        // $(function() {

        //     $('#example2 card-img-overlay').on("click", ".delete", function() {
        //         $('#delete').modal('show');
        //         var id = $(this).data('id');

        //         $('#delete_id').val(id);
        //     });


        // });
    </script>

    <script>
        let faceMatcher;

        document.addEventListener("DOMContentLoaded", function() {

            const video = document.getElementById("cameraView");
            const canvas = document.getElementById("faceCanvas");

            Promise.all([
                faceapi.nets.ssdMobilenetv1.loadFromUri("{{ asset('storage/weights') }}"),
                faceapi.nets.faceLandmark68Net.loadFromUri("{{ asset('storage/weights') }}"),
                faceapi.nets.faceRecognitionNet.loadFromUri("{{ asset('storage/weights') }}"),
                faceapi.nets.faceLandmark68Net.loadFromUri("{{ asset('storage/weights') }}"),
                faceapi.nets.tinyFaceDetector.loadFromUri("{{ asset('storage/weights') }}"),
            ]).then(start);

            async function start() {
                const labeledFaceDescriptors = await getLabeledFaceDescriptions();
                faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);
                //fetchFaceRecognitionData();
                //setInterval(fetchFaceRecognitionData, 60000);
            }

            fetchFaceRecognitionData = function() {
                console.log("Sending face recognition image request");
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(this.responseText);

                        for (var key in data) {
                            if (data.hasOwnProperty(key)) {
                                var value = data[key];
                                displayImage(value);
                            }
                        }
                    }
                };
                xhr.open("GET", "/admin/cameras/live/fetch/AB8XFH8K5L", true);
                xhr.send();
            }

            async function displayImage(base64Image) {

                cameraView.src = "data:image/jpeg;base64," + base64Image;
                //Detect faces in the image
                const detections = await faceapi.detectAllFaces(cameraView, new faceapi
                        .TinyFaceDetectorOptions())
                    .withFaceLandmarks().withFaceDescriptors();

                if (detections.length > 0) {

                    const displaySize = {
                        width: 1080,
                        height: 720
                    };

                    const resizedDetections = faceapi.resizeResults(detections, displaySize);

                    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
                    faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);

                    const results = resizedDetections.map((d) => {
                        return faceMatcher.findBestMatch(d.descriptor);
                    });

                    results.forEach(async (result, i) => {
                        const label = result._label;
                        const box = resizedDetections[i].detection.box;
                        const drawBox = new faceapi.draw.DrawBox(box, {
                            label: label,
                        });

                        console.log(result._distance);
                        if (result._distance < 0.5) {
                            drawBox.draw(canvas);
                            // Make an HTTP request to find the user in the Laravel database
                            try {
                                const response = await fetch(
                                    `/ecr/cameras/live/find/${label}`);
                                if (response.ok) {
                                    const userData = await response.json();


                                    console.log('User data:', userData);
                                    if (userData) {

                                        try {
                                            const saveResponse = await fetch('/save-user-data', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify(userData)
                                            });
                                            if (saveResponse.ok) {
                                                console.log('User data saved successfully.');
                                            } else {
                                                console.error('Error saving user data:',
                                                    saveResponse);
                                            }
                                        } catch (error) {
                                            console.error('Error while saving user data:', error);
                                        }

                                        //clearInterval(faceRecognitionInterval);
                                    }
                                } else {
                                    console.error("Error:" + response);
                                }
                            } catch (error) {
                                console.error('Error while making the request:', error);
                            }
                        }


                    });

                } else {
                    console.log("No faces detected");
                }

            }

            async function getLabeledFaceDescriptions() {
                var labels = @json($staffs);
                console.log(labels);
                return Promise.all(
                    labels.map(async (label) => {

                        const descriptions = [];
                        for (let i = 1; i <= 2; i++) {

                            const assetLink =
                                `{{ asset('storage/images/users/${label}/${i}.jpg') }}`;
                            console.log("LINK:" + assetLink);

                            const image = await faceapi.fetchImage(assetLink);

                            const detections = await faceapi
                                .detectSingleFace(image)
                                .withFaceLandmarks()
                                .withFaceDescriptor();
                            descriptions.push(detections.descriptor);

                        }
                        return new faceapi.LabeledFaceDescriptors(label.toString(), descriptions);
                    })
                );
            }

        });
    </script>

</body>

</html>
