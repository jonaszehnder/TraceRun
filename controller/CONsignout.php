<?php 
    session_start();
    unset($_SESSION['username']) ;
    unset($_SESSION['email']);
    unset($_SESSION['id']);
    header("Location: ../view/index.php")
?>




