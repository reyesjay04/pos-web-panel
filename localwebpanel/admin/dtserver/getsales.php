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
	if ($_POST['btnid'] == 2) { 
		$query = query("SELECT sum(grosssales), store_id FROM posrev.admin_daily_transaction group by store_id order by grosssales asc;");
		confirm($query);
		while ($row = fetch_array($query)) { 

			$Sales = $row['sum(grosssales)'] ;
			$Storename =  "FBW-".$row['store_id'];
			$store_arr[] = array("Name" => $Storename, "Sales" => $Sales);

		}
	} else {
		$query = query("SELECT sum(grosssales), store_id FROM posrev.admin_daily_transaction WHERE zreading >= '".$Date1."' and zreading <= '".$Date2."' group by store_id order by grosssales asc;");
		confirm($query);
		while ($row = fetch_array($query)) { 

			$Sales = $row['sum(grosssales)'] ;
			$Storename =  "FBW-".$row['store_id'];
			$store_arr[] = array("Name" => $Storename, "Sales" => $Sales);

		}
	}

} else {


		$query = query("SELECT sum(grosssales), store_id FROM posrev.admin_daily_transaction WHERE store_id = '".$_POST['storeid']."' AND zreading >= '".$Date1."' and zreading <= '".$Date2."' group by store_id order by grosssales asc;");
		confirm($query);
		while ($row = fetch_array($query)) { 

			$Sales = $row['sum(grosssales)'] ;
			$Storename =  "FBW-".$row['store_id'];
			$store_arr[] = array("Name" => $Storename, "Sales" => $Sales);

		}
	
}

echo json_encode($store_arr);

?>