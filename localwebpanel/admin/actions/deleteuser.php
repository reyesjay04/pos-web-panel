<?php

include '../../resources/functions.php';


$user_id = $_POST['id'];
$sql = "SELECT user_role FROM admin_user WHERE user_id = '$user_id'";
$result = query($sql);
$row = mysqli_fetch_array($result);
if ($row['user_role'] == 'Admin') {
	echo "Unsuccessful";
} else {
	$sql = "SELECT * FROM admin_outlets WHERE user_id = '$user_id' ";
	$result = query($sql);
	$row = mysqli_fetch_array($result);
	$rowcount =  mysqli_num_rows($result);
	if ($rowcount > 0) {
		echo 'HasOutlet';
	} else {
 		$query = query("DELETE FROM `admin_user` WHERE user_id = '$user_id'");
        confirm($query);
		echo 'Success';
	}
}
?>