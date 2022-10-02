<?php
// DB table to use
$table = 'admin_user';
// Table's primary key
$primaryKey = 'user_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
$columns = array(
    array('db' => 'user_fname', 'dt' => 0 ),
    array('db' => 'user_lname', 'dt' => 1 ),
    array('db' => 'user_name', 'dt' => 2 ),
    array('db' => 'user_email', 'dt' => 3 ),
    array('db' => 'contact_no', 'dt' => 4 ),
    array('db' => 'user_role', 'dt' => 5 ),
    array(
            'db' => 'status', 
            'dt' => 6,
            'formatter' => function( $d, $row ){
                if ($d == 0) {
                    return ('<span data-toggle="tooltip"  title="" class="badge bg-red" data-original-title="Inactive"><i class="fas fa-minus-circle"></i></span>');
                }
                if ($d == 1) {
                    return ('<span data-toggle="tooltip" title="" class="badge bg-green" data-original-title="Active"><i class="fas fa-check-circle"></i></span>');
                }
            }
        ),
    array(
            'db' => 'user_id', 
            'dt' => 7,
            'formatter' => function( $d, $row ){ 
                return ('<div class="btn-group"><button type="button" class="btn btn-info bg-gr" id='.$d.' onclick="approve(this.id)"><i class="fas fa-check"></i></button></div><button type="button" class="btn btn-danger" id='.$d.' onclick="decline(this.id)"><i class="fas fa-trash-alt"></i></button></div>');
            }
        )
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
require('../../resources/functions.php');
// Output data as json format
echo json_encode(
     //SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=" status = 0")
);

?>

