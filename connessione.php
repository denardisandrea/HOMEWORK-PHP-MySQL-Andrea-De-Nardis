<?php
  require_once('dati_generali.php');

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