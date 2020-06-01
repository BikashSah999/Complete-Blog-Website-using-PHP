<?php
    include("include/db.php");
    include("include/session.php");
    include("include/function.php");
    $idfromurl = $_GET['id'];
    $Adminname = $_SESSION['Adminname'];
    $approve = mysqli_query($con, "UPDATE comment SET status='ON', approvedby='$Adminname' WHERE id='$idfromurl'");
    if($approve)
    {
        $_SESSION['successmessage'] = "Comment Approved Successfully";
        header("location:comment.php");
        exit();
    }
    else{
        $_SESSION['errormessage'] = "Something Went Wrong";
        header("location:comment.php");
        exit();
    }
?>
