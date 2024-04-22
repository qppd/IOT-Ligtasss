<!-- Show -->
<div class="modal fade" id="show">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Gate | New Entry</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/admin/administrator-add"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card" style="width:100%;">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Personal Information</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="photo" class="col-sm-3 control-label">Photo</label>

                                <div class="col-xs-3">
                                    <img class="box-style" src="{{ url('storage/images/users/user.jpg') }}"
                                        id="photo" width="170px" height="150px"></img>

                                </div>
                            </div>

                            <br>
                            <div class="row">

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="surname" class="col-sm-12 control-label">Last Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="surname" name="surname"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="firstname" class="col-sm-12 control-label">First Name</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="firstname" name="firstname"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="middlename" class="col-sm-12 control-label">M.I.</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="middlename" name="middlename"
                                                oninput="this.value = this.value.replace(/[^A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="temperature" class="col-sm-12 control-label">Temperature</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="temperature"
                                                name="temperature">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="metal" class="col-sm-12 control-label">Metal</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="metal" name="metal">
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
