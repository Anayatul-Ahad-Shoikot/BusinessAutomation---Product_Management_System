<?php
    session_start();
    unset($_SESSION['warehouse_code']);
    unset($_SESSION['user_id']);
    session_unset();
    session_destroy(); 
    header("Location: ../index.php"); 
?>
