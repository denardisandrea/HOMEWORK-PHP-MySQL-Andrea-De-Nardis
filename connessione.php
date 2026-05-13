<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "Andrea.DeNardis.PHP-MySQL";
    $conn = "";

    $conn = mysqli_connect(
        $db_server,
        $db_user,
        $db_pass,
        $db_name
    );

    mysqli_set_charset($conn, "utf8");

    if($conn){
        echo "";
    }else{
        echo "ERRORE DATABASE";
    }
?>
