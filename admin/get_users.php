<?php
session_start();
date_default_timezone_set('Asia/Dhaka');

if($_SESSION['logged_in_user'] == '' || $_SESSION['logged_in_user'] == null){
    header("Location: login.php");
}
$table = 'admin_panel';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
//    array(
//        'db'        => 'RequestTimeDate',
//        'dt'        => 0,
//        'formatter' => function( $d, $row ) {
//            $date = date_create_from_format('d/m/Y H:i:s', $d);
//            $date->add(new DateInterval('PT6H'));
//            $str = $date->getTimestamp();
//            return  date('j M y h:i A', $str);
//        }
//    ),
//    array( 'db' => 'RequestTimeDate', 'dt' => 0 ),
    array( 'db' => 'id',  'dt' => 0 ),
    array( 'db' => 'name',   'dt' => 1 ),
    array( 'db' => 'contact_number',     'dt' => 2 ),
    array( 'db' => 'email',  'dt' => 3 ),
//    array( 'db' => 'sslcom_validation_time',     'dt' => 13,
//        'formatter' => function( $d, $row ) {
//            $oDate = new DateTime($d);
//            return $sDate = $oDate->format("j M y h:i A");
//        }
//    ),
//    array(
//        'db'        => 'RequestTimeDate',
//        'dt'        => 0,
//        'formatter' => function( $d, $row ) {
//            return date( 'jS M y', strtotime($d));
//        }
//    ),
//    array(
//        'db'        => 'salary',
//        'dt'        => 5,
//        'formatter' => function( $d, $row ) {
//            return '$'.number_format($d);
//        }
//    )
);

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'test',
    'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );
$where = "Response ='PaymentApproved'";

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);