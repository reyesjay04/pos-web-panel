<?php

include '../resources/functions.php';

?>
  <div class="modal fade" id="modal-category">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="actions/addcategory.php"  enctype="multipart/form-data">
        <div class="modal-body">
          <div class="card-body">
            <div class="row">
              <div class="input-group mb-3">
                <input type="text" class="form-control"  name="catname" placeholder="Category Name" required value="">  
              </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">              
                <select class="form-control" name="brandname" required id="brandname"> 
                  <option value="">Select Brand Name</option>';
                  <?php
                  $sql1 = "SELECT brand_name FROM admin_brand";
                  $result1 = query($sql1);
                  while ($row = mysqli_fetch_array($result1)) {
                    $bname = $row['brand_name'];
                    echo "<option value = '".$bname."'>".$row['brand_name']."</>";
                  }         
                  ?>
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
</form>
