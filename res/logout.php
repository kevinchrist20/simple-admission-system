<?php
    session_start();
    require_once("../inc/handler.php");

    if(check_user_session('serial_no')) {
        unset($_SESSION['serial_no']);
        session_unset();
        session_destroy();
        header('Location: ../index.php');
        exit();
    } 
    
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit();
?>