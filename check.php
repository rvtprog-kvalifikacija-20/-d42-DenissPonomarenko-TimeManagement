<?php
    include_once("functions/functions.php");
    if( isset($_POST["login"] ) && isset($_POST["password"] ) ){
        
        session_start();
        $_SESSION["last_login"] = $_POST["login"];
        $_SESSION["login_error"] = login_validation( $_POST["login"], $_POST["password"] );

        if( isset( $_SESSION["login_error"] ) ){
            $_SESSION["state"] = "login";
        }else{
            $_SESSION["state"] = "projects";
        }
        header( "Location: index.php" );
    }
?>