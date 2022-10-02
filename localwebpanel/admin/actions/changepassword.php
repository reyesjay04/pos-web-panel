<?php session_start();

include_once '../../resources/functions.php';

$newpassword = $_POST['newpass'];
$datenow = FullDateFormat24HR();
$password_b64 = base64_encode($newpassword);
$password_enc = md5($password_b64);

$sql = "UPDATE `admin_user` SET `user_pass`= '$password_enc', `date_updated`= '$datenow' WHERE user_guid = '".$_SESSION['admin_user_id']."'";
$result = query($sql);

$guid      = $_SESSION['admin_user_id'];
$log_desc  = 'CHANGE PASSWORD';
$log_date = $datenow;

userlogs($guid,$log_desc);

echo '<script>';
echo 'alert("Updated Successfully");';
echo 'self.location = "../?profile";';
echo '</script>';

?>

