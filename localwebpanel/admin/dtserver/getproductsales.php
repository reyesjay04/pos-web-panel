<?php

include('../../resources/functions.php');
$store_arr = array();
$string = $_POST['dateval'];
$array = explode(' - ', $string);
$Count = 0;
$Date1 = "";
$Date2 = "";
$productID = $_POST['productid'];

foreach($array as $value) {

	if($Count == 0 ) {
		$Date1 = $value;
	} elseif ($Count > 0) {
		$Date2 = $value;
	}

$Count += 1;

}

$Date1 = date_create($Date1);
$Date1 = date_format($Date1,"Y-m-d");

$Date2 = date_create($Date2);
$Date2 = date_format($Date2,"Y-m-d");
	
if ($_POST['storeid'] == 'All') {
	
	$query = query("SELECT store_id, zreading, sum(quantity) as qty , sum(total) as totalsales  FROM posrev.admin_daily_transaction_details WHERE zreading >= '".$Date1."' and zreading <= '".$Date2."' AND product_id = ".$productID." group by zreading order by zreading asc");

	confirm($query);

	while ($row = fetch_array($query)) { 

		$ZreadDate 	  = $row['zreading'] ;
		$ProductSales = $row['totalsales'];
		$ProductQty   = $row['qty'];
		$StoreName 	  = $row['store_id'];
		$store_arr[]  = array("Zread" => "FBW-".$StoreName."(".$ZreadDate.")", "Sales" => $ProductSales, "Qty" => $ProductQty);

	}	

} else {

	$query = query("SELECT store_id, zreading, sum(quantity) as qty , sum(total) as totalsales  FROM posrev.admin_daily_transaction_details WHERE store_id = '".$_POST['storeid']."' AND zreading >= '".$Date1."' and zreading <= '".$Date2."' AND product_id = ".$productID." group by zreading order by zreading asc");

	confirm($query);

	while ($row = fetch_array($query)) { 

		$ZreadDate 	  = $row['zreading'] ;
		$ProductSales = $row['totalsales'];
		$ProductQty   = $row['qty'];
		$StoreName 	  = $row['store_id'];
		$store_arr[]  = array("Zread" => "FBW-".$StoreName."(".$ZreadDate.")", "Sales" => $ProductSales, "Qty" => $ProductQty);

	}
}

echo json_encode($store_arr);

?>