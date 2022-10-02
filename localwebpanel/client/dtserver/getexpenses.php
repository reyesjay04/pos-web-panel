<?php session_start();
include('../../resources/functions.php');
$store_arr = array();

$storeid = $_GET['storeid'];
$string = $_GET['dateval'];

// echo $storeid;
// echo $string;
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

$sql = "SELECT SUM(total_amount) as Expense, zreading FROM posrev.admin_expense_list WHERE zreading >= '$Date1' AND zreading <= '$Date2' AND store_id = $storeid group by zreading ;";

$query = query($sql);
confirm($query);
while ($row = fetch_array($query)) { 
    $Expenses  = $row['Expense'];  
    $ZreadDate = $row['zreading'];
    $store_arr[] = array("Expenses" => $Expenses, "ZreadDate" => $ZreadDate);
}
echo json_encode($store_arr);
?>



