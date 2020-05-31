<?php 

    define('UI_PUBLIC_DIR',__DIR__);

    include( UI_PUBLIC_DIR.'\..\functions\functions.php');
    session_start();
    //var_dump( $_SESSION );

    if( !isset( $_SESSION["state"] ) ){

        $_SESSION["state"] = "login";
    }
    else if( isset( $_GET['s'] ) && $_SESSION['state'] != 'login' ){

        $_SESSION['state'] = $_GET['s'];
    }

    show_page();
?>