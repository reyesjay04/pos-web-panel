<?php

include '../../resources/functions.php';

$sql = "INSERT INTO `admin_serialkeys`(`serial_key`, `active`) VALUES ('".$_POST['serial']."', 0)";
$result = query($sql);
if($result) {
    echo last_id();
} else {
    echo "Error $results -> $sql";
}
?>