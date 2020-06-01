<?php
    include("include/db.php");
    include("include/session.php");
    $idfromurl = $_GET['id'];
    $deletecategory = mysqli_query($con, "DELETE FROM category WHERE id='$idfromurl'");
    if($deletecategory)
    {
        $_SESSION['successmessage'] = "Category Deleted Successfully";
        header("location:category.php");
        exit();
    }
    else{
        $_SESSION['errormessage'] = "Something Went Wrong";
        header("location:category.php");
        exit();
    }
?>
