<?php
    include("include/db.php");
    include("include/session.php");
    $idfromurl = $_GET['id'];
    $approve = mysqli_query($con, "UPDATE comment SET status='OFF', approvedby='Pending' WHERE id='$idfromurl'");
    if($approve)
    {
        $_SESSION['successmessage'] = "Comment Disapproved Successfully";
        header("location:comment.php");
        exit();
    }
    else{
        $_SESSION['errormessage'] = "Something Went Wrong";
        header("location:comment.php");
        exit();
    }
?>
