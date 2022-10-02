<?php

include '../../resources/functions.php';

$product_image = "";
if($_FILES['pi']['name'] == "") {
	$product_image = $_POST['b64img'];
} else {
	$product_image = file_get_contents($_FILES["pi"]["tmp_name"]);
	$product_image = base64_encode($product_image);
}
$product_desc = $_POST['pd'];
$product_category = $_POST['pc'];
$product_name = $_POST['pn'];
$product_price = $_POST['pp'];
$product_formula = $_POST['pf'];
$product_code = $_POST['pcode'];
$product_barcode = $_POST['pb'];
$datenow = FullDateFormat24HR();
$maininventory = $_POST['maininv'];
$addonstype = $_POST['addonstype'];

$sql = "UPDATE admin_products_org SET `product_sku`= '$product_code',`product_name`='$product_name',`formula_id`='$product_formula',`product_barcode`='$product_barcode',`product_category`='$product_category',`product_price`='$product_price',`product_desc`='$product_desc',`product_image`='$product_image',`date_modified`='$datenow',`inventory_id`='$maininventory',`addontype`='$addonstype' WHERE product_id = " . $_GET['id'];
$result = query($sql);
echo '<script>';
echo 'alert("Updated Successfully");';
echo 'self.location = "../?defprod";';
echo '</script>';
?>
