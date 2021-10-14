<?php 
require "../partials/header.php";
?>


    <div class="main-content">
        <div class="wrapper">
            <h1>ADD ADMIN</h1>
            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" id=""></td>
                    </tr>

                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" id=""></td>
                    </tr>

                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" id=""></td>
                    </tr>

                    <td>
                        <input type="submit" class="btn-secondary2" name="submit" value="Add Admin">
                    </td>
                     </table>
            </form>
        </div>
    </div>
<?php 
require "../partials/footer.php";
?>

<?php
    if(isset($_POST['submit'])){
        // 1. get the data from the form
        $fullname = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption

        // 2. SQL Query to save the data into the database
        $sql = "INSERT INTO tbl_admin (fullname, username, password) VALUES ('$fullname', '$username', '$password')";

        //3.Executing query and saving data into the database
        $res = mysqli_query($con, $sql);

        //4. check whether the (Query is executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //echo "Inserted";
            
            // create a session variable to display the message
               $_SESSION['Add'] = "<div class='success'>Admin Added Successfully</div>";
            header("location:".SITEURL.'admin/manage-admin.php');

        } else {
           // echo "Not inserted;
            // create a session variable to display the message
            $_SESSION['Add'] = "<div class='error'>Failed to add Admin</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
                             
        }  
    }

?>