<?php 
include '../../resources/functions.php';
$query = $_POST['query'];
$store_id = $_POST['storeid'];


$datenow = FullDateFormat24HR();
$sql = "INSERT INTO `admin_script_runner`(`script_command`, `store_id`, `created_at`, `truncatescript`,`active`) VALUES ('$query','$store_id','$datenow','NO',1)";
$result = mysqli_query($connection, $sql);

if ($result) {
	echo "Complete";
} else {
	echo "ERROR > $sql";
}
?>
