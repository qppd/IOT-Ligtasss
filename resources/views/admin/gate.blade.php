@include('includes/header')
{{-- @include('includes/modal_municipalities') --}}

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('storage/images/login-logo.png') }}" alt="Ligtasss"
                height="180" width="180">
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
                            <h1>Smart Gate</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Smart Gate</li>
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
                                <table id="example1" class="table table-bordered table-striped">
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

                                        @foreach ($gates as $gate)
                                            <tr>
        
                                                <td>{{ $gate['staff'] }}</td>
                                                <td>{{ $gate['face_id'] }}</td>
                                                <td>{{ $gate['body_temperature'] }}</td>
                                                <td>{{ $gate['metal_detection'] }}</td>
                                                <td>{{ $gate['status'] }}</td>
                                                {{-- <td>{{ $gate['face_id'] }}</td> --}}
                                                {{-- <td>{{ $gate['status'] }}</td> --}}
                                               

                                                    {{-- <button type="button" class="btn btn-success btn-sm edit"
                                                        data-id="{{ $municipality['id'] }}"
                                                        data-name="{{ $municipality['name'] }}"
                                                        data-latitude="{{ $municipality['latitude'] }}"
                                                        data-longitude="{{ $municipality['longitude'] }}"
                                                        data-status="{{ $municipality['status'] }}"><i
                                                            class="fas fa-edit"></i> Edit</button>


                                                    <button type="button" class="btn btn-danger btn-sm delete"
                                                        data-id="{{ $municipality['id'] }}"><i
                                                            class="fas fa-trash"></i> Delete</button> --}}

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                                
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

    

    



</body>

</html>
