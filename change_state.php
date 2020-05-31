<?php
    include_once("functions/functions.php");
    session_start();

    $new_state = $_GET['new_state'];

    f_change_state( $_SESSION['o_num'], $new_state );
    header("Location: index.php?s=task&task=".$_SESSION['o_num']."#");
?>