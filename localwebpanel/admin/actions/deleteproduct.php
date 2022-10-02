<?php

include '../../resources/functions.php';
$product_id = $_POST['id'];
$sql = "UPDATE `admin_products_org` SET product_status = 0 WHERE product_id = ". $product_id ;
query($sql);
echo 'Deleted Successfully!';
?>