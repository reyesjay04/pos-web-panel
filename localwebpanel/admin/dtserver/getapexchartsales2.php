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


// if ($_GET['storeid'] == 'All') {
// 	if ($_GET['btnid'] == 2) { 
// 		$query = query("SELECT sum(grosssales), store_id FROM posrev.admin_daily_transaction group by store_id order by grosssales asc;");
// 		confirm($query);
// 		while ($row = fetch_array($query)) { 

// 			$Sales = $row['sum(grosssales)'] ;
// 			$Storename =  "FBW-".$row['store_id'];
// 			$store_arr[] = array("Name" => $Storename, "Sales" => $Sales);

// 		}
// 	} else {
// 		$query = query("SELECT sum(grosssales), store_id FROM posrev.admin_daily_transaction WHERE zreading >= '".$Date1."' and zreading <= '".$Date2."' group by store_id order by grosssales asc;");
// 		confirm($query);
// 		while ($row = fetch_array($query)) { 

// 			$Sales = $row['sum(grosssales)'] ;
// 			$Storename =  "FBW-".$row['store_id'];
// 			$store_arr[] = array("Name" => $Storename, "Sales" => $Sales);

// 		}
// 	}

// } else {


// 		$query = query("SELECT sum(grosssales), store_id FROM posrev.admin_daily_transaction WHERE store_id = '".$_GET['storeid']."' AND zreading >= '".$Date1."' and zreading <= '".$Date2."' group by store_id order by grosssales asc;");
// 		confirm($query);
// 		while ($row = fetch_array($query)) { 

// 			$Sales = $row['sum(grosssales)'] ;
// 			$Storename =  "FBW-".$row['store_id'];
// 			$store_arr[] = array("Name" => $Storename, "Sales" => $Sales);

// 		}
	
// }

if ($_GET['clientid'] == 'All') {
	if ($_GET['btnid'] == 2) { 
		$query = query("SELECT a.store_id,b.location_name,sum(a.grosssales) grosssales,a.zreading 
		FROM posrev.admin_daily_transaction a 
		INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id
		group by a.store_id order by a.grosssales asc;");
		confirm($query);
		while ($row = fetch_array($query)) { 

			$Sales = $row['grosssales'] ;
			$Storeid =  "FBW-".$row['store_id'];
			$Storename =  $row['location_name'];
			$zreading =  $row['zreading'];
			$store_arr[] = array("Storeid"=>$Storeid,"Name" => $Storename, "Sales" => $Sales, "zreading"=>$zreading);

		}
	} else {
		$query = query("SELECT a.store_id,b.location_name,sum(a.grosssales) grosssales,a.zreading 
		FROM posrev.admin_daily_transaction a
		INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id
		WHERE a.zreading >= '".$Date1."' and a.zreading <= '".$Date2."' group by a.store_id order by a.grosssales asc;");
		confirm($query);
		while ($row = fetch_array($query)) { 

			$Sales = $row['grosssales'] ;
			$Storeid =  "FBW-".$row['store_id'];
			$Storename =  $row['location_name'];
			$zreading =  $row['zreading'];
			$store_arr[] = array("Storeid"=>$Storeid,"Name" => $Storename, "Sales" => $Sales, "zreading"=>$zreading);

		}
	}

} else {


		$query = query("SELECT a.store_id,b.location_name,sum(a.grosssales grosssales,a.zreading 
		FROM posrev.admin_daily_transaction a
		INNER  JOIN posrev.admin_outlets b on b.store_id = a.store_id
		WHERE b.user_guid = '".$_GET['clientid']."' AND a.zreading >= '".$Date1."' and a.zreading <= '".$Date2."' 
		group by a.store_id order by a.grosssales asc;");
		confirm($query);
		while ($row = fetch_array($query)) { 

			$Sales = $row['grosssales'] ;
			$Storeid =  "FBW-".$row['store_id'];
			$Storename =  $row['location_name'];
			$zreading =  $row['zreading'];
			$store_arr[] = array("Storeid"=>$Storeid,"Name" => $Storename, "Sales" => $Sales, "zreading"=>$zreading);

		}
	
}

echo json_encode($store_arr);

?>