<?php 
include_once '../../resources/functions.php';
$get_province = array();
$query = query("SELECT * FROM admin_province");

confirm($query);

while($row = mysqli_fetch_array($query)) {

		$add_id = $row['add_id'];
		$province =  $row['province'];
        $get_province[] = array("Name" => $province, "Value" => $add_id);
           
}
echo json_encode($get_province);
?>
   