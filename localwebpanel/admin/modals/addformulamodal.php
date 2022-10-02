  <div class="modal fade" id="modal-formula">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Formula</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="actions/addformula.php"  enctype="multipart/form-data">
        <div class="modal-body" id="formula_detail">      
          <div class="row">
            <div class="col-md-12">
              <label>Ingredient Name</label>
              <input type="text" class="form-control" required name="product_ingredients" value="">
            </div>          
          </div>
          <div class="row">
            <div class="col-md-9">
              <label>Primary Unit</label>
              <select class="custom-select" name="primary_unit" id="primary_unit" required>
                <option value="">Select Unit</option>
                <?php

                include_once '../resources/functions.php';
                $sql = "SELECT * FROM uom";
                $result = query($sql);
                while($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="'.$row['unit_desc'].'">'.$row['unit_desc'].'</option>';
                }
                ?>                      
              </select>        
            </div>
            <div class="col-md-3">
              <label>Value</label>
              <input type="text" class="form-control" required  name="primary_value" value="">
            </div>  
          </div>
          <div class="row">
            <div class="col-md-9">
              <label>Secondary Unit</label>
              <select class="custom-select" name="secondary_unit" id="secondary_unit" required>
                <option value="">Select Unit</option>
                <?php

                $sql = "SELECT * FROM uom";
                $result = query($sql);
                while($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="'.$row['unit_desc'].'">'.$row['unit_desc'].'</option>';
                }
                ?>                      
              </select>        
            </div>
            <div class="col-md-3">
              <label>Value</label>
              <input type="text" class="form-control" required  name="secondary_value" value="">
            </div> 
          </div>
          <div class="row">
            <div class="col-md-9">
              <label>Serving Unit</label>
              <select class="custom-select" name="serving_unit"  id="serving_unit" required>
                <option value="">Select Unit</option>
                <?php

                $sql = "SELECT * FROM uom";
                $result = query($sql);
                while($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="'.$row['unit_desc'].'">'.$row['unit_desc'].'</option>';
                }
                ?>                      
              </select>        
            </div>
            <div class="col-md-3">
              <label>Value</label>
              <input type="text" class="form-control" required  name="serving_value" value="">
            </div> 
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>Number of Servings</label>
              <input type="double" class="form-control" required name="no_servings" value="">
            </div> 
            <div class="col-md-6">  
              <label>Unit Cost</label>
              <input type="double" class="form-control" required name="unit_cost" value="">
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
