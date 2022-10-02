<?php session_start();
include('../../resources/functions.php');

$store_arr = array();


$sql = "SELECT store_id , store_name FROM admin_outlets WHERE manager_guid = '".$_POST["guid"]."' ";

$result = query($sql);

while($row = mysqli_fetch_array($result)){
    $store_id = $row['store_id'];  
    $store_name = $row['store_name'];
    $store_arr[] = array("id" => $store_id, "name" => $store_name);
}

echo json_encode($store_arr);
?>