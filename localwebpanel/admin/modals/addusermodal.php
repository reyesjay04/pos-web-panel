<div class="modal fade" id="modal-add-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="actions/adduser.php"  enctype="multipart/form-data">
        <div class="modal-body" id="add-user">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="fname" placeholder="First Name" required>
                </div>         
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="lname" placeholder="Last Name" required>
                </div>         
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>         
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="password" class="form-control" id="showpassword" name="password" placeholder="Password" required>
                  <div class="input-group-prepend">
                    <span class="input-group-text"><input type="checkbox" onclick="showpass()"></span>
                  </div>
                </div>         
              </div>
            </div>
            <div class="form-group clearfix">
              <div class="icheck-primary d-inline">
                <input type="radio" id="radioPrimary1" value="Male" name="r1" checked>
                <label for="radioPrimary1">
                  Male
                </label>
              </div>
              <div class="icheck-primary d-inline">
                <input type="radio" id="radioPrimary2" value="Female" name="r1">
                <label for="radioPrimary2">
                  Female
                </label>
              </div>
              <div class="icheck-primary d-inline">
                <input type="radio" id="radioPrimary3" value="N/A" name="r1">
                <label for="radioPrimary3">
                  Prefer not to say
                </label>
              </div>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">              
                  <select class="form-control" name="role" required> 
                    <option value="">Select Role</option>
                    <option value="Administrator">Administrator</option>
                    <option value="Manager">Manager</option>
                    <option value="Client">Client</option>
                  </select>     
                </div>         
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="contactno" placeholder="Contact Number" required>
                </div>         
              </div>
            </div>
<!--             <div class="custom-file">
              <input type="file" class="custom-file-input" name="image" id="customFile"  accept="image/*" required>
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div> -->
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>