<?php session_start();

include('../../resources/functions.php');
$store_arr = array();

$string = $_POST['dateval'];

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

$id = $_POST['id'];


if ($id == 0) {

	$query = query("SELECT SUM(grosssales) as GrossSales, store_id FROM posrev.admin_daily_transaction group by store_id order by grosssales desc LIMIT 5;");
	confirm($query);

	while ($row = fetch_array($query)) { 

	$GrossSales = $row['GrossSales'] ;
	$StoreName = "FBW-" . $row['store_id'];
	$store_arr[] = array("BarGraphLabel" => $StoreName, "Total" => $GrossSales);

	}

} elseif ($id == 1) {
		
	$query = query("SELECT SUM(grosssales) as GrossSales, store_id FROM posrev.admin_daily_transaction WHERE DATE_FORMAT(created_at, '%Y-%m-%d') >= '".$Date1."' AND DATE_FORMAT(created_at, '%Y-%m-%d') <= '".$Date2."' group by store_id order by grosssales desc LIMIT 5;");

	;
	confirm($query);

	while ($row = fetch_array($query)) { 

	$GrossSales = $row['GrossSales'] ;
	$StoreName = "FBW-" . $row['store_id'];
	$store_arr[] = array("BarGraphLabel" => $StoreName, "Total" => $GrossSales);

	}
} 

echo json_encode($store_arr);

?>