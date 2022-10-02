<?php
include '../../resources/functions.php';

$store_guid = escape_string($_POST['owners1']);
$store_id   = escape_string($_POST['stores']);

if (isset($store_guid) || isset($store_id)) {
	$query = query("UPDATE posrev.admin_outlets SET `manager_guid` = '".trim($store_guid)."' WHERE store_id = ".trim($store_id)." ");
	echo '<script>';
	echo 'alert("Complete");';
	echo 'self.location = "../?outlets";';
	echo '</script>';
}
?>