<?php

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

$ProductName = "";
$Quantity = "";
$Total = "";
	
if ($_POST['storeid'] == 'All') {
	# code...
	if ($_POST['btnid'] == 0) {
		# code...
		$query = query("SELECT product_name, SUM(total), SUM(quantity) FROM posrev.admin_daily_transaction_details group by product_name order by SUM(total) desc LIMIT 10;");
		confirm($query);
		while ($row = fetch_array($query)) { 

			$ProductName = $row['product_name'];
			$Total =  $row['SUM(total)'];
			$Quantity =  $row['SUM(quantity)'];
			$store_arr[] = array("BarGraphLabel" => $ProductName, "Quantity" => $Quantity, "Total" => $Total);

		}
	} else {

		$query = query("SELECT product_name, SUM(total), SUM(quantity) FROM posrev.admin_daily_transaction_details WHERE zreading >= '".$Date1."' and zreading <= '".$Date2."' group by product_name order by SUM(total) desc LIMIT 10;");
		confirm($query);
		while ($row = fetch_array($query)) { 

			$ProductName = $row['product_name'];
			$Total =  $row['SUM(total)'];
			$Quantity =  $row['SUM(quantity)'];
			$store_arr[] = array("BarGraphLabel" => $ProductName, "Quantity" => $Quantity, "Total" => $Total);
		}	
	}
} else {
	# code...
	$query = query("SELECT product_name, SUM(total), SUM(quantity) FROM posrev.admin_daily_transaction_details WHERE  store_id = '".$_POST['storeid']."' AND zreading >= '".$Date1."' and zreading <= '".$Date2."' group by product_name order by SUM(total) desc LIMIT 10;");
	confirm($query);
	while ($row = fetch_array($query)) { 

		$ProductName = $row['product_name'];
		$Total =  $row['SUM(total)'];
		$Quantity =  $row['SUM(quantity)'];
		$store_arr[] = array("BarGraphLabel" => $ProductName, "Quantity" => $Quantity, "Total" => $Total);

	}
}

echo json_encode($store_arr);

?>