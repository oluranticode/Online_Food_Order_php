<?php require "../config/config.php"; ?>

<?php require "login-check.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order Admin </title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <!-- menu section starts -->
    <div class="menu">
        <div class="wrapper" >
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="manage-admin.php">Admin</a></li>
            <li><a href="manage-category.php">Category</a></li>
            <li><a href="manage-food.php">Food</a></li>
            <li><a href="manage-order.php">Order</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><?php if(isset($_SESSION['username'])){
                echo "Hi,". " ". $_SESSION['username']; 
            } ?></li>
        </ul>
        </div>
    </div>
    <!-- menu section end -->