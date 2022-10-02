<?php 

include '../../resources/functions.php';

$couponname = $_POST['couponname'];
$coupontype = $_POST['coupontype'];
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

$sql = "INSERT INTO `posrev`.`admin_coupon`(`Couponname_`,`Desc_`,`Discountvalue_`,`Referencevalue_`,`Type`,`Bundlebase_`,`BBValue_`,`Bundlepromo_`,`BPValue_`,`Effectivedate`,`Expirydate`,`date_created`) VALUES ('$couponname','$coupondesc', '$discoutvalue', '$referencevalue', '$coupontype', '$bundlebase', '$bundlebasevalue', '$bundlepromo', '$bundlepromovalue', '$effectivedate', '$expirydate', '$today');";

$result = query($sql);
echo '<script>';
echo 'alert("Added Successfully");';
echo 'self.location = "../?settings";';
echo '</script>';

?>



