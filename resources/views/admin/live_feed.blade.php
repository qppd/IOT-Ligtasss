<script src="{{ url('storage/faceapi/face-api.min.js') }}" defer></script>
@include('admin/includes/header')
{{-- @include('includes/modal_municipalities') --}}

<style>
    #cameraView {
        width: 1080px;
        height: 720px;
        margin: 0 auto;
        background: black;
        border: 5px solid black;
        border-radius: 10px;
        box-shadow: 0 5px 50px #333
    }
</style>

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
                            <h1>Live Feed</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                                <li class="breadcrumb-item">Camera </li>
                                <li class="breadcrumb-item active">Live Feed {{ $id }}</li>
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
                                    <div class="col-md-12">
                                        <div id="cameraContainer">
                                            <canvas id="faceCanvas" width="1080" height="720"
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
        let faceMatcher;

        document.addEventListener("DOMContentLoaded", function() {

            const video = document.getElementById("cameraView");
            const canvas = document.getElementById("faceCanvas");


            if ({{ $type }} == 0) {
                Promise.all([
                    faceapi.nets.ssdMobilenetv1.loadFromUri("{{ asset('storage/weights') }}"),
                    faceapi.nets.faceLandmark68Net.loadFromUri("{{ asset('storage/weights') }}"),
                    faceapi.nets.faceRecognitionNet.loadFromUri("{{ asset('storage/weights') }}"),
                    faceapi.nets.faceLandmark68Net.loadFromUri("{{ asset('storage/weights') }}"),
                    faceapi.nets.tinyFaceDetector.loadFromUri("{{ asset('storage/weights') }}"),
                ]).then(start);
            } else if ({{ $type }} == 1) {
                fetchMonitoringData();
                setInterval(fetchMonitoringData, 10000);
            }



            async function start() {
                const labeledFaceDescriptors = await getLabeledFaceDescriptions();
                faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);
                fetchFaceRecognitionData();
                setInterval(fetchFaceRecognitionData, 10000);
            }

            function fetchMonitoringData() {

                console.log("Sending monitoring image request");
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(this.responseText);

                        for (var key in data) {
                            if (data.hasOwnProperty(key)) {
                                var value = data[key];
                                cameraView.src = "data:image/jpeg;base64," + value;

                            }
                        }
                    }
                };
                xhr.open("GET", "/admin/cameras/live/fetch/{{ $id }}", true);
                xhr.send();
            }

            function fetchFaceRecognitionData() {
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
                xhr.open("GET", "/admin/cameras/live/fetch/{{ $id }}", true);
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
                                    // if (userData) {
                                    //     clearInterval(faceRecognitionInterval);
                                    // }
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
