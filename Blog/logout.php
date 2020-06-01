<?php
    include("include/session.php");
    include("include/function.php");
    $_SESSION['Adminname'] = null;
    session_destroy();
    header("Location:login.php");
    exit();
?>