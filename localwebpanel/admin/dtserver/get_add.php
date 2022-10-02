<?php 
include '../../resources/functions.php';

$id = $_POST["id"];
$query = query("SELECT * FROM admin_municipality WHERE province_id = '$id'");
confirm($query);
echo '$("#under_category").append( $(\'<option>\',{value:0,text:\'Select Municipality\'}));';
if ($query) {
	while($row = mysqli_fetch_array($query)) {
    	$row_id = $row["mn_id"];
    	$name = $row["mn_name"];
    	echo '$("#under_category").append( $(\'<option>\',{value:'.$row_id.',text:\''.($name).'\'}));'."\n";   	
    }
}
?>