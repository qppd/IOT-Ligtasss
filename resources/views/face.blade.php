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

    .content-wrapper {
        background-image: url('{{ url('storage/images/login-bg.jpg') }}');
        background-size: cover;
        background-position: center;
    }
</style>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('storage/images/login-logo.png') }}" alt="Ligtasss" height="180"
                width="180">
            <h1>Ligtasss</h1>
        </div>
        <!-- Preloader -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

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
                        <div class="col-sm-12">
                            <div id="cameraContainer">
                                {{-- <canvas id="faceCanvas" width="240" height="160"
                                    style="position: absolute;"></canvas>
                                <img id="cameraView" style="display: none;"></img> --}}
                                <canvas id="faceCanvas" width="240" height="160"
                                    style="position: absolute;"></canvas>
                                <img id="cameraView"></img>
                            </div>
                        </div>
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
        // $(window).on('load', function() {
        //     var delayMs = 1500; // delay in milliseconds

        //     setTimeout(function() {
        //         $('#show').modal('show');
        //     }, delayMs);
        // });

        // $(document).ready(function() {
        //     $('#delete').modal('show');
        //     $('#show').modal('show');
        //     $(document).on("click", ".delete", function() {

        //         var id = $(this).data('id');
        //         $('#delete_id').val(id);
        //     });
        // });
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
        let isFaceLoaded = false; // Flag to indicate if faceapi has finished loading
        let isFaceRecognitionActive = false; // Variable to track face recognition status
        let intervalId; // Variable to hold the interval id for fetching ultrasonic value
        let lastFaceDetectionTime = Date.now(); // Variable to store the timestamp of the last face detection
        let faceRecognitionInterval;
        document.addEventListener("DOMContentLoaded", function() {
            const cameraView = document.getElementById("cameraView");
            const canvas = document.getElementById("faceCanvas");

            var body_temperature = 0;
            var metal1 = 0;
            var metal2 = 0;

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
                isFaceLoaded = true; // Set the flag to indicate faceapi is loaded

                // Start interval to fetch ultrasonic value only if faceapi is loaded
                intervalId = setInterval(fetchUltrasonicValue, 2000);
            }

            async function fetchUltrasonicValue() {
                if (!isFaceLoaded) return; // Don't fetch ultrasonic value if faceapi is not loaded

                console.log("Fetching ultrasonic value");
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

            function decodeGateJson(nodes) {
                var ultrasonic1 = nodes["ultrasonic1"];
                var ultrasonic2 = nodes["ultrasonic2"];
                body_temperature = nodes["temperature"];
                metal1 = nodes["metal1"];
                metal2 = nodes["metal2"];
                //var body_temperature = nodes[temperature];


                console.log("Ultrasonic:" + ultrasonic1);
                console.log("Ultrasonic:" + ultrasonic2);

                // Check if ultrasonic value is less than 15 and face recognition is not active
                if ((parseFloat(ultrasonic1) < 20 || parseFloat(ultrasonic2) < 20) && !isFaceRecognitionActive) {
                    lastFaceDetectionTime = Date.now();
                    console.log("Starting face recognition");
                    isFaceRecognitionActive = true;
                    clearInterval(intervalId); // Stop fetching ultrasonic value
                    setInterval(handleFaceNotDetected, 2000);
                    fetchFaceRecognitionData(); // Start face recognition
                }
            }

            async function fetchFaceRecognitionData() {
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

                if (detections.length > 0 && isFaceRecognitionActive) {

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
                        if (result._distance >= 0.4) {
                            drawBox.draw(canvas);
                            $('#show').modal('hide');
                            
                            // Make an HTTP request to find the user in the Laravel database
                            try {
                                const response = await fetch(
                                    `/admin/cameras/live/find/${label}`);
                                if (response.ok) {
                                    const userData = await response.json();


                                    console.log('User data:', userData);
                                    if (userData) {
                                        $('#show').modal('show');

                                        const baseUrl = "{{ asset('storage/images/employees/') }}";
                                        $('#photo').attr("src", `${baseUrl}/${userData.photo}`);
                                        $('#surname').val(userData.surname);
                                        $('#firstname').val(userData.firstname);
                                        $('#middlename').val(userData.middlename);
                                        $('#temperature').val(body_temperature);
                                        var metal = 0;
                                        if (metal1 == 1 || metal2 == 1) {
                                            metal = 1;
                                        } else {
                                            metal = 0;
                                        }

                                        var entry_data = {
                                            user_id: userData.user_id,
                                            temperature: body_temperature,
                                            metal: metal,
                                        };

                                        fetch('/save-gate-entry', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                                                },
                                                body: JSON.stringify(entry_data)
                                            })
                                            .then(response => {
                                                if (response.ok) {
                                                    return response.json();
                                                } else {
                                                    throw new Error(
                                                        'Failed to save gate entry!');
                                                }
                                            })
                                            .then(data => {
                                                if (data.result == "1") {
                                                    console.log("saved");
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                            });

                                        clearInterval(faceRecognitionInterval);
                                    }
                                } else {
                                    console.error("Error:" + response);
                                }
                            } catch (error) {
                                console.error('Error while making the request:', error);
                            }
                        }
                    });
                } else if (detections.length == 0 && isFaceRecognitionActive) {
                    console.log("No faces detected");

                    fetchFaceRecognitionData(); // Start face recognition
                }
            }

            async function getLabeledFaceDescriptions() {
                var labels = @json($staffs);
                console.log(labels);
                return Promise.all(
                    labels.map(async (label) => {
                        const descriptions = [];
                        for (let i = 1; i <= 4; i++) {
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

            // Function to stop face recognition and resume ultrasonic value fetching
            function stopFaceRecognition() {
                console.log("Stopping face recognition");
                isFaceRecognitionActive = false;
                intervalId = setInterval(fetchUltrasonicValue, 2000); // Resume fetching ultrasonic value
            }

            // Function to handle face not detected 
            function handleFaceNotDetected() {
                console.log("Checking for face detection...");
                const currentTime = Date.now();
                const timeSinceLastDetection = currentTime - lastFaceDetectionTime;

                if (timeSinceLastDetection >= 10000 && isFaceRecognitionActive) {
                    console.log("Face not detected for 10 seconds. Stopping face recognition.");
                    stopFaceRecognition();
                    lastFaceDetectionTime = Date.now(); // Reset last face detection time
                }
            }

        });
    </script>


</body>

</html>
