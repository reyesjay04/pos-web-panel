<?php

include '../../resources/functions.php';
$category_id =  $_POST['id'];
$sql = "SELECT * FROM admin_category WHERE category_id = " . $category_id;
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);
$category_name = $row['category_name'];
$brand_name = $row['brand_name'];

$sql1 = "SELECT brand_name FROM admin_brand";
$result1 = query($sql1);
echo 
'<div class="card-body">
  <input type="hidden" id="guid" name="category_id" value="'.$category_id.'">
  <div class="row">
    <div class="input-group mb-3">
      <input type="text" class="form-control"  name="catname" placeholder="Category Name" required value="'.$category_name.'">  </div>
  </div>
  <div class="row">
    <div class="input-group mb-3">              
      <select class="form-control" name="brandname" required id="brandname"> 
        <option value="">Select Brand Name</option>';
        while ($row = mysqli_fetch_array($result1)) {
          $bname = $row['brand_name'];
          echo "<option value = '".$bname."' >".$row['brand_name']."</>";
        } 
      echo '</select>     
    </div>
  </div>
</div>';
?>


