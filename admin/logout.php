<?php 
    include "../config/config.php";
    // 1. Destroy all the session
        session_destroy(); // this will unset any user info

        // 2. Redirect to login page
        header("location:".SITEURL.'admin/login.php');
?>