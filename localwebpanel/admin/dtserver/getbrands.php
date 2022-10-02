<?php 
include_once '../../resources/functions.php';
$get_brands = array();
$query = query("SELECT brand_name FROM admin_brand");

confirm($query);

while($row = mysqli_fetch_array($query)) {

       $brand_id= $row['brand_name'];
       $brand_name = $row['brand_name'];
       $get_brands[] = array("Name" => $brand_name, "Value" => $brand_id);
           
}
echo json_encode($get_brands);
?>
   
            
