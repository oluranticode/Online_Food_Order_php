<?php 
// $con = mysqli_connect("localhost", "root", "root1234", "food_order") or die(mysqli_connect_error());

    // start session
    session_start();
    // Creating constant.....
    
define('SITEURL', 'http://localhost/php-projects/food/');    
define('LOCALHOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'food_order');

$con = mysqli_connect(LOCALHOST, USERNAME, PASSWORD, DB_NAME) or die(mysqli_connect_error());
?>