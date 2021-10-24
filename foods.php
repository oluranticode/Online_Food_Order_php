<?php include('partials-front/header.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
   <!-- fOOD MEnu Section Starts Here -->
   <section class="food-menu">
        <div class="container">
            <h class="text-center">Food Menu</h>

            <?php 
            // create sql query to all data from the particular table
        $sql = "SELECT * FROM tbl_food";
        // execute the query
        $res = mysqli_query($con, $sql);
       
         // count the number of rows available in the table
            $count = mysqli_num_rows($res);
            if($count > 0){
                 // fetch the data from the Database using while loop
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
                    <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php 
                    if($image_name!=""){
                        ?>
                    <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                    } else {
                        echo "<div class='error'>Image is not Available</div>";
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price"><?php echo $price; ?></p>
                    <p class="food-detail">
                    <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                    <?php
                 }

            } else {
                echo "<div class='error'>Food is not Available</div>";
            }
            ?>

            <!-- <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div> -->

            <div class="clearfix"></div>
        </div>
     
    </section>
    <!-- fOOD Menu Section Ends Here -->



    <?php include('partials-front/footer.php'); ?>