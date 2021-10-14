<?php 
require "../partials/header.php";
?>

     <!-- main content starts -->
     <div class="main-content">
        <div class="wrapper" >
        <h1>MANAGE FOOD</h1>
    
        <br>
        <!-- Button Add Admin -->
        <a class="btn-primary" href="<?php echo SITEURL; ?>admin/add-food.php">ADD FOOD</a>

        <?php 
                if(isset($_SESSION['food'])){
                    echo $_SESSION['food'];
                    unset($_SESSION['food']);
                } ?>


        <?php 
              if(isset($_SESSION['delete-food'])){
                    echo $_SESSION['delete-food'];
                    unset($_SESSION['delete-food']);
                } ?>
          <?php 
              if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                } ?>

        <?php 
              if(isset($_SESSION['image-food-upload'])){
                    echo $_SESSION['image-food-upload'];
                    unset($_SESSION['image-food-upload']);
                } ?>

        <?php 
              if(isset($_SESSION['image-food-remove'])){
                    echo $_SESSION['image-food-remove'];
                    unset($_SESSION['image-food-remove']);
                } ?>

        <?php 
              if(isset($_SESSION['update-food'])){
                    echo $_SESSION['update-food'];
                    unset($_SESSION['update-food']);
                } ?>

        <br>

        <br>
        <table class="tbl-full">
                <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th> Category </th>
                        <th> Featured </th>
                        <th> Active </th>
                </tr>

                <?php 
                        // Create query select all data from the database
                        $sql = "SELECT * FROM tbl_food";

                        // Execute the query
                        $res = mysqli_query($con, $sql);

                        // check if the query is executed ot not
                        if($res){
                        // count the number rows in the database
                        $count = mysqli_num_rows($res);
                        $sn= 1 . ".";
                        
                        //check if there is any rows in the table
                        if($count > 0){
                                // Get all the data from the table
                             while($row = mysqli_fetch_assoc($res)){
                                     $id = $row['id'];
                                      $title = $row['title'];
                                     $description = $row['description'];
                                     $price = $row['price'];
                                     $image_name = $row['image_name'];
                                     $category = $row['category_id'];
                                     $featured = $row['featured'];
                                     $active = $row['active'];

                                ?>
                                
                                <tr class="fad">
                        <td><?php echo $sn++; ?> </td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php 
                        if($image_name!= ""){
                                ?>

                                <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name ?>" width="100px" alt="">
                                <?php
                        } else {
                                echo "<div style='color: red;' class=''> Image Not added </div>";
                        }
                        ?></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td><a class="btn-secondary1" href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>">Update</a>
                        <a class="btn-secondary2" href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>">Delete</a></td>
                </tr>

                                <?php
                             }
                        } else {
                                ?>
                              <h1>  <?php echo "<div class='error'>No Food is Available </div>"; ?> </h1>
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