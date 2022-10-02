<?php
$transaction_number = $_POST['id'];
echo "<div id='printThis'><dl class='row'>";
echo "<dt class='col-sm-12'><h5>Transaction Number: ". $transaction_number . "</h5></dt>";

include '../../resources/functions.php';

$sql = "SELECT * FROM admin_daily_transaction WHERE transaction_number = '".$transaction_number."'; ";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);

$amountdue = $row['amountdue'];
$cash = $row['amounttendered'];
$change = $row['change'];
$vatable = $row['vatablesales'];
$vatexemptsales = $row['vatexemptsales'];
$zeroratedsales = $row['zeroratedsales'];
$vatpercentage = $row['vatpercentage'];
$lessvat = $row['lessvat'];
$transactiontype = $row['transaction_type'];
$storeID = $row['store_id'];
$crewID = $row['crew_id'];
$datecreated = $row['created_at'];

$sql2 = "SELECT * FROM admin_daily_transaction_details WHERE transaction_number = '".$transaction_number."';";
$result2 = mysqli_query($connection, $sql2);
$totalQTY = 0;
while ($row2 = mysqli_fetch_array($result2)) {	
	echo "<dt class='col-sm-6'><small style='font-size: 15px;'>".$row2['quantity']." ".$row2['product_name']."</small></dt>";
	echo "<dt class='col-sm-6'><small style='font-size: 15px;'>".$row2['price']."</small></dt>";
	$totalQTY += $row2['quantity'];
}

echo "<dt class='col-sm-12'><h5>----------------------------------------------------</h5></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>AMOUNT DUE: </small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>".$amountdue."</small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>CASH: </small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>".$cash."</small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>CHANGE: </small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>".$change."</small></dt>";
echo "<dt class='col-sm-12'><h5>----------------------------------------------------</h5></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>Vatable: </small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>".$vatable."</small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>Vat Exempt Sales: </small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>".$vatexemptsales."</small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>Zero Rated Sales: </small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>".$zeroratedsales."</small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>Vat(12%): </small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>".$vatpercentage."</small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>Less Vat: </small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>".$lessvat."</small></dt>";
echo "<dt class='col-sm-12'><h5>----------------------------------------------------</h5></dt>";
echo "<dt class='col-sm-12'><small style='font-size: 15px;'>Transaction Type: ".$transactiontype."</small></dt>";	
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>Total Item(s): ".$totalQTY ."</small></dt>";
echo "<dt class='col-sm-6'><small style='font-size: 15px;'>Store No: ".$storeID ."</small></dt>";
echo "<dt class='col-sm-12'><small style='font-size: 15px;'>Cashier: ".$crewID."</small></dt>";	
echo "<dt class='col-sm-12'><small style='font-size: 15px;'>Date & Time: ".$datecreated."</small></dt>";	
echo "</dl></div>";
?>


