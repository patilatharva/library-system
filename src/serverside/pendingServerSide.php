<?php

    include "../common.php";

    // DB table to use
    $table = "transaction_record";

    /*
    $table = "(SELECT class, name, title, date_borrowed, date_due, DATEDIFF(CURDATE(), date_due) AS days_overdue"
            . " FROM students s, books b, transaction_record t"
            . " WHERE s.srno = t.student_srno AND b.srno = t.book_srno"
            . " AND t.date_returned IS NULL AND CURDATE() > t.date_due) tab";
    */

    // Table's primary key
    $primaryKey = 'transaction_no';
    
    // Array of database columns which should be read and sent back to DataTables.
    // The `db` parameter represents the column name in the database, while the `dt`
    // parameter represents the DataTables column identifier. In this case simple
    // indexes
    $columns = array(
        array( 'db' => 'class', 'dt' => 0 ),
        array( 'db' => 'name', 'dt' => 1 ),
        array( 'db' => 'title', 'dt' => 2 ),
        array('db' => 'date_borrowed', 'dt' => 3),
        array('db' => 'date_due', 'dt' => 4),
        array('db' => 'date_returned', 'dt' => 5),  // days overdue (today - due_date)
    );
    
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    * If you just want to use the basic configuration for DataTables with PHP
    * server-side, there is no need to edit below this line.
    */
    
    require('pendingSSP.php');
    
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
    );

?>
