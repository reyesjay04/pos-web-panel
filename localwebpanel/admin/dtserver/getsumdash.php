<?php session_start();
include('../../resources/functions.php');

$sums = array();
//-------------------------------------------------Daily Transaction
$sql = "SELECT SUM(grosssales) as Grossales, SUM(amountdue) as TotalSales, COUNT(transaction_id) as Transaction FROM admin_daily_transaction";
$result = query($sql);
$row = mysqli_fetch_array($result);
$TTLTRAN = $row['Transaction'];  
$GrossSales = $row['Grossales'];
//-------------------------------------------------Master List
$sql2 = "SELECT count(masterlist_id) as POSClients FROM posrev.admin_masterlist";
$result2 = query($sql2);
$row2 = mysqli_fetch_array($result2);
$POSClients = $row2['POSClients'];
//-------------------------------------------------Accounts
$sql3 = "SELECT count(user_id) as Accounts FROM posrev.admin_user WHERE user_role = 'Client' AND status = 1";
$result3 = query($sql3);
$row3 = mysqli_fetch_array($result3);
$Accounts = $row3['Accounts'];



$sums[] = array("Sales" => $GrossSales, "Transactions" => $TTLTRAN, "POSClients" => $POSClients, "Accounts" => $Accounts);
echo json_encode($sums);