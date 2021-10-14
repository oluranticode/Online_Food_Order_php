<?php require "../partials/header.php"; ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <?php
        if(isset($_SESSION['No-Food'])){
            echo $_SESSION['No-Food'];
            unset($_SESSION['No-Food']);
        }
        ?>
        <br>
        <?php 
            if($_GET['id']){
                $id = $_GET['id'];

                // create query to fecth data from the database
                $sql = "SELECT * FROM tbl_food WHERE id=$id";

                // execute the query
                $res = mysqli_query($con, $sql);
                if($res){
                    // count the number of rows in the table
                    $count = mysqli_num_rows($res);

                    // check if there is any rows in the result table
                    if($count==1){
                        // fetch data from the database
                        $row = mysqli_fetch_assoc($res);

                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $current_image = $row['image_name'];
                        $current_category = $row['category_id'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    } else {
                        // 
                    }
                }
            } else {
                // redirect to manage food 
                header("location:".SITEURL.'admin/manage-food.php');
            }
        ?>

<form action="" method="post" enctype="multipart/form-data">
                    <table>

                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>" id=""></td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td><textarea class="textarea" name="description" value="" cols="20" row="6" id=""><?php echo $description; ?></textarea> </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td><input type="number" value="<?php echo $price; ?>" name="price" id=""></td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                                <?php 
                                        if($current_image!=""){
                                            // display image
                                            ?>
                                            <img src="<?php echo SITEURL; ?>/images/food/<?php echo $current_image; ?>" width="100" alt="">
                                            <?php
                                        } else {
                                            echo "<div style='color:red'>No image found</div>";
                                        }
                                ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image</td>
                        <td><input type="file" name="image" id=""></td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td><select name="category" id="">
                        <?php 
                                // Create Php code to display categories from the category-table database
                                // 1. Create Sql to get all active categories from the database
                                $sql2 = "SELECT * FROM tbl_category WHERE active ='Yes' ";
                                // execute query
                                $res2 = mysqli_query($con, $sql2);

                                // count rows to check if we have categories or not
                                $count2 = mysqli_num_rows($res2);

                               // if the number of category is greater thn 0, do this
                                if($count2>0){
                                    // We have Category                                 

                                    while($row2 = mysqli_fetch_assoc($res2)){
                                        $cat_id = $row2['id'];
                                        $cat_title = $row2['title'];
                                        ?>
                                         <option <?php if($current_category == $cat_id){ echo "selected"; } ?> value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
                                        <?php
                                    }
                                
                                }else {
                                    // We do not have category
                                    ?>
                                     <option value="0">No Food is Available </option>
                                    <?php
                                }

                                // 2. Display on dropdown
                        ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                                <td>Featured</td>
                                <td>
                                    <input type="radio" <?php if($featured=="Yes"){echo "checked";} ?> name="featured" value="Yes" id="">Yes
                                    <input type="radio" <?php if($featured=="No"){echo "checked";} ?> name="featured" value="No" id="">No
                            </td>
                            </tr>

                            <tr>
                                <td>Active</td>
                                <td>
                                    <input type="radio" <?php if($active=="Yes"){echo "checked";} ?> name="active" value="Yes" id="">Yes
                                    <input type="radio" <?php if($active=="No"){echo "checked";} ?> name="active" value="No" id="">No
                            </td>
                            </tr>
                    <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>" >
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" class="btn-secondary2" name="submit" value="Update Food">
                    </td>
                         </tr>
                    </table>
                </form>
            <?php 
                if(isset($_POST['submit'])){
                    // Get data from the form 
                 $id = $_POST['id'];
                 $title = $_POST['title'];
                 $description = $_POST['description'];
                 $price = $_POST['price'];
                 $current_image = $_POST['current_image'];
                 $featured = $_POST['featured'];
                 $active = $_POST['active'];
                 $category = $_POST['category'];

                        // Update the new image
                   if(isset($_FILES['image']['name'])){
                    // get the details
                    $image_name = $_FILES['image']['name'];

                    // if image is Available
                    if($image_name!=""){
                   
                    // 1. Upload the new image

                    // Get the extension of our image (jpg, png, jpeg, gf, e.t.c) e.g food.jpg
                    // seperate the image name from the extension name 
                    $ext = end(explode('.', $image_name));

                    // Rename the Image
                    // If the same image is selected it will automatically rename it and safe it in the folder
                    $image_name = "food_image_".rand(000, 999).'.'.$ext; // food_category_756.jpg

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/food/".$image_name;

                    // finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
                   
                    // check whether the image is uploaded or not
                    // And if the image is not uploaded we will stop the process and redirect with error message
                    if($upload==FALSE){
                        $_SESSION['image-food-upload'] = "<div class='error'>Failed to upload Image</div>";
                        // redirect to add-category page
                        header("location:".SITEURL.'admin/manage-food.php');
                        die();
                    }
                   

                        // 2. Remove the current Image 

                        if($current_image != ""){
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);
                            // check whether the image is remove 
                            // if failed to remove image, display message and stop the process
    
                            if($remove==FALSE){
                                $_SESSION['image-food-remove'] = "<div class='error'>Failed to remove Image</div>";
                                // redirect to add-food.php page
                                header("location:".SITEURL.'admin/manage-food.php');
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

                // 2. Update the value from the form into the database
                // create query to update
                $sql3 = "UPDATE tbl_food SET 
                title = '$title',
                description = '$description',
                price = '$price',
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active' WHERE id = $id            
                "; 
                 // execute query
                 $res3 = mysqli_query($con, $sql3);
                 
                 if($res3){
                    //  Display Message and Redirect to the food page
                    $_SESSION['update-food'] = "<div class='success'>Food Updated Successfully</div>";
                        header("location:".SITEURL.'admin/manage-food.php');
                     } else {
                        $_SESSION['update-food'] = "<div class='error'>Failed to Update Food<div>";
                        header("location:".SITEURL.'admin/manage-food.php');
                     }
                
                                } 
                //                 else {
                //     // Display message on the updated page
                //    $_SESSION['No-Food'] = "<div class='error'>No Data found!</div>";
                //     header("location:".SITEURL.'admin/update-food.php');
                // }

              
            ?>
    </div>
</div>

<?php require "../partials/footer.php"; ?>