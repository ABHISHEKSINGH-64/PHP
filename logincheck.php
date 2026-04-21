<?php
session_start();    // Starts the Session object for storing session values
include("functions.php");    // Includes the functions.php file for using the functions defined in it

    $uname=$_POST['t1'];
    $pass=$_POST['t2'];

    if($uname!="" && $pass!="")
    {
        if($uname=="admin" && $pass=="admin")
        {
            $_SESSION["name"]="Venu Goly";
            $_SESSION["role"]="Developer";
            $_SESSION["deptno"]=10;
            $_SESSION["salary"]=50000;  
            $_SESSION["token"]=getAccessToken(50);    // Generates a random access token using the getAccessToken function and stores it in the Session variable

            header("location:mainpage.php");
        }
        else
        {
            $_SESSION["msg"]="Invalid Username/Password are entered. Please try again.";
            header("location:errorpage.php");
        }
    }
    else
    {
        $_SESSION["msg"]="Username/Password cannot be empty";
        header("location:errorpage.php");
    }
?>