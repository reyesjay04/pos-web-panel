<?php
// DB table to use
$table = 'admin_product_formula_org';
// Table's primary key
$primaryKey = 'server_formula_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
// 
$columns = array(
    array( 
            'db' => 'product_ingredients',
            'dt' => 0
        ),
    array( 'db' => 'primary_unit', 'dt' => 1 ),
    array( 'db' => 'primary_value', 'dt' => 2 ),
    array( 'db' => 'secondary_unit', 'dt' => 3 ),
    array( 'db' => 'secondary_value', 'dt' => 4 ),
    array( 'db' => 'serving_unit', 'dt' => 5 ),
    array( 'db' => 'serving_value', 'dt' => 6 ),
    array( 'db' => 'no_servings', 'dt' => 7 ),



    array( 
        'db' => 'status', 
        'dt' => 8,
        'formatter' => function( $d, $row ) { 
            if ($d == '1') {
                return 'Active';
            } else {
                return 'Deactivated';
            }
        }
         ),
    array( 'db' => 'date_modified', 'dt' => 9 ),
    array( 'db' => 'unit_cost', 'dt' => 10 ),

    array( 
        'db' => 'server_formula_id',
        'dt' => 11 , 
        'formatter' => function( $d, $row ) {
        return ('<div class="btn-group"><button type="button" class="btn btn-info bg-gr" id='.$d.' onclick="editformula(this.id)"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger" id='.$d.' onclick="deleteformula(this.id)"><i class="fas fa-trash-alt"></i></button></div>');
        })
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
require('../../resources/functions.php');
// Output data as json format
echo json_encode(
    //SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=' status = 1')
);

?>
