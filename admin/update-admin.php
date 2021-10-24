<?php 
require "../partials/header.php";
?>
    <div class="main-content">
        <div class="wrapper">
            <h1>UPDATE ADMIN</h1>

            <?php 
                
                //1. Get the id of the selected admin
                $id = $_GET['id'];
                // 2. Create the query 
                    $sql = "SELECT * FROM tbl_admin WHERE id=$id"; 
                // 3. Execute the query
                    $res = mysqli_query($con, $sql);
                // 4. check if the query was executed or not
                if($res){
                   
                    $count = mysqli_num_rows($res);
                    if($count==1){
                        $row=mysqli_fetch_assoc($res);
                              // getting the individual data from the database
                             $id = $row['id'];
                             $fullname = $row['fullname'];
                             $username = $row['username'];

                    } else {
                        // Redirect to manage admin
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                }
            ?>
            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" id="" value="<?php echo $fullname; ?>" ></td>
                    </tr>

                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" id=""  value="<?php echo $username; ?>"></td>
                    </tr>

                        <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" class="btn-secondary2" name="submit" value="Update Admin">
                    </td>
                    </tr>

                     </table>
            </form>
        </div>
    </div>

                <?php 
                   // Update data into the table
                   if(isset($_POST['submit'])){
                    //    getting all the values in the database
                    $id = $_POST['id'];
                    // $fullname = $_POST['full_name'];
                    // $username = $_POST['username'];

                    $fullname = mysqli_real_escape_string($con, $_POST['full_name']);
                    $username = mysqli_real_escape_string($con, $_POST['username']);

                    //Create query to update data in the table 
                    $sql_update = "UPDATE tbl_admin SET fullname='$fullname', username='$username' WHERE id=$id ";

                    // execute the query
                    $res_update = mysqli_query($con, $sql_update);
                        if($res_update){
                            // echo "Updated";
                            // display message
                            $_SESSION['update'] = "<div class='success'> Admin Updated </div>";
                            // Redirect to manage admin
                                header("location:".SITEURL.'admin/manage-admin.php');
                        } else {
                             // display message
                            $_SESSION['update'] = "<div class='error'> Failed to Updated </div>";
                            // Redirect to manage admin
                                header("location:".SITEURL.'admin/manage-admin.php');
                        }
                }
                ?>

<?php 
require "../partials/footer.php";
?>