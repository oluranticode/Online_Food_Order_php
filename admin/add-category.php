<?php require "../partials/header.php"; ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br> <br>
            <?php 
                if(isset($_SESSION['add-category'])){
                    echo $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                }
            ?>
            
            <?php 
                if(isset($_SESSION['image-add'])){
                    echo $_SESSION['image-add'];
                    unset($_SESSION['image-add']);
                }
            ?>

            <!-- Add category Form Start -->
                <form action="" method="post" enctype="multipart/form-data" >
                    <table class="tbl-30">
                            <tr>
                                <td>Title:</td>
                                <td><input type="text" name="title" id=""></td>
                            </tr>

                            <tr>
                                <td>Select Image</td>
                                <td><input type="file" name="image" id=""></td>
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
                                <td colspan="2">
                                    <input type="submit" name="submit" value="Add Category" class="btn-secondary2">
                                </td>
                            </tr>
                    </table>
                </form>
            <!-- Add Category Form Ends-->
        </div>
    </div>
<?php 
    // check whether the button is click or not
        if(isset($_POST["submit"])){
           
            // 1. Get the data from the category form
            // $title = $_POST['title'];
            $title = mysqli_real_escape_string($con, $_POST['title']);
           
            // for the radio input, we want to check whether the button is selected or not
            if(isset($_POST['featured'])){
                // get data from the form
                $featured = $_POST['featured'];
            } else {
                $featured = "No";  // default value
            }

            if(isset($_POST['active'])){
                // get data from the form
                $active = $_POST['active'];
            } else {
                $active = "No";  // default value
            }

            // ......... Adding the Image
            // check whether the image is selected or not and set value for image name accordingly
            //print_r($_FILES['image']);

        //   check whether image has a name value or not
        if(isset($_FILES['image']['name'])){
           
            //------ To uplaod an image we need image name, source path, and destination.
            // Array ( [name] => [type] => [tmp_name] => [error] => 4 [size] => 0 )
            // Array ( [name] => circuit.PNG [type] => image/png [tmp_name] => C:\xampp\tmp\phpB1BB.tmp [error] => 0 [size] => 63360 )

            $image_name = $_FILES['image']['name']; 
            // upload the image if image is selected
                if($image_name!=""){

              
            // Auto Rename image

            // Get the extension of our image (jpg, png, jpeg, gf, e.t.c) e.g food.jpg
            // seperate the image name from the extension name 
            $ext = end(explode('.', $image_name));

            // Rename the Image
            // If the same image is selected it will automatically rename it and safe it in the folder
            $image_name = "food_category_".rand(000, 999).'.'.$ext; // food_category_756.jpg

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/category/".$image_name;

            // finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            // check whether the image is uploaded or not
            // And if the image is not uploaded we will stop the process and redirect with error message
            if($upload==FALSE){
                $_SESSION['image-add'] = "<div class='error'>Failed to Add Image</div>";
                // redirect to add-category page
                header("location:".SITEURL.'admin/add-category.php');
                die();
            }

        }

        } else {
            // don't upload image and set image value as blank;
            $image_name="";
        }
        // ............ End of adding image
         // upload image to database

            // create sql query
             $sql = "INSERT INTO tbl_category SET 
             title='$title', image_name='$image_name', 
             featured='$featured', active='$active' ";
            //$sql = "INSERT INTO tbl_category (title, featured, active) VALUES ('$title', '$featured', '$active')";

            // execute the query and save in database
            $res = mysqli_query($con, $sql);

            // check whether the query is executed or not
            if($res){
                
                // Display message 
                $_SESSION['add-category'] = "<div class='success'> Category has been added successfully </div>";
                // Redirect To Category Page
                header("location:".SITEURL.'admin/manage-category.php');
            } else {
                // Display message 
                $_SESSION['add-category'] = "<div class='error'> Failed to add category </div>";
                // Redirect To Category Page
                header("location:".SITEURL.'admin/add-category.php');
            }
        }
?>

<?php require "../partials/footer.php"; ?>