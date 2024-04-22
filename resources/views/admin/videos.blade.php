@include('admin/includes/header')

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
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <label for="sort-by">Sort By:</label>
                                        <select id="sort-by" class="form-control">
                                            <option value="latest">Latest</option>
                                            <option value="oldest">Oldest</option>
                                            <!-- Add more sorting options as needed -->
                                        </select>
                                    </div>
                                </div>
                            
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="row" id="video-container">
                                    @foreach ($videos as $index => $video)
                                        <div class="col-md-12 col-lg-6 col-xl-4">
                                            <div class="card mb-2">
                                                <video controls id="modal-video" style="width:100%" preload="metadata">
                                                    <source src="{{ asset('storage/videos/' . $video) }}" type="video/mp4">
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

    <script>
        
        function sortVideos(sortBy) {
            var container = document.getElementById('video-container');
            var videos = Array.from(container.children);
            videos.sort(function(a, b) {
                var aDate = a.querySelector('p').innerText;
                var bDate = b.querySelector('p').innerText;
                return sortBy === 'latest' ? bDate.localeCompare(aDate) : aDate.localeCompare(bDate);
            });
            container.innerHTML = '';
            videos.forEach(function(video) {
                container.appendChild(video);
            });
        }

        document.getElementById('sort-by').addEventListener('change', function() {
            var sortBy = this.value;
            sortVideos(sortBy);
        });

    </script>

</body>

</html>