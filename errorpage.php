
<center>
<?php
session_start();

if(isset($_SESSION["msg"]))
{
    echo $_SESSION["msg"];  // Displays the error message stored in the Session variable
    unset($_SESSION["msg"]);    // Clears the Session variable after displaying the message 
}
?>


<br><br>
Click Here to <a href="/leapstart">Login</a>
</center>