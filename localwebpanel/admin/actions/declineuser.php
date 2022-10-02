<?php

include '../../resources/functions.php';
global $connection;
$user_id = $_POST['id'];
$sql = "SELECT user_role FROM admin_user WHERE user_id = $user_id";
$result = query($sql);
$row = mysqli_fetch_array($result);
if ($row['user_role'] == 'Admin') {
	echo "Unsuccessful";
} else {
	$query = query("DELETE FROM `admin_user` WHERE user_id = $user_id");
    confirm($query);
    echo "Success";
}
?>