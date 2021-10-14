<?php 
include "../partials/header.php";

if(isset($_GET['id'])){
    // echo $_GET['id'];

    // Get the Data
    $id = $_GET['id'];
    // creating the query to select all data from table 
    $sql = "SELECT * FROM tbl_category WHERE id=$id";

    // execute the query
    $res = mysqli_query($con, $sql);

    // to check if the query is executed or not
        if($res){
            // count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);
            if($count==1){
                $row = mysqli_fetch_assoc($res);
                // getting the individual data from the database
                $id = $row['id'];
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                // display message
                $_SESSION['update-category'] = "<div class='error'>No category found</div>";
                // redirect...
                header("location:".SITEURL.'admin/manage-category.php');
            }
        } 
} else {
    // redirect to the manage-category
    header("location:".SITEURL.'admin/manage-category.php');
}
?>

    <div class="wrapper">
        <div class="content">
            <h1>Update Category</h1>
            <br><br>

            <form action="" method="post" enctype="multipart/form-data">
                    <table class="tbl-30">
                            <tr>
                                <td>Title:</td>
                                <td><input type="text" name="title" id="" value="<?php echo $title; ?>"></td>
                            </tr>

                            <tr>
                                <td>Current Image</td>
                                <td>  
                            <?php 
                                if($current_image!=""){
                                        ?>
                                        <!-- display image -->
                                        <img src="<?php echo SITEURL ?>images/category/<?php echo $current_image; ?>" width="100px" >
                                        <?php
                                } else {
                                        // display message image not added
                                        echo "<div style='color: red;' class=''> Image Not added </div>";
                                }
                                ?> 
                                </td>
                            </tr>


                            <tr>
                                <td>New Image</td>
                                <td><input type="file" name="image" id=""></td>
                            </tr>

                            <tr>
                                <td>Featured</td>
                                <td>
                                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes" id="">Yes
                                    <input  <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No" id="">No
                            </td>
                            </tr>

                            <tr>
                                <td>Active</td>
                                <td>
                                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes" id="">Yes
                                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No" id="">No
                            </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <input type="hidden" name="image_name" value="<?php echo $current_image; ?>">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="submit" name="submit" value="Update Category" class="btn-secondary2">
                                </td>
                            </tr>
                    </table>
            </form>

            <?php 
             
             if(isset($_POST['submit'])){
                 // Get data from the form 
                 $id = $_POST['id'];
                 $title = $_POST['title'];
                 $current_image = $_POST['image_name'];
                 $featured = $_POST['featured'];
                 $active = $_POST['active'];

                // Update the new image
                if(isset($_FILES['image']['name'])){
                    // get the details
                    $image_name = $_FILES['image']['name'];

                    if($image_name!=""){
                        // image Available

                        // 1. Upload the new image

                    // Get the extension of our image (jpg, png, jpeg, gf, e.t.c) e.g food.jpg
                    // seperate the image name from the extension name 
                    $ext = end(explode('.', $image_name));

                    // Rename the Image
                    // If the same image is selected it will automatically rename it and safe it in the folder
                    $image_name = "food_image_".rand(000, 999).'.'.$ext; // food_category_756.jpg

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/".$image_name;

                    // finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // check whether the image is uploaded or not
                    // And if the image is not uploaded we will stop the process and redirect with error message
                    if($upload==FALSE){
                        $_SESSION['image-upload'] = "<div class='error'>Failed to upload Image</div>";
                        // redirect to add-category page
                        header("location:".SITEURL.'admin/manage-category.php');
                        die();
                    }

                        // 2. Remove the current Image 

                        if($current_image != ""){
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
                            // check whether the image is remove 
                            // if failed to remove image, display message and stop the process
    
                            if($remove==FALSE){
                                $_SESSION['image-remove'] = "<div class='error'>Failed to remove Image</div>";
                                // redirect to add-category page
                                header("location:".SITEURL.'admin/manage-category.php');
                                die();
                            }
                        }
                       
                    } else {
                        $image_name = $current_image;
                    }
                } else {
                    $image_name = $current_image;
                }

                // ........End of the update new image

                //  Update the data into the database
                $sql2 = "UPDATE tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active' Where id=$id ";
                 
                // Execute the query
                $res2 = mysqli_query($con, $sql2);

                // to check if the query is executed or not
                if($res2){
                    // redirect and message
                    $_SESSION['Update-category-message'] = "<div class='success'> category has been updated </div>";
                    // redirect to manage category message
                    header("location:".SITEURL.'admin/manage-category.php');
                } else {
                     // redirect and message
                     $_SESSION['Update-category-message'] = "<div class='error'> fail to update category </div>";
                     // redirect to manage category message
                     header("location:".SITEURL.'admin/manage-category.php');
                }

             }

            ?>

        </div>
    </div>

    <?php include "../partials/footer.php";?>