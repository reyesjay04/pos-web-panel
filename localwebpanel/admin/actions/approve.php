<?php

include '../../resources/functions.php';

$request_id = $_POST['id'];
$datenow = FullDateFormat24HR();

$sql = "UPDATE `admin_price_request` SET `active`= '2', `created_at`= '$datenow' WHERE request_id = $request_id";

$result = query($sql);

?>

