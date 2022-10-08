<?php
include '../../resources/functions.php';

$user_id = escape_string($_POST['owners1']);
$store_id   = escape_string($_POST['stores']);
$takeStore = 0;

if (isset($user_id) || isset($store_id)) {

	$listofStoreIds = selectManagerStores($user_id);

	if($listofStoreIds == "") {
		$query = query("UPDATE admin_user SET `store_ids` = '".$store_id."' WHERE user_id = ".trim($user_id)." ");
	
	} else {
		if(strlen($listofStoreIds) > 1) {
			$str_arr = explode (",", $listofStoreIds); 
			$reStoreid;

			
			foreach($str_arr as $value) //loop over values
			{
			
				if($value <> $store_id) {
					$reStoreid .= $value . ',';
				}
			}
			$reStoreid .= $value;

			// $listofStoreIds = rtrim($reStoreid , ',');
			echo $listofStoreIds;
		} else {
		
			if($listofStoreIds <> $store_id) {
				$listofStoreIds .= ',' . $store_id;
			}
		}
		try {
			//$query = query("UPDATE admin_user SET `store_ids` = '".$listofStoreIds."' WHERE user_id = ".trim($user_id)." ");	
		} catch(Exception $e) {
			echo 'Message: ' .$e->getMessage();
		}
	}

	// echo '<script>';
	// echo 'alert("Complete");';
	// echo 'self.location = "../?outlets";';
	// echo '</script>';

	
} 

	
?>