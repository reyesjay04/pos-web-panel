<?php

include '../../resources/functions.php';
$inventory_id = $_POST['id'];
$sql = "UPDATE `admin_pos_inventory_org` SET stock_status = 0  WHERE inventory_id = ". $inventory_id ;
query($sql);
echo 'Deleted Successfully!';
?>