<?php
include('../../resources/functions.php');
$store_arr = array();
$query = query("SELECT product_id, product_name FROM posrev.admin_products_org;");
confirm($query);
while ($row = fetch_array($query)) { 
	$ProductID =  $row['product_id'];
	$ProductName = $row['product_name'] ;	
	$store_arr[] = array("ID" => $ProductID, "Name" => $ProductName);
}
echo json_encode($store_arr);
?>