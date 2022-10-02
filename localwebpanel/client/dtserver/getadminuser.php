<?php session_start();
$role = $_GET['role'];
$FinalRole = "";
if($role == "All") {
    $FinalRole = " position IN('Head Crew','Crew') AND guid = '".$_SESSION['client_user_guid']."'";
} elseif ($role == "HeadCrew") {
    $FinalRole = " position = 'Head Crew' AND guid = '".$_SESSION['client_user_guid']."'";
} elseif ($role == "Crew") {
    $FinalRole = " position = 'Crew' AND guid = '".$_SESSION['client_user_guid']."'";
}
require('../../resources/functions.php');
// DB table to use
$table = 'loc_users';
// Table's primary key
$primaryKey = 'user_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
$columns = array(
    array('db' => 'full_name', 'dt' => 0 ),
    array('db' => 'username', 'dt' => 1 ),
    array('db' => 'contact_number', 'dt' => 2 ),
    array('db' => 'email', 'dt' => 3 ),
    array('db' => 'position', 'dt' => 4 ),
    array('db' => 'created_at', 'dt' => 5 ),
    array(
            'db' => 'active', 
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
    array('db' => 'store_id', 'dt' => 7, 'formatter' => function ($d, $row) {
        return ('FBW' . $d);
    })
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
// Output data as json format
echo json_encode(   
    //if($role == "All") {
        //SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns);
    //} else {
        SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=''.$FinalRole.'')
    //}
    # code...    
);

?>

