@include('admin/includes/header')

{{-- <head>
    <link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet">
    <link href="//vjs.zencdn.net/8.3.0/video-js.min.css" rel="stylesheet">
    <script src="//vjs.zencdn.net/8.3.0/video.min.js"></script>
</head> --}}

@include('admin/includes/modal_cameras')

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
                            <h1>Videos</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Cameras</li>
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
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="row">
                                    @foreach ($videos as $index => $video)
                                        <div class="col-md-12 col-lg-6 col-xl-4">
                                            <div class="card mb-2">

                                                {{-- <video id="my-player" class="video-js" controls preload="auto"
                                                    poster="//vjs.zencdn.net/v/oceans.png" data-setup='{}'>
                                                    <source src="{{ asset('storage/videos/' . $video) }}"
                                                        type="video/mp4">
                                                    </source>
                                                    <p class="vjs-no-js">
                                                        To view this video please enable JavaScript, and consider
                                                        upgrading to a
                                                        web browser that
                                                        <a href="https://videojs.com/html5-video-support/"
                                                            target="_blank">
                                                            supports HTML5 video
                                                        </a>
                                                    </p>
                                                </video> --}}

                                                <video controls id="modal-video" style="width:100%" preload="metadata">
                                                    <source src="{{ asset('storage/videos/' . $video) }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                <p>{{ $video }}</p>
                                            </div>
                                        </div>
                                    @endforeach
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
        // Wait for the DOM to be ready
        document.addEventListener('DOMContentLoaded', function() {
            // Options for the player (if any)
            var options = {};

            // Create the player
            var player = videojs('my-player', options, function onPlayerReady() {
                // Log a message when the player is ready
                videojs.log('Your player is ready!');

                // Start playing the video
                this.play();

                // Add an event listener for when the video ends
                this.on('ended', function() {
                    videojs.log('Awww...over so soon?!');
                });
            });
        });
    </script> --}}

</body>

</html>
