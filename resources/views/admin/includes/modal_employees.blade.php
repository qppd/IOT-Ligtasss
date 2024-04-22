<!-- Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Employee | New</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/admin/employees/add"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card" style="width:100%;">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Employee Information & Details</h3>
                        </div>
                        <div class="card-body">

                            <p>Select a photo of the employee.</p>

                            <div class="form-group">
                                <label for="photo" class="col-sm-3 control-label">Photo</label>

                                <div class="col-xs-3">
                                    <img class="box-style" src="{{ url('storage/images/users/user.jpg') }}"
                                        id="employee_photo" width="170px" height="150px">

                                </div>
                                <input type="file" placeholder="" class="file-chooser"
                                    onchange="document.getElementById('employee_photo').src = window.URL.createObjectURL(this.files[0])"
                                    id="photo" name="photo" alt="Employee Photo" required>
                            </div>
                            
                            <p>Provide employee's identification number.</p>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="employee_id" class="col-sm-12 control-label">Employee ID</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="employee_id"
                                                name="employee_id" placeholder="Ex: 0000000001"
                                                oninput="this.value = this.value.replace(/[^A-Z 0-9 -]/g, '');"
                                                maxlength="11" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <p>Fill employee's personal information below.</p>
                            <div class="row">

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="surname" class="col-sm-12 control-label">Last Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="surname" name="surname"
                                                placeholder="Ex: Mendoza"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="firstname" class="col-sm-12 control-label">First Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="firstname" name="firstname"
                                                placeholder="Ex: John"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="middlename" class="col-sm-12 control-label">Middle Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="middlename" name="middlename"
                                                placeholder="Ex: Lopez"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <p>Enter employee's contacts number and email address.</p>
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="contact" class="col-sm-12 control-label">Contact No.</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="contact" name="contact"
                                                placeholder="Ex: 09634905586" maxlength="11"
                                                oninput="this.value = this.value.replace(/[^0-9 ]/g, '');" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="email" class="col-sm-12 control-label">Email Address</label>
                                        <div class="col-xs-12">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Ex: john@gmail.com" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- Add -->

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Employee | Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/admin/employees/edit"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="edit_id" name="id">
                    <div class="card" style="width:100%;">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Employee Information & Details</h3>
                        </div>
                        <div class="card-body">
                            <p>Provide employee's identification number.</p>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="edit_employee_id" class="col-sm-12 control-label">Employee
                                            ID</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="edit_employee_id"
                                                name="employee_id" placeholder="Ex: 0000000001"
                                                oninput="this.value = this.value.replace(/[^A-Z 0-9 , ]/g, '');"
                                                maxlength="11">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <p>Fill employee's personal information below.</p>
                            <div class="row">

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="edit_surname" class="col-sm-12 control-label">Last Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="edit_surname"
                                                name="surname" placeholder="Ex: Mendoza"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="edit_firstname" class="col-sm-12 control-label">First Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="edit_firstname"
                                                name="firstname" placeholder="Ex: John"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="edit_middlename" class="col-sm-12 control-label">Middle
                                            Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="edit_middlename"
                                                name="middlename" placeholder="Ex: Lopez"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <p>Enter employee's contacts number and email address.</p>
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="edit_contact" class="col-sm-12 control-label">Contact No.</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="edit_contact"
                                                name="contact" placeholder="Ex: 09634905586"
                                                oninput="this.value = this.value.replace(/[^0-9 ]/g, '');"
                                                maxlength="11">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="edit_email" class="col-sm-12 control-label">Email Address</label>
                                        <div class="col-xs-12">
                                            <input type="email" class="form-control" id="edit_email"
                                                name="email" placeholder="Ex: john@gmail.com">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <p>Choose employee's status.</p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="edit_status" class="col-sm-12 control-label">Status</label>

                                        <div class="col-sm-5">
                                            <select class="form-control" id="edit_status" name="status" required>
                                                <option value="" selected>- Select -</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- Edit -->

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Employee | Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDelete" class="form-horizontal" method="GET" action="">
                    @csrf
                    {{-- <input type="text" id="delete_id" name="id"> --}}
                    <div class="text-center">
                        <h2 class="bold"> Are you sure you want to delete this Employee?</h2>
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                <button type="submit" class="btn btn-danger"> Delete</button>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- Delete -->


<!-- Upload -->
<div class="modal fade" id="upload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Professors | Upload</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/admin/professor/upload"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="excel" class="col-sm-3 control-label">Excel</label>

                        <div class="col-sm-12">
                            <input type="file" accept=".xls, .xlsx" id="excel" name="excel">
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- Upload -->


<!-- Add Face -->
<div class="modal fade" id="addface">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Employee | Add Face</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAddface" class="form-horizontal" enctype="multipart/form-data" method="POST"
                    action="/admin/employees/add-face">
                    @csrf
                    <input type="text" id="add_face_id" name="employee_no">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="photo">Photos</label>
                                <input type="file" accept="image/png, image/gif, image/jpeg" id="photo"
                                    name="photos[]" multiple />
                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                <button type="submit" class="btn bg-navy"> Upload</button>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- Add Face -->
