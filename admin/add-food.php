<?php
include('../partials/header.php');
 ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <?php 
                if(isset($_SESSION['food-image'])){
                    echo $_SESSION['food-image'];
                    unset($_SESSION['food-image']);
                } ?>
            <br><br>
                <form action="" method="post" enctype="multipart/form-data">
                    <table>

                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" id=""></td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td><textarea class="textarea" name="description" cols="20" row="6" id=""></textarea> </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td><input type="number" name="price" id=""></td>
                    </tr>

                    <tr>
                        <td>Image:</td>
                        <td><input type="file" name="image" id=""></td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td><select name="category" id="">
                        <?php 
                                // Create Php code to display categories from the category-table database
                                // 1. Create Sql to get all active categories from the database
                                $sql = "SELECT * FROM tbl_category WHERE active ='Yes' ";
                                // execute query
                                $res = mysqli_query($con, $sql);

                                // count rows to check if we have categories or not
                                $count = mysqli_num_rows($res);

                               // if the number of category is greater thn 0, do this
                                if($count>0){
                                    // We have Category
                                    

                                    while($row = mysqli_fetch_assoc($res)){
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                         <option value="<?php echo $title; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                        
                                }else {
                                    // We do not have category
                                    ?>
                                     <option value="0">No Category Found</option>
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
                                    <input type="radio" name="featured" value="Yes" id="">Yes
                                    <input type="radio" name="featured" value="No" id="">No
                            </td>
                            </tr>

                            <tr>
                                <td>Active</td>
                                <td>
                                    <input type="radio" name="active" value="Yes" id="">Yes
                                    <input type="radio" name="active" value="No" id="">No
                            </td>
                            </tr>
                    <tr>
                    <td>
                        <input type="submit" class="btn-secondary2" name="submit" value="Add Food">
                    </td>
                         </tr>
                    </table>
                </form>
        </div>
    </div>
                    <!-- To insert into the database -->
                    <?php 
                    // check if the submit button is working or not
                    if(isset($_POST['submit'])){
                        // get all the data from the form
                        $title2 = $_POST['title'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $category = $_POST['category'];
                        
                        // want to check if the radio button is check or not
                        if(isset($_POST['featured'])){
                            $featured = $_POST['featured'];
                        } else {
                            $featured = 'No'; // default value
                        }

                        if(isset($_POST['active'])){
                            $active = $_POST['active'];
                        } else {
                            $active = "No";   // default value
                        }
                        
                  

                    // Adding images
                    //   check whether image has a name value or not
        if(isset($_FILES['image']['name'])){
           
            //------ To uplaod an image we need image name, source path, and destination.
            // Array ( [name] => [type] => [tmp_name] => [error] => 4 [size] => 0 )
            // Array ( [name] => circuit.PNG [type] => image/png [tmp_name] => C:\xampp\tmp\phpB1BB.tmp [error] => 0 [size] => 63360 )

            // get the file of the seleted image
            $image_name = $_FILES['image']['name']; 
            // check if the image is seleted or not then upload the image if image is selected
                if($image_name!=""){

              
            // Auto Rename image

            // Get the extension of our image (jpg, png, jpeg, gf, e.t.c) e.g food.jpg
            // seperate the image name from the extension name 
            $ext = end(explode('.', $image_name));

            // Rename the Image
            // If the same image is selected it will automatically rename it and safe it in the folder
            // create a new name for image
            $image_name = "food_name".rand(000, 999).'.'.$ext; // food_category_756.jpg
                    // Get the source part and the destination
            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/food/".$image_name;

            // finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            // check whether the image is uploaded or not
            // And if the image is not uploaded we will stop the process and redirect with error message
            if($upload==FALSE){
                $_SESSION['food-image'] = "<div class='error'>Failed to Add Image</div>";
                // redirect to add-category page
                header("location:".SITEURL.'admin/add-food.php');
                die();
            }

        }

        } else {
            // don't upload image and set image value as blank;
            $image_name="";
        }

        // Insert into the database
        $sql2 = "INSERT INTO tbl_food SET 
        title = '$title2',
        description = '$description',
        price = $price,
        image_name = '$image_name',
        category_id = '$category',
        featured = '$featured',
        active = '$active' 
        ";

        $res2 = mysqli_query($con, $sql2);

        if($res2 == TRUE){
           $_SESSION['food'] = "<div class='success'>Food added successfully</div>";
           header("location:".SITEURL.'admin/manage-food.php');
        }
         else {
            $_SESSION['food'] = "<div class='success'>Failed to add Food</div>";
            header("location:".SITEURL.'admin/manage-food.php');
         }
    }
                    ?>
      
<?php
include('../partials/footer.php');
 ?>