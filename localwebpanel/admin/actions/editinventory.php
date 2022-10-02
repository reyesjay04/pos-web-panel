<?php

include '../../resources/functions.php';
$inventory_id = $_POST['id'];
$sql = "SELECT  product_ingredients , critical_limit , sku  FROM admin_pos_inventory_org WHERE server_inventory_id = " . $inventory_id;
$result = query($sql);
$row = mysqli_fetch_array($result);
$product_ingredients = $row['product_ingredients'];
$critical_limit 	 = $row['critical_limit'];
$sku 	 = $row['sku'];

echo '
<div class="card-body">
<input type="hidden" class="form-control"  name="inventory_id" value="'.$inventory_id.'"> 
	<div class="row">
		<label>Product Ingredient</label>
	  	<div class="input-group mb-3">	  
	    	<input type="text" class="form-control"  name="product_ingredients" required value="'.$product_ingredients.'">  
	  	</div>
	</div>
	<div class="row">  
		<label>Critital Limit</label>       
	  	<div class="input-group mb-3">
	    	<input type="text" class="form-control"  name="critical_limit"  required value="'.$critical_limit.'">  
	  	</div>
	</div>
	<div class="row">  
		<label>Inventory Code</label>       
	  	<div class="input-group mb-3">
	    	<input type="text" class="form-control"  name="sku"  required value="'.$sku.'">  
	  	</div>
	</div>
	<div class="row">
  		<label>Main Product</label>       
  			<div class="input-group mb-3">
      			<select class="form-control input-sm" name="maininventoryid">
      				<option value="0">Select Main Ingredient</option>';
        			$query = query("SELECT * FROM admin_pos_inventory_org");
        			confirm($query);
     	  			while($row = mysqli_fetch_array($query)) {

        			echo '<option name="" value="'.$row['inventory_id'].'">' . $row['product_ingredients'] . '</option>';
        			}
        			echo '
        		</select>
  			</div>
		</div>
	</div>';

?>
