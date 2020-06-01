<?php
session_start();
function errormessage(){
    if(isset($_SESSION['errormessage'])){
        $output = $_SESSION['errormessage'];
        $_SESSION['errormessage'] = null;
        return $output;
    }
}

function successmessage(){
    if(isset($_SESSION['successmessage'])){
        $output = $_SESSION['successmessage'];
        $_SESSION['successmessage'] = null;
        return $output;
    }
}

?>