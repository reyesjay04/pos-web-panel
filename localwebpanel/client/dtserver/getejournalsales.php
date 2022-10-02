<?php session_start();
include('../../resources/functions.php');
// DB table to use
$table = 'admin_daily_transaction';
// Table's primary key
$primaryKey = 'transaction_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
$string = $_GET['daterange'];
$array = explode(' - ', $string);

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

$FinalWhere = '';
if ($_GET['storeid'] == "All") {
    if ($_GET['transactiontype'] == 'All(Cash)') {
        $FinalWhere = ' zreading >= "'.$Date1.'" and zreading <= "'.$Date2.'" AND active IN(1,2,3) AND guid = "'  .$_SESSION['client_user_guid'].  '" AND transaction_type IN ("Walk-In", "Registered") ';
    } elseif($_GET['transactiontype'] == 'All(Others)') {
        $FinalWhere = ' zreading >= "'.$Date1.'" and zreading <= "'.$Date2.'" AND active IN(1,2,3) AND guid = "'  .$_SESSION['client_user_guid'].  '" AND transaction_type NOT IN ("Walk-In", "Registered") ';
    } else {
        $FinalWhere = ' zreading >= "'.$Date1.'" and zreading <= "'.$Date2.'" AND active IN(1,2,3) AND guid = "'  .$_SESSION['client_user_guid'].  '" AND `transaction_type` = "'.$_GET['transactiontype'].'" ';
    }
} else {
    if ($_GET['transactiontype'] == 'All(Cash)') {
        $FinalWhere = ' zreading >= "'.$Date1.'" and zreading <= "'.$Date2.'" AND active IN(1,2,3) AND store_id = "'  .$_GET['storeid'].  '" AND guid = "'  .$_SESSION['client_user_guid'].  '" AND transaction_type IN ("Walk-In", "Registered") ';
    } elseif($_GET['transactiontype'] == 'All(Others)') {
        $FinalWhere = ' zreading >= "'.$Date1.'" and zreading <= "'.$Date2.'" AND active IN(1,2,3) AND store_id = "'  .$_GET['storeid'].  '" AND guid = "'  .$_SESSION['client_user_guid'].  '" AND transaction_type NOT IN ("Walk-In", "Registered") ';
    } else {
        $FinalWhere = ' zreading >= "'.$Date1.'" and zreading <= "'.$Date2.'" AND active IN(1,2,3) AND store_id = "'  .$_GET['storeid'].  '" AND guid = "'  .$_SESSION['client_user_guid'].  '" AND `transaction_type` = "'.$_GET['transactiontype'].'" ';
    }
}


$columns = array(

    array( 'db' => 'transaction_number',     'dt' => 0 ),
    array( 'db' => 'grosssales',     'dt' => 1 ),
    array( 'db' => 'totaldiscount',     'dt' => 2 ),
    array( 'db' => 'amounttendered',     'dt' => 3 ),
    array( 'db' => 'change',     'dt' => 4 ),
    array( 'db' => 'amountdue',     'dt' => 5 ),
    array( 'db' => 'transaction_type',     'dt' => 6 ),
    array( 'db' => 'created_at', 'dt' => 7) 
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
// Output data as json format
echo json_encode(
    // SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=''.$FinalWhere.'')
);

?>


