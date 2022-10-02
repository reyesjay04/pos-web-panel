<?php session_start();

include('../../resources/functions.php');
$store_arr = array();

$string = $_GET['dateval'];

$array = explode(' - ', $string); //split string into array seperated by ', '
$Count = 0;
$Date1 = "";
$Date2 = "";

foreach($array as $value) {

	if($Count == 0 ) {
		$Date1 = $value;
	}elseif ($Count > 0) {
		$Date2 = $value;
	}

$Count += 1;

}

$Date1 = date_create($Date1);
$Date1 = date_format($Date1,"Y-m-d");

$Date2 = date_create($Date2);
$Date2 = date_format($Date2,"Y-m-d");

$id = $_GET['id'];


if ($id == 0) {

	$query = query("SELECT SUM(grosssales) as GrossSales, store_id FROM admin_daily_transaction WHERE DATE(created_at) = CURDATE() group by store_id order by grosssales desc LIMIT 5;");
	confirm($query);

	while ($row = fetch_array($query)) { 

	$GrossSales = $row['GrossSales'] ;
	$StoreName = "FBW-" . $row['store_id'];
	$store_arr[] = array("x" => $StoreName, "y" => $GrossSales);

	}

} elseif ($id == 1) {
		
	$query = query("SELECT SUM(grosssales) as GrossSales, store_id FROM admin_daily_transaction WHERE DATE(created_at) BETWEEN '".$Date1."' AND '".$Date2."' group by store_id order by grosssales desc LIMIT 5;");

	;
	confirm($query);

	while ($row = fetch_array($query)) { 

	$GrossSales = $row['GrossSales'] ;
	$StoreName = "FBW-" . $row['store_id'];
	$store_arr[] = array("x" => $StoreName, "y" => $GrossSales);

	}
} 

echo json_encode($store_arr);

?>