<!-- Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Administrator | New</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/admin/administrator-add" enctype="multipart/form-data">
                    @csrf
                    <div class="card" style="width:100%;">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Administrators Information</h3>
                        </div>
                        <div class="card-body">

                            <p>Select a photo of new administrator.</p>

                            <div class="form-group">
                                <label for="photo" class="col-sm-3 control-label">Photo</label>

                                <div class="col-xs-3">
                                    <img class="box-style" src="{{ url('storage/images/administrators/administrator.jpg')}}"
                                        id="administrator_photo" width="170px" height="150px">

                                </div>
                                <input type="file" class="file-chooser"
                                    onchange="document.getElementById('administrator_photo').src = window.URL.createObjectURL(this.files[0])"
                                    id="photo" name="photo" alt="Administrator Photo" required>
                            </div>

                            <br>
                            <p>Fill administrator's personal information below.</p>
                            <div class="row">

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="surname" class="col-sm-12 control-label">Last Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="surname" name="surname"
                                                placeholder="Ex: Mendoza"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="firstname" class="col-sm-12 control-label">First Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="firstname" name="firstname"
                                                placeholder="Ex: John"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="middlename" class="col-sm-12 control-label">M.I.</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="middlename" name="middlename"
                                                placeholder="Ex: Lopez"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <p>Enter administrator's contacts number or email.</p>
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="contact" class="col-sm-12 control-label">Contact No.</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="contact" name="contact"
                                                placeholder="Ex: 09634905586"
                                                oninput="this.value = this.value.replace(/[^0-9 ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="email" class="col-sm-12 control-label">Email Address</label>
                                        <div class="col-xs-12">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Ex: john@gmail.com">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php
							if(session('role') == 0){
								?>
                            <br>
                            <p>Select administrator's bank on list.</p>
                            <div class="row">

                                <div class="col-sm-10">

                                    <div class="form-group">
                                        <label for="bank" class="col-sm-3 control-label">Bank</label>

                                        <div class="col-sm-12">
                                            <select class="form-control" id="bank" name="bank" required>
                                                <option value="" selected>- Select -</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank['id'] }}">{{ $bank['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <?php
								}
								?>



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

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Administrator | Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/admin/administrator-update" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">
                    <div class="card" style="width:100%;">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Administrators Information</h3>
                        </div>
                        <div class="card-body">

                            <p>Select a photo of the administrator. Do not upload any file if you don't want to change it.</p>

                            <div class="form-group">
                                <label for="edit_photo" class="col-sm-3 control-label">Photo</label>

                                <div class="col-xs-3">
                                    <img class="box-style" src=""
                                        id="edit_administrator_photo" width="170px" height="150px">

                                </div>
                                <input type="file" class="file-chooser"
                                    onchange="document.getElementById('edit_administrator_photo').src = window.URL.createObjectURL(this.files[0])"
                                    id="edit_photo" name="photo" alt="Administrator Photo">
                            </div>

                            <br>
                            <p>Fill administrator's personal information below.</p>
                            <div class="row">

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="edit_surname" class="col-sm-12 control-label">Last Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="edit_surname" name="surname"
                                                placeholder="Ex: Mendoza"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="edit_firstname" class="col-sm-12 control-label">First Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="edit_firstname" name="firstname"
                                                placeholder="Ex: John"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="edit_middlename" class="col-sm-12 control-label">M.I.</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="edit_middlename" name="middlename"
                                                placeholder="Ex: Lopez"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <p>Enter administrator's contacts number or email.</p>
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="edit_contact" class="col-sm-12 control-label">Contact No.</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="edit_contact" name="contact"
                                                placeholder="Ex: 09634905586"
                                                oninput="this.value = this.value.replace(/[^0-9 ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="edit_email" class="col-sm-12 control-label">Email Address</label>
                                        <div class="col-xs-12">
                                            <input type="email" class="form-control" id="edit_email" name="email"
                                                placeholder="Ex: john@gmail.com">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php
							if(session('role') == 0){
								?>
                            <br>
                            <p>Select administrator's bank on list.</p>
                            <div class="row">

                                <div class="col-sm-10">

                                    <div class="form-group">
                                        <label for="edit_bank" class="col-sm-3 control-label">Bank</label>

                                        <div class="col-sm-12">
                                            <select class="form-control" id="edit_bank" name="bank" required>
                                                <option value="" selected>- Select -</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank['id'] }}">{{ $bank['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <?php
								}
								?>



                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_status" class="col-sm-3 control-label">Status</label>

                        <div class="col-sm-4">
                            <select class="form-control" id="edit_status" name="status" required>
                                <option value="" selected>- Select -</option>
                                <option value="1">Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update</button>
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
                <h4 class="modal-title">Administrator | Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/admin/administrator-delete">
                    @csrf
                    <input type="hidden" id="delete_id" name="id">
                    <div class="text-center">
                        <h2 class="bold"> Are you sure you want to delete this Administrator?</h2>
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
