<?php

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

$ProductName = "";
$Quantity = "";
$Total = "";

// echo $_GET['storeid'] . "<br>";
// echo $_GET['btnid']. "<br>";
// echo $_GET['dateval'] . "<br>";



	
if ($_GET['storeid'] == 'All') {
	# code...
	if ($_GET['btnid'] == 0) {
		# code...
		$query = query("SELECT b.store_id,b.location_name,a.product_name,a.zreading, SUM(a.total) total, SUM(a.quantity) quantity
		FROM posrev.admin_daily_transaction_details a 
		INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id
		 group by a.product_name order by SUM(a.total) desc LIMIT 10;");
		confirm($query);
		while ($row = fetch_array($query)) { 
			$store_id = 'FBW-'.$row['store_id'];
			$store_name = $row['location_name'];
			$ProductName = $row['product_name'];
			$Total =  $row['total'];
			$Quantity =  $row['quantity'];
			$zreading =  $row['zreading'];
			$store_arr[] = array("storeid"=>$store_id,"store_name"=>$store_name,"BarGraphLabel" => $ProductName,
			 "x" => $Quantity, "y" => $Total,"zreading" => $zreading);

		}
	} else {

		$query = query("SELECT b.store_id,b.location_name,a.product_name,a.zreading, SUM(a.total) total, SUM(a.quantity) quantity
		FROM posrev.admin_daily_transaction_details a 
		INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id
		WHERE a.zreading >= '".$Date1."' and a.zreading <= '".$Date2."' group by a.product_name order by SUM(a.total) desc LIMIT 10;");
		confirm($query);
		while ($row = fetch_array($query)) { 
			$store_id = 'FBW-'.$row['store_id'];
			$store_name = $row['location_name'];
			$ProductName = $row['product_name'];
			$Total =  $row['total'];
			$Quantity =  $row['quantity'];
			$zreading =  $row['zreading'];
			$store_arr[] = array("storeid"=>$store_id,"store_name"=>$store_name,"BarGraphLabel" => $ProductName,
			 "x" => $Quantity, "y" => $Total,"zreading" => $zreading);
		}	
	}
} else {
	# code...
	$query = query("SELECT b.store_id,b.location_name,a.product_name,a.zreading, SUM(a.total) total, SUM(a.quantity) quantity
	FROM posrev.admin_daily_transaction_details a 
	INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id
	WHERE  a.store_id = '".$_GET['storeid']."' AND a.zreading >= '".$Date1."' and a.zreading <= '".$Date2."' 
	group by a.product_name order by SUM(a.total) desc LIMIT 10;");
	confirm($query);
	while ($row = fetch_array($query)) { 
		$store_id = 'FBW-'.$row['store_id'];
		$store_name = $row['location_name'];
		$ProductName = $row['product_name'];
		$Total =  $row['total'];
		$Quantity =  $row['quantity'];
		$zreading =  $row['zreading'];
		$store_arr[] = array("storeid"=>$store_id,"store_name"=>$store_name,"BarGraphLabel" => $ProductName,
		 "x" => $Quantity, "y" => $Total,"zreading" => $zreading);

	}
}

echo json_encode($store_arr);

?>