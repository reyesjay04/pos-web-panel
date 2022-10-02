<?php 

include '../../resources/functions.php';

$couponid = $_POST['couponid'];
$coupontype = $_POST['coupontype'];
$couponname = $_POST['couponname'];
$coupondesc = $_POST['coupondesc'];
$discoutvalue = $_POST['discoutvalue'];
$referencevalue = $_POST['referencevalue'];
$bundlebase = $_POST['bundlebase'];
$bundlebasevalue = $_POST['bundlebasevalue'];
$bundlepromo = $_POST['bundlepromo'];
$bundlepromovalue = $_POST['bundlepromovalue'];
$effectivedate = $_POST['effectivedate'];
$expirydate = $_POST['expirydate'];
$today = FullDateFormat24HR();

$discoutvalue = ($discoutvalue == '') ? 'N/A' : $discoutvalue;
$referencevalue = ($referencevalue == '') ? 'N/A' : $referencevalue;
$bundlebase = ($bundlebase == '') ? 'N/A' : $bundlebase;
$bundlebasevalue = ($bundlebasevalue == '') ? 'N/A' : $bundlebasevalue;
$bundlepromo = ($bundlepromo == '') ? 'N/A' : $bundlepromo;
$bundlepromovalue = ($bundlepromovalue == '') ? 'N/A' : $bundlepromovalue;

$sql = "UPDATE `posrev`.`admin_coupon` SET `Couponname_` = '$couponname', `Desc_` = '$coupondesc', `Discountvalue_` = '$discoutvalue ',
`Referencevalue_` = '$referencevalue', `Type` = '$coupontype', `Bundlebase_` = '$bundlebase', `BBValue_` = '$bundlebasevalue',
`Bundlepromo_` = '$bundlepromo', `BPValue_` = '$bundlepromovalue', `Effectivedate` = '$effectivedate', `Expirydate` = '$expirydate',
`date_created` = '$today' WHERE `ID` = $couponid ";

$result = query($sql);
echo '<script>';
echo 'alert("Updated Successfully");';
echo 'self.location = "../?settings";';
echo '</script>';

?>

