<?php
// DB table to use
$table = 'admin_category';
// Table's primary key
$primaryKey = 'category_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
// 
$columns = array(
    array( 
            'db' => 'category_name',
            'dt' => 0
        ),
    array( 'db' => 'brand_name', 'dt' => 1 ),
    array( 'db' => 'updated_at', 'dt' => 2 ),
    array( 'db' => 'origin', 'dt' => 3 ),
    array( 
        'db' => 'status', 
        'dt' => 4,
        'formatter' => function( $d, $row ) { 
            if ($d == '1') {
                return 'Active';
            } else {
                return 'Deactivated';
            }
        }
         ),
    array( 
        'db' => 'category_id',
        'dt' => 5 , 
        'formatter' => function( $d, $row ) {
        return ('<div class="btn-group"><button type="button" class="btn btn-info bg-gr" id='.$d.' onclick="editcategory(this.id)"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger" id='.$d.' onclick="deletecategory(this.id)"><i class="fas fa-trash-alt"></i></button></div>');
        })
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
require('../../resources/functions.php');
// Output data as json format
echo json_encode(
    //SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=' status = 1')
);

?>
