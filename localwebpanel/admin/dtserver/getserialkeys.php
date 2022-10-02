<?php
Include '../../resources/functions.php';
// DB table to use
$table = 'admin_serialkeys';
// Table's primary key
$primaryKey = 'sk_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
// 
$columns = array(
    array( 'db' => 'serial_key', 'dt' => 0 ),
    array( 'db' => 'active', 'dt' => 1 ),
    array( 'db' => 'date_created', 'dt' => 2 ),
    array( 'db' => 'date_used', 'dt' => 3 ),
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
// Output data as json format
echo json_encode(
    SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns)
    //SSP::complex ( $_GET, $dbDetails, $table, $primaryKey, $columns, $whereResult=null, $whereAll='user_guid <> ""')
);

?>
