<?php

include('../../resources/functions.php');
$store_arr = array();
$string = $_GET['dateval'];
$array = explode(' - ', $string);
$Count = 0;
$Date1 = "";
$Date2 = "";
$productID = $_GET['productid'];

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

// if($productID != 'All'){
// 	$product_filter = " AND a.product_name = '".$productID."'";
// }
	
// if ($_GET['storeid'] == 'All') {
	
// 	$query = query("SELECT a.store_id,b.location_name, a.zreading, sum(a.quantity) as qty , sum(a.total) as totalsales,a.product_name 
// 	FROM posrev.admin_daily_transaction_details a
// 	INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id 
// 	WHERE a.zreading >= '".$Date1."' and a.zreading <= '".$Date2."' 
// 	".$product_filter." group by a.store_id,a.product_name,a.zreading order by a.zreading asc");

// 	confirm($query);

// 	while ($row = fetch_array($query)) { 

// 		$ZreadDate 	  = $row['zreading'] ;
// 		$Product	  = $row['product_name'] ;
// 		$ProductSales = $row['totalsales'];
// 		$ProductQty   = $row['qty'];
// 		$Storeid 	  = $row['store_id'];
// 		$StoreName 	  = $row['location_name'];
// 		$store_arr[]  = array("Storeid" => $Storeid,"StoreName" => $StoreName ,"Product"=>$Product, "Sales" => 
// 		$ProductSales, "Qty" => $ProductQty,"Zread" => $ZreadDate);

// 	}	

// } else {

// 	$query = query("SELECT a.store_id,b.location_name, a.zreading, sum(a.quantity) as qty , sum(a.total) as totalsales,a.product_name 
// 	FROM posrev.admin_daily_transaction_details a
// 	INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id 
// 	WHERE a.store_id = '".$_GET['storeid']."' 
// 	AND a.zreading >= '".$Date1."' and a.zreading <= '".$Date2."' 
// 	".$product_filter." group by a.product_name,a.zreading order by a.zreading asc");
	
// 	confirm($query);

// 	while ($row = fetch_array($query)) { 

// 		$ZreadDate 	  = $row['zreading'] ;
// 		$Product	  = $row['product_name'] ;
// 		$ProductSales = $row['totalsales'];
// 		$ProductQty   = $row['qty'];
// 		$Storeid 	  = $row['store_id'];
// 		$StoreName 	  = $row['location_name'];
// 		$store_arr[]  = array("Storeid" => $Storeid,"StoreName" => $StoreName ,"Product"=>$Product, "Sales" => 
// 		$ProductSales, "Qty" => $ProductQty,"Zread" => $ZreadDate);

// 	}
// }
	
if ($_GET['storeid'] == 'All' && $productID == 'All') {
	
	$query = query("SELECT a.store_id,b.location_name, a.zreading, sum(a.quantity) as qty , sum(a.total) as totalsales,a.product_name 
	FROM posrev.admin_daily_transaction_details a
	INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id 
	WHERE a.zreading >= '".$Date1."' and a.zreading <= '".$Date2."' 
	group by a.store_id order by totalsales DESC LIMIT 10");

		

} else if ($_GET['storeid'] != 'All' && $productID == 'All') {
		$query = query("SELECT a.store_id,b.location_name, a.zreading, sum(a.quantity) as qty , sum(a.total) as totalsales,a.product_name 
	FROM posrev.admin_daily_transaction_details a
	INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id 
	WHERE a.store_id = '".$_GET['storeid']."' 
	AND a.zreading >= '".$Date1."' and a.zreading <= '".$Date2."' 
	 group by a.product_name order by totalsales DESC LIMIT 10");
	
}else if ($_GET['storeid'] == 'All' && $productID != 'All') {
	$query = query("SELECT a.store_id,b.location_name, a.zreading, sum(a.quantity) as qty , sum(a.total) as totalsales,a.product_name 
FROM posrev.admin_daily_transaction_details a
INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id 
WHERE a.product_name = '".$productID."' 
AND a.zreading >= '".$Date1."' and a.zreading <= '".$Date2."' 
 group by a.store_id order by totalsales DESC LIMIT 10");

}else if ($_GET['storeid'] != 'All' && $productID != 'All') {
	$query = query("SELECT a.store_id,b.location_name, a.zreading, sum(a.quantity) as qty , sum(a.total) as totalsales,a.product_name 
FROM posrev.admin_daily_transaction_details a
INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id 
WHERE a.store_id = '".$_GET['storeid']."' AND a.product_name = '".$productID."' 
AND a.zreading >= '".$Date1."' and a.zreading <= '".$Date2."' 
 group by a.store_id,a.product_name  order by totalsales DESC LIMIT 10");

}


confirm($query);

while ($row = fetch_array($query)) { 

	$ZreadDate 	  = $row['zreading'] ;
	$Product	  = $row['product_name'] ;
	$ProductSales = $row['totalsales'];
	$ProductQty   = $row['qty'];
	$Storeid 	  = $row['store_id'];
	$StoreName 	  = $row['location_name'];
	$store_arr[]  = array("Storeid" => $Storeid,"StoreName" => $StoreName ,"Product"=>$Product, "Sales" => 
	$ProductSales, "Qty" => $ProductQty,"Zread" => $ZreadDate);

}

echo json_encode($store_arr);

?>