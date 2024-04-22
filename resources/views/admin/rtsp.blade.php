<script src="{{ url('storage/faceapi/face-api.min.js') }}" defer></script>
@include('admin/includes/header')
{{-- @include('includes/modal_municipalities') --}}

<style>
    #cameraView {
        width: 640px;
        height: 480px;
        margin: 0 auto;
        /* background: black; */
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
                                <li class="breadcrumb-item active">Live Feed</li>
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

                                            <img id="cameraView" src="http://127.0.0.1:5000/video_feed" alt="Video Feed">
                                            {{-- <video id="cameraView" controls autoplay></video> --}}

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

    {{-- <script>
        var videoElement = document.getElementById('cameraView');
        videoElement.crossOrigin = "anonymous";
        function fetchStream() {
            console.log('Fetching stream...');
            fetch('http://127.0.0.1:5000/video_feed')
                .then(response => {
                    console.log('Response received:', response);
                    return response.body;
                })
                .then(body => {
                    console.log('Body received:', body);
                    const reader = body.getReader();
                    const mediaSource = new MediaSource();
                    let videoBuffer = [];
                    let mediaSourceOpened = false;

                    videoElement.src = URL.createObjectURL(mediaSource);

                    mediaSource.addEventListener('sourceopen', () => {
                        console.log('MediaSource opened');
                        const sourceBuffer = mediaSource.addSourceBuffer('video/mp4; codecs="avc1.4d002a"');
                        mediaSourceOpened = true;

                        function processQueue() {
                            while (videoBuffer.length > 0 && !sourceBuffer.updating) {
                                const frame = videoBuffer.shift();
                                sourceBuffer.appendBuffer(frame);
                            }
                        }

                        reader.read().then(function process({
                            done,
                            value
                        }) {
                            if (done) {
                                console.log('ReadableStream ended');
                                if (mediaSourceOpened) {
                                    mediaSource.endOfStream();
                                }
                                return;
                            }
                            console.log('Received frame');

                            videoBuffer.push(value);
                            processQueue();
                            return reader.read().then(process);
                        });
                    });
                    videoElement.play();
                })
                .catch(error => console.error('Error fetching stream:', error));
        }

        fetchStream();
    </script> --}}

</body>

</html>
