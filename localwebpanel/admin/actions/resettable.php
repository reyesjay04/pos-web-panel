<?php

include '../../resources/functions.php';

$tabletoreset = $_POST['tabletoreset'];
$stores_gen = $_POST['stores_gen'];

$table = array();
$return = "";
if ($tabletoreset == "Sales") {
   $table = array("admin_daily_transaction", "admin_daily_transaction_details", "admin_deposit_slip_details", "admin_senior_details");
} else if ($tabletoreset == "Logs") {
   $table = array("admin_system_logs","admin_user_logs");
} else if ($tabletoreset == "Inventory"){
   $table = array("admin_pos_inventory", "admin_pos_zread_inventory");
} else if ($tabletoreset == "Products"){
	$table = array("admin_products");
} else if ($tabletoreset == "Refunds"){
	$table = array("admin_refund_return_details");
} else if ($tabletoreset == "Serial"){
	$table = array("admin_serialkeys");
} else if ($tabletoreset == "Users"){
	$table = array("loc_users");
} else if ($tabletoreset == "Outlet"){
	$table = array("admin_outlets");
} else if ($tabletoreset == "Inbox"){
	$table = array("admin_message");
} else if($tabletoreset == "Script") {
   $table = array("admin_script_runner");
}
// } else if($tabletoreset == "All"){
//    $table = array("admin_daily_transaction", "admin_daily_transaction_details", "admin_deposit_slip_details", "admin_senior_details","admin_system_logs","admin_user_logs","admin_pos_inventory", "admin_pos_zread_inventory","admin_products","admin_refund_return_details","admin_serialkeys","loc_users","admin_outlets","admin_message","admin_script_runner");
// }
foreach ($table as $value) {
 	$query = query("TRUNCATE TABLE " .$value);
    confirm($query);
}

if ($tabletoreset == "Users" ||  $tabletoreset == "All") {
	$sql = "INSERT INTO `loc_users` (`loc_user_id`,`user_level`,`full_name`,`username`,`password`,`contact_number`,`email`,`position`,`gender`,`created_at`,`updated_at`,`active`,`guid`,`store_id`,`uniq_id`,`pwd`,`synced`,`user_code`) 
		VALUES (0,'Admin','Super User','superuser','81e0ecabbf27372f551013ce00dc4ce6','N/A','N/A','Admin','N/A','N/A','N/A','1','Admin','0','AD-0001','N/A','N/A','0404');";
	$result = query($sql);
}
echo "Complete!";
?>