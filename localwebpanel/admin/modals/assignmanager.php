<div class="modal fade" id="modal-assign-manager">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Assign Manager</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="actions/assign.php"  enctype="multipart/form-data">
        <div class="modal-body" id="outletdetail">
        <div class="row">
          <div class="input-group mb-3">
            <div class="col-md-12">
              <label for="owners1" >Managers</label>
              <select class="form-control input-sm" name="owners1" id="owners1" required>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="input-group mb-3"> 
            <div class="col-md-12">
              <label for="stores" >Stores</label>
              <select class="form-control input-sm" name="stores" id="stores" required>
              </select>
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