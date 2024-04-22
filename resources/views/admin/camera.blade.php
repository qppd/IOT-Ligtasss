@include('admin/includes/header')
@include('admin/includes/modal_cameras')
<style>
    #cameraView {
        width: 100%;
        height: 100%;
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
                            <h1>Cameras</h1>
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
                                <a href="#add" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i
                                        class="fas fa-plus"></i> New</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="row">
                                    @foreach ($cameras as $index => $camera)
                                        <div class="col-md-12 col-lg-6 col-xl-4">
                                            <div class="card mb-2">
                                                {{-- <img class="card-img-top"
                                                    src="{{ url('storage/images/cctv-image.png') }}" alt="Dist Photo 3"> --}}
                                                <img id="cameraView"
                                                    src="http://127.0.0.1:5000/video_feed/{{ $camera['url'] . '=' . $camera['camera_id'] }}"
                                                    alt="Video Feed">
                                                <div class="card-img-overlay">
                                                    <h5 class="card-title text-primary">Camera {{ $index + 1 }}</h5>
                                                    <p class="card-text pb-1 pt-1 text-white">ID:
                                                        {{ $camera['camera_id'] }}<br />Type: {{ $camera['type'] }}</p>
                                                    <a href="/admin/cameras/videos/{{ $camera['camera_id'] }}"
                                                        target="_blank" class="text-primary">Playback</a>



                                                    {{-- @if ($camera['type'] == 1)
                                                        <a href="/admin/cameras/rtsp" class="text-primary">View Live
                                                            Camera
                                                            Feed</a>
                                                        <br />
                                                        <a href="/admin/cameras/videos/{{ $camera['camera_id'] }}"
                                                            class="text-primary">Playback</a>
                                                        <br />
                                                    @elseif($camera['type'] == 0)
                                                        <a href="/admin/cameras/live/{{ $camera['camera_id'] }}"
                                                            class="text-primary">View Live Camera Feed</a>
                                                        <br />
                                                    @endif --}}

                                                </div>

                                                <button type="button" class="btn btn-danger btn-sm delete"
                                                    data-id="{{ $camera['id'] }}"><i class="fas fa-trash"></i>
                                                    Remove</button>

                                            </div>
                                        </div>




                                        {{-- <div class="card mb-2">
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
                                                    <a href="/admin/cameras/live/{{ $camera['camera_id'] }}"
                                                        class="text-primary">View Live Camera Feed</a>
                                                    <br>

                                                    <button type="button" class="btn btn-danger btn-sm delete"
                                                        data-id="{{ $camera['id'] }}"><i class="fas fa-trash"></i>
                                                        Remove</button>

                                                </div>
                                            </div></div> --}}
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


    <script>
        $(document).ready(function() {
            $(document).on("click", ".delete", function() {
                $('#delete').modal('show');
                var id = $(this).data('id');
                //$('#delete_id').val(id);
                console.log("ID: " + id);
                var formAction = '/admin/cameras/delete/' + id;
                $('#formDelete').attr('action', formAction);

            });
        });

        // });
    </script>




</body>

</html>
