<?php
include '../../resources/functions.php';

$msg = array();
$query = query("SELECT user_fname, user_lname, user_email, user_guid FROM posrev.admin_user WHERE user_role = 'Client'");
confirm($query);
while ($row = fetch_array($query)) {
	$sendto 	  = ucfirst($row['user_fname']) . ' ' . ucfirst($row['user_lname']);
	$clientemail  = $row['user_email'];
	$guid  = $row['user_guid'];
	$msg[] 		  = array("FullName" => $sendto, "Email" => $clientemail, "Guid" => $guid);
}
echo json_encode($msg);
?>