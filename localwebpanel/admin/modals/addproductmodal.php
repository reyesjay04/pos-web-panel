<div class="modal fade" id="modal-add-product">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Product</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="actions/addproduct.php"  enctype="multipart/form-data">
        <div class="modal-body" id="add-product">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="pcode" placeholder="Product Code" required>
                </div>         
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="pbarcode" placeholder="Product Barcode" required>
                </div>         
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="pname" placeholder="Product Name" required>
                </div>         
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control"  name="pprice" placeholder="Product Price" required>
                </div>         
              </div>
            </div>
            <div class="input-group mb-3">
              <textarea class="form-control" placeholder="Description" name="pdesc" required></textarea>
            </div>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="pimage" id="pimage"  accept="image/*" required>
                <label class="custom-file-label" for="pimage">Choose Image</label>
              </div> 
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">              
                  <select class="form-control" name="pcat" required id="SelCategory" onchange="getval(this)"> 
                    <option value="">Select Category</option>
                      <?php

                      include_once '../resources/functions.php';
                      $sql = "SELECT category_id , category_name FROM admin_category";
                      $result = query($sql);
                      while($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
                      }
                      ?>
                  </select>     
                </div>         
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">              
                  <select class="form-control" id="selectformula"> 
                    <option value="">Select Ingredients</option>
                      <?php

                      $sql = "SELECT server_formula_id , product_ingredients FROM admin_product_formula_org";
                      $result = query($sql);
                      while($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="'.$row['server_formula_id'].'">'.$row['product_ingredients'].'</option>';
                      }
                      ?>
                  </select>   
                  <span><a style="width: 55px;" class="btn btn-info btn-flat" onclick="GetFormulaID()">Add</a></span>  
                </div>       
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="input-group mb-3">
                  <input type="text" id="appendformulaid" name="pf" class="form-control" required>
                </div>                
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label>Exclusive for premium fillings only(Add-Ons Category)</label>
                <div class="input-group mb-3">              
                  <select class="form-control" name="addonstype"> 
                    <option value="N/A">Select Add-On type</option>
                    <option value="Classic">Classic</option>
                    <option value="Premium">Premium</option>
                  </select>     
                </div>         
              </div>
            </div>  
            <div class="row">
              <div class="col-md-12">
                <label>Exclusive for mixed products only(Others Category)</label>
                <div class="input-group mb-3">              
                  <select class="form-control" name="invcat" id="SelInVat"> 
                    <option value="0">Select Ingredients</option>
                      <?php

                      $sql = "SELECT server_formula_id , product_ingredients FROM admin_product_formula_org";
                      $result = query($sql);
                      while($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="'.$row['server_formula_id'].'">'.$row['product_ingredients'].'</option>';
                      }
                      ?>
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