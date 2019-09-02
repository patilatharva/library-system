<?php

include '../common.php';
$conn = connect_db(); 

$cutoff = date("Y-m-01");
$cutoff = date('Y-m-d', strtotime('-10 months', strtotime($cutoff))); 


for($i=0; $i<12; $i++) {
    $sql .= "SELECT DATE_FORMAT(DATE_SUB('$cutoff', INTERVAL 1 MONTH), '%b %Y'), COUNT(*) 
            FROM books WHERE date_added <= '$cutoff' AND display = 1; ";
    $cutoff = date('Y-m-d', strtotime('+1 months', strtotime($cutoff)));
}

if (mysqli_multi_query($conn, $sql)){
    $data = array();

    do{
        if ($result=mysqli_store_result($conn)){

            while ($row=mysqli_fetch_row($result)){
                $row[1] = ($row[1] == ""? "0" : $row[1]);
                $data[] = array("month" => $row[0], "copies" => $row[1]);
            }
            mysqli_free_result($conn);
        }
    }while (mysqli_next_result($conn));
}

mysqli_close($conn);

echo json_encode($data);

?>