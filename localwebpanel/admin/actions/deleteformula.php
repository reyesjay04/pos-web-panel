<?php

include '../../resources/functions.php';
$formula_id = $_POST['id'];
$sql = "UPDATE `admin_product_formula_org` SET status = 0 WHERE formula_id = ". $formula_id ;
query($sql);
echo 'Deleted Successfully!';
?>