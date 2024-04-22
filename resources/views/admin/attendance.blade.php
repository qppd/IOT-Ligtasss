@include('admin/includes/header')
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
                            <h1>Attendance</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Attendance</li>
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
                                            <th>#</th>
                                            <th>RFID</th>
                                            <th>Student's Name</th>
                                            <th>Room No.</th>
                                            <th>Date</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($attendances as $index => $attendance)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $attendance['reference_id'] }}</td>
                                                <td>{{ $attendance['student'] }}</td>
                                                <td>{{ $attendance['room_id'] }}</td>
                                                <td>{{ $attendance['date'] }}</td>
                                                <td>{{ $attendance['time_in'] }}</td>
                                                <td>{{ $attendance['time_out'] }}</td>
                                                <td>{{ $attendance['status'] }}</td>
                                                {{-- <td>
                                                    <center><span class="badge bg-green">ACTIVE</span></center>
                                                    
                                                    <center><span class="badge bg-red">INACTIVE</span></center>
                                                    
                                                </td> --}}
                                                {{-- <td>

                                                    <button type="button" class="btn btn-success btn-sm edit"
                                                        data-id="{{ $attendance['id'] }}"
                                                        data-name="{{ $attendance['name'] }}"
                                                        data-latitude="{{ $attendance['latitude'] }}"
                                                        data-longitude="{{ $attendance['longitude'] }}"
                                                        data-status="{{ $attendance['status'] }}"><i
                                                            class="fas fa-edit"></i> Edit</button>


                                                    <button type="button" class="btn btn-danger btn-sm delete"
                                                        data-id="{{ $attendance['id'] }}"><i
                                                            class="fas fa-trash"></i> Delete</button>

                                                </td> --}}
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
