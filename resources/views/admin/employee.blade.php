@include('admin/includes/header')
@include('admin/includes/modal_employees')

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
                            <h1>Employees</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Employees</li>
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
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Employee ID</th>
                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>Contact No.</th>
                                            <th>Status</th>
                                            <th>Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- SELECT `id`, `role`, `username`, `firstname`, 
                                                `middlename`, `surname`, `address`, `photo`, 
                                                `email`, `contact`, `password`, `status`, 
                                                `verification_token`, `verification_status`, 
                                                `created_at`, `updated_at`, `administrator_id` 
                                                FROM `users` WHERE 1 --}}
                                        @foreach ($employees as $index => $employee)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $employee['employee_id'] }}</td>
                                                <td><img src="{{ url('storage/images/employees/' . $employee['photo']) }}"
                                                    alt="Employee" class="brand-image img-circle elevation-3"
                                                    style="width:60px;height:60px;"></td>
                                                <td>{{ $employee['name'] }}</td>
                                                <td>{{ $employee['email'] }}</td>
                                                <td>{{ $employee['contact'] }}</td>
                                                <td>{{ $employee['status'] }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm edit"
                                                        data-id="{{ $employee['id'] }}"
                                                        data-employee_id="{{ $employee['employee_id'] }}"
                                                        data-firstname="{{ $employee['firstname'] }}"
                                                        data-middlename="{{ $employee['middlename'] }}"
                                                        data-surname="{{ $employee['surname'] }}"
                                                        data-email="{{ $employee['email'] }}"
                                                        data-contact="{{ $employee['contact'] }}"
                                                        data-status="{{ $employee['stat_no'] }}"><i
                                                            class="fas fa-edit"></i> Edit</button>

                                                    <button type="button" class="btn bg-navy btn-sm addface"
                                                        data-id="{{ $employee['employee_id'] }}"><i
                                                            class="fas fa-image-portrait"></i> Add Face</button>

                                                    <button type="button" class="btn btn-danger btn-sm delete"
                                                        data-id="{{ $employee['id'] }}"><i class="fas fa-trash"></i>
                                                        Delete</button>

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

    <script>
        $(function() {

            $('#example1 tbody').on("click", ".edit", function() {
                $('#edit').modal('show');


                var id = $(this).data('id');
                var employee_id = $(this).data('employee_id');

                var firstname = $(this).data('firstname');
                var middlename = $(this).data('middlename');
                var surname = $(this).data('surname');
                var email = $(this).data('email');
                var contact = $(this).data('contact');
                var status = $(this).data('status');

                console.log(surname, firstname, middlename);

                $('#edit_id').val(id);
                $('#edit_employee_id').val(employee_id);
                $('#edit_firstname').val(firstname);
                $('#edit_middlename').val(surname);
                $('#edit_surname').val(surname);
                $('#edit_email').val(email);
                $('#edit_contact').val(contact);
                $('#edit_status').val(status).change();
            });

            $('#example1 tbody').on("click", ".delete", function() {
                $('#delete').modal('show');
                var id = $(this).data('id');

                //$('#delete_id').val(id);

                var formAction = '/admin/employees/delete/' + id;
                $('#formDelete').attr('action', formAction);
            });

            $('#example1 tbody').on("click", ".addface", function() {
                $('#addface').modal('show');
                var id = $(this).data('id');
                
                console.log("ID:" + id);
                $('#add_face_id').val(id);

                // var formAction = '/admin/employees/add-face/' + id;
                // $('#formAddface').attr('action', formAction);
            });
        });
    </script>

</body>

</html>
