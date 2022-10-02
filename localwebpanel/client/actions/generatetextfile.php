<?php session_start();
$daterange = $_POST['daterange'];
$storeid = $_POST['storeid'];
$transactiontype = $_POST['transactiontype'];

$daterange = explode(' - ', $daterange);

foreach($daterange as $value) {
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

$transactionNumbers = array();

include('../../resources/functions.php');
if ($storeid == "All") {
	if ($transactiontype == "All(Cash)") {
        $query = query("SELECT transaction_number, crew_id, totaldiscount, amounttendered, `change` FROM admin_daily_transaction WHERE zreading >= '".$Date1."' AND zreading <= '".$Date2."' AND transaction_type IN ('Walk-In','Registered') AND guid = '".$_SESSION['client_user_guid']."'");
        confirm($query);
        while ($row = fetch_array($query)) { 
			array_push($transactionNumbers, $row['transaction_number']); 
        } 
	} elseif ($transactiontype == "All(Others)") {
        $query = query("SELECT transaction_number, crew_id, totaldiscount, amounttendered, `change` FROM admin_daily_transaction WHERE zreading >= '".$Date1."' AND zreading <= '".$Date2."' AND transaction_type NOT IN ('Walk-In','Registered') AND guid = '".$_SESSION['client_user_guid']."'");
        confirm($query);
        while ($row = fetch_array($query)) { 
			array_push($transactionNumbers, $row['transaction_number']); 
        } 
	} else {
        $query = query("SELECT transaction_number, crew_id, totaldiscount, amounttendered, `change` FROM admin_daily_transaction WHERE zreading >= '".$Date1."' AND zreading <= '".$Date2."' AND transaction_type = '".$transactiontype."' AND guid = '".$_SESSION['client_user_guid']."'");
        confirm($query);
        while ($row = fetch_array($query)) { 
			array_push($transactionNumbers, $row['transaction_number']); 
			array_push($crewID, $row['crew_id']);
        } 
	}
} else {
	if ($transactiontype == "All(Cash)") {   
        $query = query("SELECT transaction_number, crew_id, totaldiscount, amounttendered, `change` FROM admin_daily_transaction WHERE zreading >= '".$Date1."' AND zreading <= '".$Date2."' AND transaction_type IN ('Walk-In','Registered') AND guid = '".$_SESSION['client_user_guid']."' AND store_id = '".$storeid."'");
        confirm($query);
        while ($row = fetch_array($query)) { 
			array_push($transactionNumbers, $row['transaction_number']); 
			array_push($crewID, $row['crew_id']);
        } 
	} elseif ($transactiontype == "All(Others)") {
        $query = query("SELECT transaction_number, crew_id, totaldiscount, amounttendered, `change` FROM admin_daily_transaction WHERE zreading >= '".$Date1."' AND zreading <= '".$Date2."' AND transaction_type NOT IN ('Walk-In','Registered') AND guid = '".$_SESSION['client_user_guid']."' AND store_id = '".$storeid."'");
        confirm($query);
        while ($row = fetch_array($query)) { 
			array_push($transactionNumbers, $row['transaction_number']); 
        } 
	} else {
        $query = query("SELECT transaction_number, crew_id, totaldiscount, amounttendered, `change` FROM admin_daily_transaction WHERE zreading >= '".$Date1."' AND zreading <= '".$Date2."' AND transaction_type = '".$transactiontype."' AND guid = '".$_SESSION['client_user_guid']."' AND store_id = '".$storeid."'");
        confirm($query);
        while ($row = fetch_array($query)) { 
			array_push($transactionNumbers, $row['transaction_number']); 
        }
	}
}
$myfile = fopen("../newfile.txt", "w") or die("Unable to open file!");
foreach ($transactionNumbers as $trnList) {
	$query = query("SELECT vatablesales,vatpercentage,vatexemptsales,zeroratedsales,lessvat, crew_id, totaldiscount, amounttendered, `change`, transaction_type FROM admin_daily_transaction WHERE transaction_number = '".$trnList."'");
	confirm($query);
	$row = fetch_array($query);

	$txt = "Terminal No.\n";
	fwrite($myfile, $txt);
	$txt = "SO/TB #: N/A\n";
	fwrite($myfile, $txt);
	$txt = "No. of Guest: 1\n";
	fwrite($myfile, $txt);
	$txt = "Sales Invoice #: " . $trnList . "\n";
	fwrite($myfile, $txt);
	$txt = $row['transaction_type'] ."\n";
	fwrite($myfile, $txt);
	$txt = "Cshr: " . $row['crew_id']. "\n";
	fwrite($myfile, $txt);
	$txt = "-------------------------------\n";
	fwrite($myfile, $txt);
	$txt = "Qty     Description(s)    Price\n";
	fwrite($myfile, $txt);
	$txt = "-------------------------------\n";
	fwrite($myfile, $txt);

	$ttlQty = 0;
	$ttlPrice = 0;
	$grandTotal = 0;
	$query = query("SELECT product_name,quantity,price,total,product_category FROM admin_daily_transaction_details WHERE transaction_number = '".$trnList."'");
	confirm($query);
	while ($row1 = fetch_array($query)) { 	
	$ttlQty += $row1['quantity'];
	$ttlPrice += $row1['price'];
	$grandTotal += $row1['total'];
	$txt = $row1['product_name']."\n";	
	fwrite($myfile, $txt);
	$txt = "     ". $row1['quantity']." @".$row1['price']. "             ".$row1['total']."\n";
	fwrite($myfile, $txt);
	} 

	$txt = "----------".$ttlQty." item(s)------------\n";
	fwrite($myfile, $txt);
	$txt = "   Sub Total              ".$ttlPrice."\n";
	fwrite($myfile, $txt);
	$txt = "   Discount               ".$row['totaldiscount']."\n";
	fwrite($myfile, $txt);
	$txt = "-------------------------------\n";
	fwrite($myfile, $txt);
	$txt = "Total                     "  .$grandTotal."\n";
	fwrite($myfile, $txt);
	$txt = "\n";
	fwrite($myfile, $txt);
	$txt = "Tendered:\n";
	fwrite($myfile, $txt);
	$txt = "     CASH                 ". $row['amounttendered'] . "\n";
	fwrite($myfile, $txt);
	$txt = "Change                    ". $change . "\n";
	fwrite($myfile, $txt);
	$txt = "-------------------------------\n";
	fwrite($myfile, $txt);


	
	$txt = "    VaTable Sales         ".$row['vatablesales']."\n";	
	fwrite($myfile, $txt);				
	$txt = "    VAT 12.00%            ".$row['vatpercentage']."\n";	
	fwrite($myfile, $txt);
	$txt = "    VAT Exempt Sales      ".$row['vatexemptsales']."\n";	
	fwrite($myfile, $txt);
	$txt = "    Zero Rated Sales      ".$row['zeroratedsales']."\n";
	fwrite($myfile, $txt);
	$txt = "    Less Vat              ".$row['lessvat']."\n";
	fwrite($myfile, $txt);

	$txt = "-------------------------------\n";
	fwrite($myfile, $txt);
	$txt = "\n";
	fwrite($myfile, $txt);
	$txt = "      ".date("Y/m/d h:i:s")."\n";
	fwrite($myfile, $txt);
	$query = query("SELECT senior_name FROM admin_senior_details WHERE transaction_number = '".$trnList."'");
	confirm($query);
	echo $row3['senior_name'];
	$row3 = fetch_array($query);
	if ($row3['senior_name'] == "") {
	$txt = "Name : ________________________\n";
	fwrite($myfile, $txt);
	} else {
	$txt = "Name : ".$row3['senior_name'] ."\n";
	fwrite($myfile, $txt);
	}

	$txt = "Address : _____________________\n";
	fwrite($myfile, $txt);
	$txt = "TIN : _________________________\n";
	fwrite($myfile, $txt);
	$txt = "   ---***---***---***---***---  \n";
	fwrite($myfile, $txt);

}
fclose($myfile);

// $myfile = fopen("../newfile.txt", "w") or die("Unable to open file!");
// $txt = $daterange . " John Doe\n";
// fwrite($myfile, $txt);
// $txt = $storeid . " Jane Doe\n";
// fwrite($myfile, $txt);
// fclose($myfile);
?>
