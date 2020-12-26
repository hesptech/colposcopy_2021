<?php

    require_once ('mysqli_connect.php'); // Connect to the db.


    $query = "SELECT * FROM codici ORDER BY acc_cod";
    $result = mysqli_query ($link, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $json_array[] = $row;
        }
    }

    /* echo '<pre>';
    print_r($json_array);
    echo '</pre>'; */

    header('Content-Type: application/json'); 
    echo json_encode($json_array);
?>
