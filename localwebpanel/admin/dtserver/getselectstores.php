<?php
include('../../resources/functions.php');
$store_arr = array();
$query = query("SELECT store_name, store_id FROM posrev.admin_outlets WHERE manager_guid = ''");
confirm($query);
while ($row = fetch_array($query)) { 
	$store_id =  $row['store_id'];
	$store_name = $row['store_name'] ;	
	$store_arr[] = array("StoreID" => $store_id, "StoreName" => $store_name);
}
echo json_encode($store_arr);
?>