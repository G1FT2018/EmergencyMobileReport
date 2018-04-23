<div class="modal fade" id="settings-win">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header custom-modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Account Settings</h4>
            </div>
            <div class="modal-body">
                <p><b><i class="fa fa-key"></i>&nbsp;Update Password</b></p>
                <hr style="margin-top:2px;margin-bottom:6px;">
                
                <form action="{{URL('users/update-password')}}"  method="POST" role="form">
                    <input type="hidden" name="web_access" value="true">
                    <div class="form-group">
                        <label for="File">Old Password</label>
                        <input type="password" name="old_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="File">New Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="File">Retype Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div><!-- settings -win-->