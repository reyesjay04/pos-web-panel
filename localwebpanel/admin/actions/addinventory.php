<?php

include '../../resources/functions.php';
$product_ingredients = $_POST['product_ingredients'];
$critical_limit = $_POST['critical_limit'];
$maininventoryid = $_POST['maininventoryid'];
$sku = $_POST['sku'];


$sql = 'SELECT MAX(server_formula_id) AS FormulaID FROM admin_pos_inventory_org';
$result = query($sql);
$row = mysqli_fetch_array($result);
$formula_id = $row['FormulaID'] + 1 ;

$datenow = FullDateFormat24HR();
$sql2 = "INSERT INTO `admin_pos_inventory_org`(`server_formula_id`, `product_ingredients`, `stock_primary`, `stock_secondary`, `stock_status`, `critical_limit`, `date_modified`, `main_inventory_id`,`sku`,`origin`) VALUES ($formula_id, '$product_ingredients',0,0,1,'$critical_limit','$datenow','$maininventoryid','$sku','Server')";

query($sql2);
echo '<script>';
echo 'alert("Added Successfully");';
echo 'self.location = "../?definv";';
echo '</script>';


?>

