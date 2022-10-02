<?php

include '../../resources/functions.php';
$category_id = $_POST['id'];
$sql = "UPDATE admin_category SET status = 0 WHERE category_id = ". $category_id ;
query($sql);
echo 'Deleted Successfully!';
?>