<?php require "../config/config.php"; ?>

<?php 
        if(isset($_GET['id']) AND isset($_GET['image_name'])){

            // Get the id and image name of the deleted the category
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];

            // 1. Remove image Process

            // remove the image to be deleted
            if($image_name !=""){
                // image is available so remove it
                $path = "../images/category/".$image_name;

                // Remove the image
                $remove = unlink($path); // this function remove the image inside the path folder

                // if failed to remove the image add an error message and stop the process
                if($remove==false){
                    // display the mesage
                 $_SESSION['remove'] = "<div class='error'> Failed to remove image</div>";
                //  Redirect to manage category
                 header("location".SITEURL.'admin/manage-category.php');
                 die();
                }
            }
            
    // 2. Delete Process

    // Create the sql delete
    $sql = "DELETE FROM tbl_category WHERE id = $id";

    // Execute the Query
    $res = mysqli_query($con,$sql);

    // check if the query is executed or not
    if($res){
    //   echo "deleted";
    // Display the session message
        $_SESSION['delete-category'] = "<div class='success'> Category Deleted Successfully</div>";
        // rediret to manage category
        header("location:".SITEURL.'admin/manage-category.php'); 
    } else {
        // echo "Not deleted";
         // Display the session message
         $_SESSION['delete-category'] = "<div class='error'> Failed to delete</div>"; 
       // rediret to manage category
        header("location:".SITEURL.'admin/manage-category.php'); 
    }

        } else{
            $_SESSION['delete-category'] = "<div class='error'> Failed to delete</div>"; 
            // rediret to manage category
             header("location:".SITEURL.'admin/manage-category.php'); 
        }


?>