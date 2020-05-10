<?php 
    include("functions/functions.php");
    session_start();
    echo var_dump( $_SESSION );

    if( !isset( $_SESSION["state"] ) ){
        $_SESSION["state"] = "subjects";
    }
    show_page( $_SESSION["state"] );
?>