<?php 
require "../partials/header.php";
?>

     <!-- main content starts -->
     <div class="main-content">
        <div class="wrapper" >
        <h1>MANAGE ADMIN</h1>
        <br>

                <?php
                if(isset($_SESSION['Add']))
                {
                        echo $_SESSION['Add']; //display session message;
                        unset($_SESSION['Add']); //Removing session message; 
                }

                if(isset($_SESSION['delete']))
                {
                        echo $_SESSION['delete']; //display session message;
                        unset($_SESSION['delete']); //Removing session message; 
                }

                if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                }

                if(isset($_SESSION['password'])){
                        echo $_SESSION['password'];
                        unset($_SESSION['password']);
                }
                
                if(isset($_SESSION['password_not_match'])){
                        echo $_SESSION['password_not_match'];
                        unset($_SESSION['password_not_match']);
                }

                if(isset($_SESSION['password']) && isset($_SESSION['password_not_match'])){
                        echo $_SESSION['password'];
                        unset($_SESSION['password']);
                        echo $_SESSION['password_not_match'];
                        unset($_SESSION['password_not_match']);
                }

                if(isset($_SESSION['password_change'])){
                        echo $_SESSION['password_change'];
                        unset($_SESSION['password_change']);
                }


                ?>
                  <br>  <br>  <br>
  
        <!-- Button Add Admin -->
        <a class="btn-primary" href="add-admin.php">ADD ADMIN</a>
        <br>
        <table class="tbl-full">
                <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                </tr>

                <?php 
                // query to all admin
                $sql = "SELECT * FROM tbl_admin ORDER BY id DESC";

                // execute the query
                $res = mysqli_query($con, $sql);
                
                // check whether the query is executed or not
                if($res==TRUE){
                        // count rows whether we have data in database or not
                        $count = mysqli_num_rows($res); // function to count the number of rows in the table
                        $sn = 1; // assign a value each row in an increament form

                        if($count>0){
                                // loop the result
                                while($row = mysqli_fetch_array($res)){
                                     // using loop to get the data from the database 

                                // getting the individual data from the database
                                  $id = $row['id'];
                                  $fullname = $row['fullname'];
                                  $username = $row['username'];

                                 ?>
                                
                                <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $fullname; ?></td>
                        <td><?php echo $username; ?></td>
                        <td><a class="btn-secondary1" href="<?php echo SITEURL ?>admin/update-admin.php?id=<?php echo $id; ?>">Update Admin</a>
                        <a class="btn-secondary3" href="<?php echo SITEURL ?>admin/change-password.php?id=<?php echo $id; ?>">Change Password</a>
                        <a class="btn-secondary2" href="<?php echo SITEURL ?>admin/delete-admin.php?id=<?php echo $id; ?>">Delete Admin</a></td>
                         </tr>

                                  <?php

                                }
                            
                        }
                        else
                        {

                        }
                }
                ?>

        
        </table>
        
        </div>  
</div>
        <!-- main content ends -->

        <?php 
require "../partials/footer.php";
?>