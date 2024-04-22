<script src="{{ url('storage/faceapi/face-api.min.js') }}" defer></script>
@include('ecr/includes/header')
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

        @include('ecr/includes/navbar')
        @include('ecr/includes/menubar')

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
    
            const video = document.getElementById("cameraView");
            const canvas = document.getElementById("faceCanvas");
    
            function fetchData() {
                console.log("Sending!");
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
                xhr.open("GET", "/ecr/cameras/live/fetch/{{ $id }}", true);
                xhr.send();
            }
    
            fetchData();
            setInterval(fetchData, 10000); 
        });
    </script>

</body>

</html>
