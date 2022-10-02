<?php

include '../../resources/functions.php';

$user_id = $_POST['id'];
$datenow = FullDateFormat24HR();

$sql = "UPDATE `admin_user`	SET `status`= 1, `Date`= '$datenow', `date_updated`= '$datenow' WHERE user_id = $user_id";
$result = query($sql);

?>

