<div class="modal fade" id="modal-transfer-outlet">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Outlet Info</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="actions/transferowner.php"  enctype="multipart/form-data">
        <div class="modal-body" id="transfer-outlet">
        <div class="row">
          <div class="input-group mb-3">
            <div class="col-md-12">
              <label for="store_to_transfer" >Stores</label>
              <select class="form-control input-sm" name="store_to_transfer" id="store_to_transfer" required>
              </select>
            </div>
          </div>
        </div>  
        <div class="row">
          <div class="input-group mb-3">
            <div class="col-md-12">
              <label for="transfer_owner" >Owner</label>
              <select class="form-control input-sm" name="transfer_owner" id="transfer_owner" required>
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