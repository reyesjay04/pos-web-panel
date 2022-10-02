<?php
include '../../resources/functions.php';
$version = $_POST['version'];
$today = FullDateFormat24HR();
$sql = "UPDATE admin_settings_org SET S_Update_Version = '$version', S_DateModified = '$today' WHERE settings_id = 1";
$result = query($sql);
if($result) {
    echo "Success!";
} else {
    echo "Error $results -> $sql";
}
?>