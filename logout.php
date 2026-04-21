<?php
session_start();    
session_destroy();   // Destroys the Session object and clears all session values
header("location:/leapstart");    // Redirects the user to the login page after
?>