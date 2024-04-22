<!-- Change Password -->
<div class="modal fade" id="change">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Password | Change</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="password-change" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="user_id" name="user_id" value="{{ session('administrator') }}">
                    <div class="form-group">
                        <label for="curr_password" class="col-sm-5 control-label">Current Password:</label>

                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="curr_password" name="curr_password"
                                placeholder="Enter your current password to save changes" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="password" class="col-sm-5 control-label">New Password</label>

                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your new password">
                        </div>
                    </div>
                    
                 
                    

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Change</button>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- Edit -->
