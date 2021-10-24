<?php require "../config/config.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

    <div class="login">
    <?php 
            if(isset($_SESSION['incorect_details'])){
                echo $_SESSION['incorect_details'];
                unset($_SESSION['incorect_details']);
            }
        ?>

<?php 
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>

        <h1 class="text-center">Login Page</h1>
        <form class="text-center" action="" method="post">
            <div class="username">
                <label for="">Username</label>
                <input type="text" name="username" id="">
            </div>

            <div class="password">
                <label for="">Password</label>
                <input type="password" name="password" id="">
            </div>
                <div class="submit">
                    <input type="submit" name="submit" class="btn-secondary2" value="Login">
                </div>
        </form>
       
    </div>

    <p class="text-center">Created by  <a href="www.temitope-portfolio.netlify.app"> TemzyCode</a></p>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        // Process of login
        //1. get data from the form
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($con, $raw_password);

        // 2. Create query to check whether the username and the password exist
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

        // 3. Execute the query
        $res = mysqli_query($con, $sql);

        // check if the query is exdecuted or not
        if($res){
            // count rows to check if the user exist or not
            $count = mysqli_num_rows($res);

            //it means one users in the row
            if($count==1){
                // display the username
                $_SESSION['username'] = $username; //this is to check whether the user is login or not
                // display the success login message
                $_SESSION['login'] = "<div class='success'>login successfully</div>";
                // Redirect to the user page
                header("location:".SITEURL.'admin/index.php');

            } else {
    
                // display the incorrect message
                $_SESSION['incorect_details'] = "<div class='error'>Incorrect Username or password</div>";
                // Redirect to the login page
                header("location:".SITEURL.'admin/login.php');
            }
        }
    }
?>