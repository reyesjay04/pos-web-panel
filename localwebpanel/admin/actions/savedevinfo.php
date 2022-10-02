<?php
include '../../resources/functions.php';

$companyname = $_POST['companyname'];
$companyaddress = $_POST['companyaddress'];
$vatreg = $_POST['vatreg'];
$accr = $_POST['accr'];
$dateissuedaccr = $_POST['dateissuedaccr'];
$validuntilaccr = $_POST['validuntilaccr'];
$ptu = $_POST['ptu'];
$dateissuedptu = $_POST['dateissuedptu'];
$validuntilptu = $_POST['validuntilptu'];
$today = FullDateFormat24HR();
$sql = "UPDATE admin_settings_org SET Dev_Company_Name = '$companyname', Dev_Address = '$companyaddress',
		Dev_Tin = '$vatreg', Dev_Accr_No = '$accr', Dev_Accr_Date_Issued = '$dateissuedaccr', Dev_Accr_Valid_Until = '$validuntilaccr',
		Dev_PTU_No = '$ptu', Dev_PTU_Date_Issued = '$dateissuedptu', Dev_PTU_Valid_Until = '$validuntilptu', S_DateModified = '$today' 
		WHERE settings_id = 1";
$result = query($sql);
if($result) {
    echo "Success!";
} else {
    echo "Error $results -> $sql";
}
?>