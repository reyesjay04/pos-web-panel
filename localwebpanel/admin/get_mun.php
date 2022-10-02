<?php include '../resources/functions.php'; ?>
<?php
	global $connection;
	$id = $_GET["id"];
	$query = mysqli_query($connection,"SELECT * FROM admin_municipality WHERE province_id = '$id'");
	echo '$("#under_category").append( $(\'<option>\',{value:0,text:\'Select Municipality\'}));';
    if ($query) {
    	while($row = mysqli_fetch_array($query)) {
	    	$row_id = $row["mn_id"];
	    	$name = $row["mn_name"];
	    	echo '$("#under_category").append( $(\'<option>\',{value:'.$row_id.',text:\''.($name).'\'}));'."\n";   	
	    }
    }
?>