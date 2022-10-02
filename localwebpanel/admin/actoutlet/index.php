<?php require_once "../../resources/functions.php"; ?>
<?php
$id = $_POST['id'];
$sql = "UPDATE admin_outlets SET active = 1 WHERE store_id = $id;";
$result = mysqli_query($connection, $sql);
?>