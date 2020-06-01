<?php
    include("include/db.php");
    include("include/session.php");
    $idfromurl = $_GET['id'];
    $deleteadmin = mysqli_query($con, "DELETE FROM registration WHERE id='$idfromurl'");
    if($deleteadmin)
    {
        $_SESSION['successmessage'] = "Admin Deleted Successfully";
        header("Location:admins.php");
        exit(); 
    }
    else{
        $_SESSION['errormessage'] = "Something Went Wrong";
        header("Location:admins.php");
        exit();
    }
?>