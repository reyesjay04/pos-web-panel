<?php 

$category_name = $_POST['catname'];
$brand_name = $_POST['brandname'];

include '../../resources/functions.php';

$sql = "INSERT INTO `admin_category`(`category_name`, `brand_name`, `origin`, `status`) VALUES ('$category_name','$brand_name','Server',1)";
$result = mysqli_query($connection, $sql);
echo '<script>';
echo 'alert("Updated Successfully");';
echo 'self.location = "../?defcat";';
echo '</script>';

?>

