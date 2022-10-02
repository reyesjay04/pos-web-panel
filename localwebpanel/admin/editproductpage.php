<?php session_start();

include '../resources/functions.php';
$product_id =  $_GET['edtprd'];
$sql = "SELECT * FROM admin_products_org WHERE product_id = " . $product_id;
$result = query($sql);
$row = mysqli_fetch_array($result);
$product_name = $row['product_name'];
$barcode = $row['product_barcode'];
$product_code = $row['product_sku'];
$productimage = $row['product_image'];
$product_price = $row['product_price'];
$formula = $row['formula_id'];
$productcategory = $row['product_category'];
$product_desc = $row['product_desc'];
$addonstype = $row['addontype'];
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
            <h1 class="m-0 text-dark">Update Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Products</li>
              <li class="breadcrumb-item active">Update Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <form method="POST" action="actions/updateproduct.php?id=<?php echo $_GET['edtprd'];?>" enctype="multipart/form-data">
        <div class="row">
        	<section class="col-lg-9">
  			    <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Product Information</h3>
              </div>
            	<div class="card-body">
            		<span>Product Code</span>
                <div class="form-group">
                	<input type="text" class="form-control" name="pcode" value="<?php echo $product_code;?>">
                </div>
                <span>Barcode</span>
                
                <div class="input-group mb-3">
                	<input type="text" class="form-control" name="pb" value="<?php echo $barcode;?>">
                	<div class="input-group-append">
                		<span class="input-group-text"><i class="fas fa-barcode"></i></span>
                	</div>	                	
                </div>
                <span>Product Name</span>
                <div class="form-group">
                	<input type="text" class="form-control" name="pn" value="<?php echo $product_name;?>">
                </div>
                <span>Product Price</span>
                <div class="form-group">
                	<input type="text" class="form-control" name="pp" value="<?php echo $product_price;?>">
                </div>
            	</div>
            </div>
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Product Description</h3>
              </div>
              <div class="card-body">
                <div class="input-group mb-3">
                  <textarea name="pd" class="form-control"><?php echo $product_desc;?></textarea>
                </div>  
                
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">
                        Product Category
                    </h3>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <select class="custom-select" id="selectCat" name="pc">
                        <option value="">Select Category</option>
                          <?php

                          $sql = "SELECT category_id , category_name FROM admin_category";
                          $result = query($sql);
                          while($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
                          }
                          ?>
                      </select>
                    </div>
                  </div>
                </div> 
              </div>
              <div class="col-md-4">
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">Exclusive for mixed products only(Others)</h3>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <select class="custom-select" id="maininv" name="maininv">
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
              <div class="col-md-4">
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">Exclusive for premium fillings(Add-Ons Category)</h3>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <select class="form-control" name="addonstype"> 
                          <?php
                          echo $addonstype;
                          if ($addonstype == "N/A") {
                          ?>
                            <option value="N/A">N/A</option>
                            <option value="Classic">Classic</option>
                            <option value="Premium">Premium</option>
                          <?php 
                          } elseif ($addonstype == "Classic") {
                          ?>
                            <option value="Classic">Classic</option>
                            <option value="N/A">N/A</option>
                            <option value="Premium">Premium</option>
                          <?php 
                          } elseif ($addonstype == "Premium") {
                          ?>
                            <option value="Premium">Premium</option>
                            <option value="N/A">N/A</option>
                            <option value="Classic">Classic</option>
                          <?php                      
                          }          
                          ?>
                        </select> 
                      </div>
                    </div>                  
                  </div>
                </div> 
              </div>
            </div>
        	</section>
        	<section class="col-lg-3">
  			    <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Product Formula's</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                	<div class="input-group mb-3">
  	              	<select class="custom-select" id="selectformula">
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
                  <input type="text" id="appendformulaid" name="pf" class="form-control" value="<?php echo $formula; ?>">
                </div>	                
              </div>
            </div>	 
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Image <i>(Click the image to edit or update)</i></h3>
              </div>
              <div class="card-body">
                <div class="row">                      
                  <a onclick="performClick('imgInp');" style="margin: auto; cursor: pointer;">
                    <img style="max-height: 150px; max-width: 200px" id="blah" src="data:image/png;base64,<?php echo $productimage; ?>">
                    <input type="hidden" name="b64img" value="<?php echo $productimage; ?>">
                  </a>  
                </div>    
                <input type="file" id="imgInp" name="pi" accept="image/*" style="display:none" />
                <a onclick="clickmetodisp()">Click here to remove image</a>          
              </div>
            </div>  
            <div class="card card-default">
              <div class="card-body">
                <div class="form-group">       
                  <button type="submit" class="btn btn-block btn-primary btn-sm float-right">Save</button>
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
	function GetFormulaID() {
		var formulaid = $('#selectformula').val();
		var formulaname = $('#selectformula option:selected').text();
		var appendedinput = $('#appendformulaid').val();
		if (appendedinput == '') {	
			document.getElementById('appendformulaid').value +=  formulaid;
		} else {
			document.getElementById('appendformulaid').value += ',' + formulaid;
		}	
	}
  function performClick(elemId) {
     var elem = document.getElementById(elemId);
     if(elem && document.createEvent) {
        var evt = document.createEvent("MouseEvents");
        evt.initEvent("click", true, false);
        elem.dispatchEvent(evt);
     }
  }
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();    
      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  $("#imgInp").change(function() {
    readURL(this);
  });
  $(document).ready(function() {
      var selcatval = "<?php echo $productcategory; ?>";
      $('#selectCat').val(selcatval);
  });
</script>
</body>
</html>
    
