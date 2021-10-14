<?php 

   
    // Authorization-access control

    // Check whether the user is logged in or out
    if(!isset($_SESSION['username'])) // if this user session is not set
    {
            // user not log in
            $_SESSION['no-login-message'] = "<div class='error'>Please Login Your details to access admin panel</div>";
            // redirect to login page
           header("location:".SITEURL.'admin/login.php');
    } 
?>