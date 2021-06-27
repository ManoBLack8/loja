<?php 
    session_start();
    session_destroy();
    header('Location:../Encontrei lá/login.php');
?>