<?php session_start();
include('../../resources/functions.php');
// DB table to use
$table = 'admin_system_logs';
// Table's primary key
$primaryKey = 'log_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
$columns = array(
    array( 'db' => 'log_id',     'dt' => 0 ),
    array( 'db' => 'log_type',     'dt' => 1 ),
    array( 'db' => 'log_description',     'dt' => 2 ),
    array( 'db' => 'log_date_time',     'dt' => 3 )   
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
// Output data as json format
echo json_encode(
    // SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll='log_store = "'.$_GET['syslogs'].'"')
);

?>


