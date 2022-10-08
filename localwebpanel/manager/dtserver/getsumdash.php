<?php session_start();
include('../../resources/functions.php');

$sums = array();
//-------------------------------------------------Daily Transaction
$sql = "SELECT SUM(grosssales) as Grossales, SUM(amountdue) as TotalSales, COUNT(transaction_id) as Transaction FROM admin_daily_transaction WHERE store_id IN(".$_POST["storeid"].") ";
$result = query($sql);

$row = mysqli_fetch_array($result);

$TTLSALES = $row['TotalSales'];
$TTLTRAN = $row['Transaction'];  
$GrossSales = $row['Grossales'];


//-------------------------------------------------Users
$sql2 = "SELECT content FROM admin_message WHERE guid IN (".$_SESSION["manager_store_id"].") ORDER BY created_at LIMIT 1";
$result2 = query($sql2);
$row2 = mysqli_fetch_array($result2);
$Content = $row2['content'];



$sums[] = array("Sales" => $TTLSALES, "Transactions" => $TTLTRAN, "Message" => $GrossSales, "Announcements" => $Content);
echo json_encode($sums);