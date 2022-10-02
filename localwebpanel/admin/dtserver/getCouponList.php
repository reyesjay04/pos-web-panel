<?php
include('../../resources/functions.php');
$store_arr = array();
$sql = "SELECT * FROM posrev.admin_coupon";

$result = query($sql);
while($row = mysqli_fetch_array($result)){
    
    $coup_id = $row['ID'];
    $coupon_name = $row['Couponname_'];
    $coupon_desc =  $row['Desc_'];
    $coupon_disc_val =  $row['Discountvalue_'];
    $coupon_ref_val =  $row['Referencevalue_'];
    $coupon_type =  $row['Type'];
    $coupon_bundle_base =  $row['Bundlebase_'];
    $coupon_bundle_promo =  $row['Bundlepromo_'];

    $store_arr[] = array("id" => $coup_id, "name" => $coupon_name);
}
echo json_encode($store_arr);
?>