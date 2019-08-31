<?php

    include "../common.php";

    // DB table to use
    $table = 'students';
    
    // Table's primary key
    $primaryKey = 'srno';
    
    // Array of database columns which should be read and sent back to DataTables.
    // The `db` parameter represents the column name in the database, while the `dt`
    // parameter represents the DataTables column identifier. In this case simple
    // indexes
    $columns = array(
        array( 'db' => 'srno', 'dt' => 0),
        array( 'db' => 'class', 'dt' => 1),
        array( 'db' => 'name', 'dt' => 2),
        array( 'db' => 'roll_no', 'dt' => 3),
        array('db' => 'date_added', 'dt' => 4),
        array('db' => 'srno', 'dt' => 5),
    );

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    * If you just want to use the basic configuration for DataTables with PHP
    * server-side, there is no need to edit below this line.
    */
    
    require( 'restStudSSP.php' );
    
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
    );

?>
