<?php session_start();

include('../../resources/functions.php');
$store_arr = array();

$string = $_GET['dateval'];
$array = explode(' - ', $string); //split string into array seperated by ', '
$Count = 0;
$Date1 = "";
$Date2 = "";
$productID = $_GET['productid'];

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


$query = query("SELECT zreading, sum(quantity) as qty , sum(total) as totalsales  FROM posrev.admin_daily_transaction_details WHERE store_id IN (".$_SESSION['manager_store_id'].") AND zreading >= '".$Date1."' and zreading <= '".$Date2."' AND product_id = ".$productID." group by zreading order by zreading asc");

confirm($query);
while ($row = fetch_array($query)) { 

	$ZreadDate 	  = $row['zreading'] ;
	$ProductSales = $row['totalsales'];
	$ProductQty   = $row['qty'];
	$store_arr[]  = array("Zread" => $ZreadDate, "Sales" => $ProductSales, "Qty" => $ProductQty);

}

echo json_encode($store_arr);

?>