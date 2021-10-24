<?php include('partials-front/header.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
               // Get the search Keyword
            //    $search = $_POST['search'];
               $search = mysqli_real_escape_string($con, $_POST['search']);
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

            <?php 
             
                // create sql query for search
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // Execute the query 
                $res = mysqli_query($con, $sql);
                // check if the query execute successfully
                if($res){
                    $count = mysqli_num_rows($res);
                    if($count>0){
                        // food is available
                        while($row = mysqli_fetch_assoc($res)){
                           $id = $row['id'];
                            $title = $row['title'];
                            $description = $row['description'];
                           $price = $row['price'];
                            $image_name = $row['image_name'];
 
                            ?>
                            <br><br>
                <div class="food-menu-box">
                <div class="food-menu-img">
                <?php 
                    if($image_name!=""){
                        ?>
                    <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="Chicken Hawain Pizza" class="img-responsive img-curve">
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
                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                            <?php
                        }
                    } else {
                        // not available
                        echo "<div class='error'>Food is not available</div>";
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <!-- <div class="container">
            <h2 class="text-center">Food Menu</h2> -->

            <!-- <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div> -->

           
            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>