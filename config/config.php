<?php 
// $con = mysqli_connect("localhost", "root", "root1234", "food_order") or die(mysqli_connect_error());

    // start session
    session_start();
    // Creating constant.....
    
define('SITEURL', 'http://localhost/php_projects/food/');    
define('LOCALHOST', 'localhost');
define('ROOT', 'root');
define('ROOT1234', 'root1234');
define('DB_NAME', 'food_order');

$con = mysqli_connect(LOCALHOST, ROOT, ROOT1234, DB_NAME) or die(mysqli_connect_error());
?>