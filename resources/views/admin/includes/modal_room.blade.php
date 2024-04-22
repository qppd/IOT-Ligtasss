<!-- Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Room | New</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/admin/rooms/add" enctype="multipart/form-data">
                    @csrf
                    <div class="card" style="width:100%;">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Room Device Configuration</h3>
                        </div>
                        <div class="card-body">

                            <br>
                            <p>Enter room's device identication number.</p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="device_id" class="col-sm-12 control-label">ID</label>
                                        <div class="col-xs-7">
                                            <input type="text" class="form-control" id="device_id" name="device_id"
                                                placeholder="Ex: 59385728192"
                                                oninput="this.value = this.value.replace(/[^0-9 ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <p>Enter room details.</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="room_no" class="col-sm-12 control-label">Room No.</label>
                                        <div class="col-xs-7">
                                            <input type="text" class="form-control" id="room_no" name="room_no"
                                                placeholder="Ex: 1"
                                                oninput="this.value = this.value.replace(/[^0-9 ]/g, '');">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="room_name" class="col-sm-12 control-label">Room Name</label>
                                        <div class="col-xs-7">
                                            <input type="text" class="form-control" id="room_name" name="room_name"
                                                placeholder="Ex: Computer Laboratory"
                                                oninput="this.value = this.value.replace(/[^0-9 A-Z a-z ]/g, '');">
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
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Room | Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/admin/rooms/edit" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="edit_id" name="id">
                    <div class="card" style="width:100%;">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Room Device Configuration</h3>
                        </div>
                        <div class="card-body">

                            <br>
                            <p>Enter room's device identication number.</p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="edit_device_id" class="col-sm-12 control-label">ID</label>
                                        <div class="col-xs-7">
                                            <input type="text" class="form-control" id="edit_device_id" name="device_id"
                                                placeholder="Ex: 59385728192"
                                                oninput="this.value = this.value.replace(/[^0-9 ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <p>Enter room details.</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="edit_room_no" class="col-sm-12 control-label">Room No.</label>
                                        <div class="col-xs-7">
                                            <input type="text" class="form-control" id="edit_room_no" name="room_no"
                                                placeholder="Ex: 1"
                                                oninput="this.value = this.value.replace(/[^0-9 ]/g, '');">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="edit_room_name" class="col-sm-12 control-label">Room Name</label>
                                        <div class="col-xs-7">
                                            <input type="text" class="form-control" id="edit_room_name" name="room_name"
                                                placeholder="Ex: Computer Laboratory"
                                                oninput="this.value = this.value.replace(/[^0-9 A-Z a-z ]/g, '');">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <p>Choose device status.</p>
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
<!-- Add -->

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Device | Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDelete" class="form-horizontal" method="GET">
                    @csrf
                    <input type="hidden" id="delete_id" name="id">
                    <div class="text-center">
                        <h2 class="bold"> Are you sure you want to delete this Room Device?</h2>
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
