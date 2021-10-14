<?php 
require "../partials/header.php";
?>
    <div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>
        <form action="" method="post">

            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
            ?>

            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" id="" placeholder="Current Password"></td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" id="" placeholder="New Password"></td>
                </tr>
               
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" id="" placeholder="Confirm Password"></td>
                </tr>
               
                <tr>
                   <td> <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" class="btn-secondary2"  name="submit" value="Change Password"></td>
                </tr>

            </table>
        </form>
    </div>
    </div>
                <?php 
                        if(isset($_POST['submit'])){
                            // 1. Get the data from the form
                                $id = $_POST['id'];
                                $current_password = md5($_POST['current_password']);
                                $new_password = md5($_POST['new_password']);
                                $confirm_password = md5($_POST['confirm_password']);

                            // 2. Check whether the user with current id and password exist or not
                            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
                            // Execute the query
                            $res = mysqli_query($con, $sql);
                            // check if the password is exist or not
                            if($res){
                            //    count the number of row in the result data
                                $count = mysqli_num_rows($res);
                                // fetch the result
                                if($count==1){
                                
                                //  password exist and password can be change
                               

                                    if($new_password==$confirm_password){
                                        // update the password
                                        $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id ";

                                        // execute the query
                                        $res2 = mysqli_query($con, $sql2);
                                        // check whether it been update 
                                        if($res2){
                                            // display the success message
                                            $_SESSION['password_change'] = "<div class='success'>Password Successfully changed</div>";
                                            // redirect the user to the manage admin page
                                            header("location:".SITEURL.'admin/manage-admin.php');
                                        } else {
                                            // display the error message
                                            $_SESSION['password_change'] = "<div class='error'>Password Failed to change</div>";
                                            // redirect the user to the manage admin page
                                            header("location:".SITEURL.'admin/manage-admin.php');
                                        }

                                      } else {
                                        //  display message password does not match
                                $_SESSION['password_not_match'] = "<div class='error'>password did not match</div>";
                                // redirect the user to the manage admin page
                                header("location:".SITEURL.'admin/manage-admin.php');
                                        echo "<script>alert('password did not match')</script>";
                                    }

                                } else {
                                 $_SESSION['password'] = "<div class='error'>password does not exist</div>";
                                 // redirect the user to the manage admin page
                                 header("location:".SITEURL.'admin/manage-admin.php');
                                }
                               
                            } 

                            // 3. check whether the current password and the new password match

                            // 4. change password if all above is true
                        }
                ?>

<?php 
require "../partials/footer.php";
?>
