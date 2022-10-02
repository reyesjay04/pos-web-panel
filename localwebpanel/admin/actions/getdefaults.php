<?php session_start();
include('../../resources/functions.php');

$defaults = array();
//-------------------------------------------------Daily Transaction
$sql = "SELECT * FROM posrev.admin_settings_org";
$result = query($sql);

$row = mysqli_fetch_array($result);

$famousbatter = $row['S_Batter'];
$famousbag = $row['S_Waffle_Bag'];  
$browniemix = $row['S_Brownie_Mix'];
$sugarpackets = $row['S_Packets'];  
$upgradeprice = $row['S_Upgrade_Price_Add'];


$companyname = $row['Dev_Company_Name'];
$companyaddress = $row['Dev_Address'];     
$vatreg = $row['Dev_Tin']; 
$accr = $row['Dev_Accr_No'];
$dateissuedaccr = $row['Dev_Accr_Date_Issued'];
$validuntilaccr = $row['Dev_Accr_Valid_Until'];      
$ptu = $row['Dev_PTU_No'];
$dateissuedptu = $row['Dev_PTU_Date_Issued'];
$validuntilptu = $row['Dev_PTU_Valid_Until'];

$version = $row['S_Update_Version'];


$defaults[] = array(
	"famousbatter"   => $famousbatter,
	"famousbag" 	 => $famousbag,
	"browniemix" 	 => $browniemix,
	"sugarpackets"   => $sugarpackets,
	"upgradeprice" 	 => $upgradeprice,
	"companyname" 	 => $companyname, 
	"companyaddress" => $companyaddress, 
	"vatreg" 		 => $vatreg, 
	"accr" 			 => $accr, 
	"dateissuedaccr" => $dateissuedaccr,
	"validuntilaccr" => $validuntilaccr,
	"ptu" 			 => $ptu,
	"dateissuedptu"  => $dateissuedptu,
	"validuntilptu"  => $validuntilptu,
	"version"  		 => $version
);

echo json_encode($defaults);