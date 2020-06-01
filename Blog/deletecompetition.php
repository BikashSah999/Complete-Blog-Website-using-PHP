<?php
    include("include/db.php");
    include("include/session.php");
    $idfromurl = $_GET['id'];
    $deleteadmin = mysqli_query($con, "DELETE FROM contest WHERE id='$idfromurl'");
    if($deleteadmin)
    {
        $_SESSION['successmessage'] = "Competition Deleted Successfully";
        header("Location:addcompetition.php");
        exit(); 
    }
    else{
        $_SESSION['errormessage'] = "Something Went Wrong";
        header("Location:addcompetition.php");
        exit();
    }
?>