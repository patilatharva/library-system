<?php

    $user_id = $_POST['user_id'];

    include "../common.php";

    // DB table to use
    $table = 'users';
    
    // Table's primary key
    $primaryKey = 'user_id';
    
    // Array of database columns which should be read and sent back to DataTables.
    // The `db` parameter represents the column name in the database, while the `dt`
    // parameter represents the DataTables column identifier. In this case simple
    // indexes
    $columns = array(
        array( 'db' => 'user_id', 'dt' => 0 ),
        array( 'db' => 'username', 'dt' => 1 ),
        array( 'db' => 'email', 'dt' => 2 ),
        array( 'db' => 'access', 'dt' => 3 ),
        array('db' => 'date_added', 'dt' => 4),
        array('db' => 'user_id', 'dt' => 5),
        array('db' => 'user_id', 'dt' => 6)
    );
    

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    * If you just want to use the basic configuration for DataTables with PHP
    * server-side, there is no need to edit below this line.
    */
    
    require( 'userSSP.php' );
    
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $user_id )
    );

?>
