<?php
// DB table to use
$table = 'admin_user';
// Table's primary key
$primaryKey = 'user_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
// 
$columns = array(
    array( 'db' => 'user_fname', 'dt' => 0 ),
    array(
        'db'        => 'user_guid',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {

            return ('
                    <a href="?gtoid='.$d.' " class="card-link view_data">
                    View Outlets
                    </a>
                    ');
        }
    ),
    array(

    'db'        => 'status',
    'dt'        => 2,
    'formatter' => function( $d, $row ) {
        return ($d == 1)?'<span data-toggle="tooltip" data-original-title="Active"><i class="fas fa-check-circle"></i> </span>':'<span data-toggle="tooltip" data-original-title="Inactive"><i class="fas fa-times-circle"></i></span>';
        }
    ),
    array( 'db' => 'user_lname', 'dt' => 3 ),
    array( 'db' => 'user_name', 'dt' => 1 )
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
require('../../resources/functions.php');
// Output data as json format
echo json_encode(
    //SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=' user_role = "Client" AND status = 1')
);

?>