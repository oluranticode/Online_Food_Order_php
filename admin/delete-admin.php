<?php 
    // include the database configuration
    include "../config/config.php";

    // 1. Get the id admin to be deleted
   echo $id = $_GET['id'];

    // 2. Create sql to delete the admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // 3. Execute the query
        $res = mysqli_query($con, $sql);

        // check whether query is executed or not
        if($res){
           
            // redirecting back to the manage admn page
           header("location:".SITEURL.'admin/manage-admin.php');
            // display the success message
            $_SESSION['delete'] = "<div class='delete'>Admin Deleted Successfully</div>";

        } else {
             // redirecting back to the manage admn page
           header("location:".SITEURL.'admin/manage-admin.php');
           // display the success message
           $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try again!</div>";
        }

    // 4. Redirect to Manage Admin page with Message (success/error)

?>