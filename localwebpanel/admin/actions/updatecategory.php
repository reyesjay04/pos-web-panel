<?php

include '../../resources/functions.php';
$category_id =  $_POST['category_id'];
$datenow = FullDateFormat24HR();
$sql = "UPDATE admin_category SET category_name = '".$_POST['catname']."', brand_name = '".$_POST['brandname']."' , updated_at = '$datenow' WHERE category_id = " . $category_id;
$result = mysqli_query($connection, $sql);

echo '<script>';
echo 'alert("Updated Successfully");';
echo 'self.location = "../?defcat";';
echo '</script>';

?>