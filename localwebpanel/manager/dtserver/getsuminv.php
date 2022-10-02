<?php session_start();
include('../../resources/functions.php');

$sums = array();
//-------------------------------------------------Daily Transaction
$sql = "SELECT count(inventory_id) as INVCOUNT, SUM(stock_primary) as PRMRY, SUM(stock_secondary) as SEC, SUM(stock_no_of_servings) as SERV FROM admin_pos_inventory WHERE store_id = '".$_POST["invid"]."' ";
$result = query($sql);

$row = mysqli_fetch_array($result);

$InvCount = $row['INVCOUNT'];
$Primary = $row['PRMRY'];  
$Secondary = $row['SEC'];
$Servings = $row['SERV'];

$sums[] = array("invcount" => $InvCount, "primary" => $Primary, "secondary" => $Secondary, "servings" => $Servings);
echo json_encode($sums);