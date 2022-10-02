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
              <div class="col-md-12">
                <div class="input-group mb-3">
                  <input type="text" autocomplete="off" class="form-control" name="usercode" placeholder="User Code" required>
                </div>         
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="input-group mb-3">
                  <input type="text" autocomplete="off" class="form-control" name="fullname" placeholder="Full Name" required>
                </div>         
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="input-group mb-3">
                  <input type="text" autocomplete="off" class="form-control" name="username" placeholder="Username" required>
                </div>         
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="input-group mb-3">
                  <input type="password" class="form-control" id="showpassword" name="password" placeholder="Password" required>
                  <div class="input-group-prepend">
                    <span class="input-group-text"><input type="checkbox" onclick="showpass()"></span>
                  </div>
                </div>         
              </div>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="email" autocomplete="off" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">              
                  <select class="form-control" name="role" required> 
                    <option value="">Select Position</option>
                    <option value="Manager">Manager</option>
                    <option value="Head Crew">Head Crew</option>
                    <option value="Crew">Crew</option>
                  </select>     
                </div>         
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">              
                  <select class="form-control input-sm" name="store" required>
                    <option value="">Select Store</option>
                    <?php

                    $query = query("SELECT store_id, store_name FROM admin_outlets WHERE user_guid = '".$_SESSION['client_user_guid']."'");
                    confirm($query);
                    while($row = mysqli_fetch_array($query)) {
                    $store_name= $row['store_name'];
                    $store_id= $row['store_id'];
                    ?>
                    <option value="<?php echo $store_id; ?>">
                    <?php echo $row['store_name']; ?>
                    </option>
                  <?php } ?>
                  </select>
                </div>         
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" autocomplete="off" class="form-control" name="contactnumber" placeholder="Contact Number" required>
                </div>         
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">              
                  <select class="form-control" name="gender" required> 
                    <option value="">Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>     
                </div>         
              </div>
            </div>
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