<body bgcolor="#b8d5e3">
<?php
session_start();

    if(!isset($_SESSION["name"]))
    {
        $_SESSION["msg"]="Please login to access the main page.";
        header("location:/leapstart/errorpage.php");    // Redirects the user to the login page if they are not logged in
    }
    $name=$_SESSION["name"];    // Retrieves the user's name from the Session variable
    $role=$_SESSION["role"];    // Retrieves the user's role from the Session variable          
    $deptno=$_SESSION["deptno"];    // Retrieves the user's department number from the Session variable
    $salary=$_SESSION["salary"];    // Retrieves the user's salary from the Session variable    
    $token=$_SESSION["token"];    // Retrieves the user's access token from the Session variable
?>
<center><h1>LEAPSTART</h1></center>
<div style='float:right; margin-right:5%'>
      Welcome <?php echo $name; ?> | <a href='/leapstart/logout.php' target="_top">Logout</a><br>
        Role: <?php echo $role; ?><br>
        Department Number: <?php echo $deptno; ?><br>
        Salary: <?php echo $salary; ?><br>
        Access Token: <?php echo $token; ?>
</div>