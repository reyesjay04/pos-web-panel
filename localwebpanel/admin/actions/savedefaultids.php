<?php
include '../../resources/functions.php';

$famousbatter = $_POST['famousbatter'];
$famousbag = $_POST['famousbag'];
$sugarpackets = $_POST['sugarpackets'];
$famousbatter = $_POST['famousbatter'];
$upgradeprice = $_POST['upgradeprice'];
$browniemix = $_POST['browniemix'];
$today = FullDateFormat24HR();

$sql = "UPDATE admin_settings_org SET S_Batter = '".$famousbatter."', S_Brownie_Mix = '".$browniemix."', S_Upgrade_Price_Add = '".$upgradeprice."', S_Waffle_Bag = '".$famousbag."', S_Packets = '".$sugarpackets."', S_DateModified = '$today' WHERE settings_id = 1";

$result = query($sql);
if($result) {
    echo "Success!";
} else {
    echo "Error $results -> $sql";
}
?>