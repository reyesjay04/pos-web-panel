<?php session_start();
include('../../resources/functions.php');
// DB table to use
$table = 'admin_daily_transaction';
// Table's primary key
$primaryKey = 'transaction_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
$columns = array(

    array( 'db' => 'transaction_number',     'dt' => 0 ),
    array( 'db' => 'grosssales',     'dt' => 1 ),
    array( 'db' => 'totaldiscount',     'dt' => 2 ),
    array( 'db' => 'amounttendered',     'dt' => 3 ),
    array( 'db' => 'change',     'dt' => 4 ),
    array( 'db' => 'amountdue',     'dt' => 5 ),
    array( 'db' => 'transaction_type',     'dt' => 6 ),
    array( 'db' => 'created_at',     'dt' => 7 ),
    array(
        'db' => 'transaction_number', 
        'dt' => 8,
        'formatter' => function( $d, $row ) {
                return ('<button style="cursor:pointer;" name="view" onclick="ViewProductInfo(this.id)"  id = "'.$d.'" value="Edit" class="btn btn-block btn-info btn-xs">&nbsp;View sales info&nbsp;</button>');
        }
    )
    
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
// Output data as json format
echo json_encode(
    // SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll='store_id = "'.$_GET['store'].'" AND DATE_FORMAT(created_at, "%Y-%m-%d") = DATE_FORMAT(curdate(), "%Y-%m-%d")')
);

?>


