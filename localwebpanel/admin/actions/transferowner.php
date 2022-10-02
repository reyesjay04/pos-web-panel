<?php 

$store_to_transfer = $_POST['store_to_transfer'];
$transfer_owner = $_POST['transfer_owner'];

include '../../resources/functions.php';

$sql = "UPDATE admin_outlets SET user_guid = '$transfer_owner' WHERE store_id = $store_to_transfer";
$result = mysqli_query($connection, $sql);

echo '<script>';
echo 'alert("Updated Successfully");';
echo 'self.location = "../?outlets";';
echo '</script>';

?>

