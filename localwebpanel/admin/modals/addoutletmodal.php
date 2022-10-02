<div class="modal fade" id="modal-add-outlet">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Outlet Info</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="aoutlet/"  enctype="multipart/form-data">
        <div class="modal-body" id="outletdetail">
        <div class="row">
          <div class="input-group mb-3">
            <div class="col-md-12">
              <select class="form-control input-sm" name="owners" id="owners" required>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="input-group mb-3">
            <div class="col-md-12">
              <select class="form-control input-sm" name="brands" id="brands" required>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="tin_no" class="form-control" autocomplete="off" placeholder="TIN" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="tel_no" class="form-control" autocomplete="off" placeholder="Tel. No." required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="address" class="form-control" autocomplete="off" placeholder="Address" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="barangay" class="form-control" autocomplete="off" placeholder="Barangay/District" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="input-group mb-3">
            <div class="col-md-6">
              <select class="form-control input-sm" id="province" name="province" onchange="getUnderCategory($(this).val());" required>
              </select>
            </div>
            <div class="col-md-6">
              <select class="form-control input-sm" name="municipality" id="under_category" required>
                <option value="">Select Municipality</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="location_name" class="form-control" autocomplete="off" placeholder="Location Name" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="postalcode" class="form-control" autocomplete="off" placeholder="Postal Code" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="MIN" class="form-control" autocomplete="off" placeholder="MIN" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="MSN" class="form-control" autocomplete="off" placeholder="MSN" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="PTUN" class="form-control" autocomplete="off" placeholder="PTUN" required>
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