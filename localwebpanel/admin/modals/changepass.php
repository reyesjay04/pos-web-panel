<div class="modal fade" id="modal-change-pass">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="actions/changepassword.php"  enctype="multipart/form-data">
        <div class="modal-body" id="add-user">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="input-group mb-3">
                  <input type="password" class="form-control" id="newpass" name="newpass" placeholder="New Password">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><input type="checkbox" onclick="shownewpass()"></span>
                  </div>
                </div>         
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="input-group mb-3">
                  <input type="password" class="form-control" id="conpass" name="conpass" placeholder="Confirm Password">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><input type="checkbox" onclick="showconpass()"></span>
                  </div>               
                </div>         
              </div>
            </div>        
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>