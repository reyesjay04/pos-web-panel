<?php session_start();
include('../../resources/functions.php');
// DB table to use
$table = 'admin_outlets';
// Table's primary key
$primaryKey = 'store_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
$columns = array(
    array( 'db' => 'store_name',     'dt' => 0 ),
    array( 'db' => 'address',    'dt' => 1 ),
    array( 'db' => 'location_name',    'dt' => 2 ),
    array( 'db' => 'postal_code',    'dt' => 3 ),
    array(
        'db'        => 'active',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {    
            if($d == 0) {
               return ('Not Activated');
            } elseif ($d == 1) {
               return ('Activated');
            } elseif ($d == 2) {
                 return ('Pos Activated');
            }
        }
    )
    ,  
    array(
        'db'        => 'store_id',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {

            if (outletcheck($d) == 0) {
                return ('<button style="cursor:pointer;" name="view" onclick="Activate(this.id)"  id = "'.$d.'" value="Edit" class="btn btn-block btn-info btn-xs">&nbsp;Activate&nbsp;</button>');
                
            } elseif (outletcheck($d) == 1) {
                return ('None');
            } else {
                return ('POS Activate');
            }
        }
    )
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
// Output data as json format
echo json_encode(
   // SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll='manager_guid = "'.$_SESSION['manager_user_guid'].'" ')
);
?>


