<?php
    include("include/db.php");
    include("include/session.php");
    $idfromurl = $_GET['id'];
    $approve = mysqli_query($con, "DELETE FROM comment WHERE id='$idfromurl'");
    if($approve)
    {
        $_SESSION['successmessage'] = "Comment Deleted Successfully";
        header("location:comment.php");
        exit();
    }
    else{
        $_SESSION['errormessage'] = "Something Went Wrong";
        header("location:comment.php");
        exit();
    }
?>
