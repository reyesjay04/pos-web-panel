<?php session_start();

include '../resources/functions.php';
$formula_id =  $_GET['edtfrm'];
$sql = "SELECT * FROM admin_product_formula_org WHERE server_formula_id = " . $formula_id;
$result = query($sql);
$row = mysqli_fetch_array($result);
$product_ingredients = $row['product_ingredients'];
$primary_unit = $row['primary_unit'];
$primary_value = $row['primary_value'];
$secondary_unit = $row['secondary_unit'];
$secondary_value = $row['secondary_value'];
$serving_unit = $row['serving_unit'];
$serving_value = $row['serving_value'];
$no_servings = $row['no_servings'];
$unit_cost = $row['unit_cost'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Innovention</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" > 
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include_once('templates/nav.php');?>
<?php include_once('templates/sidenav.php');?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Formula</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Formula's</li>
              <li class="breadcrumb-item active">Update Formula</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <form method="POST" action="actions/updateformula.php" enctype="multipart/form-data">
        <div class="row">
        	<section class="col-lg-12">
  			    <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Formula Information</h3>
              </div>
            	<div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <label>Ingredient Name</label>
                    <input type="text" class="form-control" required name="product_ingredients" value="<?php echo $product_ingredients;?>">
                    <input type="hidden" class="form-control" required  name="formula_id" value="<?php echo $formula_id;?>">
                  </div>          
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Primary Unit</label>
                    <select class="custom-select" name="primary_unit" id="primary_unit" required>
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
                    <input type="text" class="form-control" required  name="primary_value" value="<?php echo $primary_value;?>">
                  </div> 
                  <div class="col-md-3">
                    <label>Number of Servings</label>
                    <input type="decimal" class="form-control" required name="no_servings" value="<?php echo $no_servings;?>">
                  </div>            
                </div>

                <div class="row">
                  <div class="col-md-6">
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
                    <input type="text" class="form-control" required  name="secondary_value" value="<?php echo $secondary_value;?>">
                  </div> 
                  <div class="col-md-3">
                    <label>Unit Cost</label>
                    <input type="decimal" class="form-control" required name="unit_cost" value="<?php echo $unit_cost;?>">
                  </div>           
                </div>
                <div class="row">
                  <div class="col-md-6">
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
                    <input type="text" class="form-control" required  name="serving_value" value="<?php echo $serving_value;?>">
                  </div> 
                  <div class="col-md-3"> 
                    <hr>
                    <div class="input-group mb-3">
                      <button class="btn btn-block btn-primary btn-sm">Save</button>
                    </div>              
                  </div>
                </div>
            	</div>
            </div>
        	</section>
        </div>
      </form>
    </section>
  </div>
  <?php include_once('templates/webfooter.php');?>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../dist/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      var primary_unit = "<?php echo $primary_unit; ?>";
      var secondary_unit = "<?php echo $secondary_unit; ?>";
      var serving_unit = "<?php echo $serving_unit; ?>";
      $('#primary_unit').val(primary_unit);
      $('#secondary_unit').val(secondary_unit);
      $('#serving_unit').val(serving_unit);
  });
</script>
</body>
</html>
    
