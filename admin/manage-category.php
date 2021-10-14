<?php 
require "../partials/header.php";
?>

     <!-- main content starts -->
     <div class="main-content">
        <div class="wrapper" >
        <h1>MANAGE CATEGORY</h1>
        <br>  <br>  <br>
        
        <?php 
                if(isset($_SESSION['add-category'])){
                    echo $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                }
            ?>

        <?php
                if(isset($_SESSION['delete-category'])){
                    echo $_SESSION['delete-category'];
                    unset($_SESSION['delete-category']);
                }
            ?>

        <?php
                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
            ?>

        <?php
                if(isset($_SESSION['update-category'])){
                    echo $_SESSION['update-category'];
                    unset($_SESSION['update-category']);
                }
            ?>

        <?php
                if(isset($_SESSION['update-category-message'])){
                    echo $_SESSION['update-category-message'];
                    unset($_SESSION['update-category-message']);
                }
            ?>
            <?php
                if(isset($_SESSION['image-upload'])){
                    echo $_SESSION['image-upload'];
                    unset($_SESSION['image-upload']);
                }
            ?>
            <?php
                if(isset($_SESSION['image-remove'])){
                    echo $_SESSION['image-remove'];
                    unset($_SESSION['image-remove']);
                }
            ?>
            <br>

  <!-- Button Add Admin -->
  <a class="btn-primary" href="<?php echo SITEURL?>admin/add-category.php">ADD CATEGORY</a>
  <br>
        <br>
        <table class="tbl-full">
                <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                </tr>

                <?php 
                // Create a query
                        $sql = "SELECT * FROM tbl_category ORDER BY id DESC";
                // Execute the query
                        $res = mysqli_query($con, $sql);
                        // to check if the query has been executed or not
                        if($res){
                                $sn = 1;
                        //  Count the number of rows in the table
                        $count = mysqli_num_rows($res);
                        // check if there is any rows in the table
                                if($count>0){
                                        // Fetch all data in the table
                                        while($row=mysqli_fetch_assoc($res)){
                                             $id = $row['id'];
                                             $title = $row['title'];
                                             $image_name = $row['image_name'];
                                             $featured = $row['featured'];
                                             $active = $row['active'];
                                             ?>

                                             <tr>
                                             <td><?php echo $sn++; ?> </td>
                                             <td><?php echo $title; ?></td>
                                             <td>
                                                     <!-- display image -->
                                                     <?php 
                                                        if($image_name!=""){
                                                                ?>
                                                                <!-- display image -->
                                                                <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name; ?>" width="100px" >
                                                                <?php
                                                        } else {
                                                                // display message image not added
                                                                echo "<div style='color: red;' class=''> Image Not added </div>";
                                                        }
                                                     ?>
                                             </td>
                                             <td><?php echo $featured; ?></td>
                                             <td><?php echo $active; ?></td>
                                             <td><a class="btn-secondary1" href="<?php echo SITEURL ?>admin/update-category.php?id=<?php echo $id; ?>">Update Category</a>
                                             <a class="btn-secondary2" href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>">Delete Category</a></td>
                                     </tr>

                                     <?php
                                        }
                                       
                                } else {
                                       ?>
                                        <!-- No data found -->
                                        <tr>
                                                <td colspan='' > <div class="error"> No Category Found</div></td>
                                        </tr>
                                       <?php
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