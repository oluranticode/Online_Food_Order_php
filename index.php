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
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Available Food</h2>

            <?php 
            if(isset($_SESSION['order-msg'])){
                echo $_SESSION['order-msg'];
                unset($_SESSION['order-msg']);
            }
            ?>

            <?php 
                // create sql query to select data from the database
                $sql = "SELECT * FROM tbl_category WHERE featured='Yes' AND active='Yes' LIMIT 3";
                // execute the query
                $res = mysqli_query($con, $sql);
                // check if the query is excuted or not
                if($res){
                    // $count the number of rows in the table
                   $count = mysqli_num_rows($res);
                   //check if the number of rows exit in the table or not
                if($count>0){
                    // fetch all the data with while loop
                    while($row = mysqli_fetch_assoc($res)){
                         $id = $row['id'];
                         $title = $row['title'];
                         $image_name = $row['image_name'];
                         $featured = $row['featured'];
                         $active = $row['active'];
                         ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?id=<?php echo $id; ?>">
            <div class="box-3 float-container">
                <?php 
                    if($image_name==""){
                        // display image not available
                        echo "<div class='error'> Image Not Available </div>";
                    } else {
                        // display Image
                        ?>
                 <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                        <?php
                    }
                ?>
                <div><h3 class="text-btn"><?php echo $title; ?></h3></div>              
                
            </div>
            
            </a>
                         <?php
                    }
                } else {
                    // no data found
                    echo "<div class='error'> Category Not Available </div>";
                }
                }
            ?>

            <!-- <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="images/pizza.jpg" alt="Pizza" class="img-responsive img-curve">
            <div> <h3 class="float-text text-white" style="color:#000000; background-color:red;" >Pizza</h3></div>

            </div>
            </a> -->

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            // create sql query to all data from the particular table
        $sql2 = "SELECT * FROM tbl_food";
        // execute the query
        $res2 = mysqli_query($con, $sql2);
       
         // count the number of rows available in the table
            $count2 = mysqli_num_rows($res2);
            if($count2 > 0){
                 // fetch the data from the Database using while loop
                 while($row2 = mysqli_fetch_assoc($res2)){
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $image_name = $row2['image_name'];
                    $category = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];
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
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div> -->

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>