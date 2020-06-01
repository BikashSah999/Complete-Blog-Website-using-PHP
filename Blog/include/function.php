<?php
function login()
{
    if(isset($_SESSION['Adminname']))
    {
        return true;
    }
}
function confirmlogin()
{
    if(!login())
    {
        header("Location:login.php");
    }
}
?>