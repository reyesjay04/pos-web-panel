<div class="modal fade" id="modal-add-coupon">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">New Coupon</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="actions/addcoupon.php"  enctype="multipart/form-data">
        <div class="modal-body" id="add_coupon_body">
          <div class="row">
            <div class="col-md-6">
              <label for="coupontype">Type</label>
              <div class="form-group">
              <select class="custom-select" name="coupontype" required>  
                <option value="Percentage(w/o vat)">Percentage(w/o vat)</option>
                <option value="Percentage(w/ vat)">Percentage(w/ vat)</option>
                <option value="Fix-1">Fix-1</option>
                <option value="Fix-2">Fix-2</option>
                <option value="Bundle-1(Fix)">Bundle-1(Fix)</option>
                <option value="Bundle-2(Fix)">Bundle-2(Fix)</option>
                <option value="Bundle-3(%)">Bundle-3(%)</option>
              </select>
              </div> 
              <label for="couponname">Coupon Name</label>
              <div class="form-group">
                <input type="text" class="form-control" name="couponname" required>  
              </div> 
              <label for="coupondesc">Coupon Description</label>
              <div class="form-group">
                <textarea style="height: 124px;" class="form-control" name="coupondesc" required></textarea>  
              </div> 
              <label for="discoutvalue">Discount Value</label>
              <div class="form-group">
                <input type="text" class="form-control" name="discoutvalue" required="">  
              </div> 
              <label for="referencevalue">Reference Value</label>
              <div class="form-group">
                <input type="text" class="form-control" name="referencevalue" required="">  
              </div>
            </div>
            <div class="col-md-6">
              <label for="bundlebase">Bundle Base</label>
              <div class="form-group">
                <input type="text" class="form-control" name="bundlebase" required="">  
              </div>
              <label for="bundlebasevalue">Bundle Base Value</label>
              <div class="form-group">
                <input type="text" class="form-control" name="bundlebasevalue" required="">  
              </div>
              <label for="bundlepromo">Bundle Promo</label>
              <div class="form-group">
                <input type="text" class="form-control" name="bundlepromo" required="">  
              </div>
              <label for="bundlepromovalue">Bundle Promo Value</label>
              <div class="form-group">
                <input type="text" class="form-control"  name="bundlepromovalue" required="">  
              </div>
                <label for="effectivedate">Effective Date</label>
              <div class="form-group">
                <input type="text" class="form-control" id="effectivedate" name="effectivedate" required="">  
              </div>
                <label for="expirydate">Expiry Date</label>
              <div class="form-group">
                <input type="text" class="form-control" id="expirydate" name="expirydate" required="">  
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
