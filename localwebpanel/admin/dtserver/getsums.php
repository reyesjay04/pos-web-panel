<?php
include('../../resources/functions.php');

$sums = array();
//-------------------------------------------------Daily Transaction
$sql = "SELECT SUM(grosssales) as GrossSales, COUNT(transaction_id) as trncounnt, SUM(amountdue) as Netsales FROM admin_daily_transaction WHERE store_id = '".$_POST["storeid"]."' ";
$result = query($sql);

$row = mysqli_fetch_array($result);

$GrossSales = $row['GrossSales'];
$NetSales = $row['Netsales'];  
$Transactions = $row['trncounnt'];

//-------------------------------------------------Users
$sql2 = "SELECT  COUNT(user_id) as Users FROM loc_users WHERE store_id = '".$_POST["storeid"]."' ";
$result2 = query($sql2);
$row2 = mysqli_fetch_array($result2);
$Users = $row2['Users'];

$sums[] = array("transactions" => $Transactions, "users" => $Users, "grosssales" => $GrossSales, "netsales" => $NetSales);
echo json_encode($sums);