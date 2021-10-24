<?php include('partials-front/header.php'); ?>

<?php
            if(isset($_GET['id'])){
                $category_id = $_GET['id'];
                // get title from the database
                $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
                // execute the query
                $res = mysqli_query($con, $sql);

                // check if the query is executed successfully
                if($res){
                    $row=mysqli_fetch_assoc($res);
                    $category_title = $row['title'];
                }
            } else {
                //  category not found
                $_SESSION['category-food'] = "<div class='error'> Category not found </div>";
                // redirect to the home page
                header("location:".SITEURL);
            }
        ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                // create sql query to fetch all data from the food table
                $sql2 = "SELECT * FROM tbl_food WHERE category_id= $category_id";
                // Execute the query
                $res2 = mysqli_query($con, $sql2);
                if($res2){
                    $count2 = mysqli_num_rows($res2);
                    if($count2>0){
                        while($row2=mysqli_fetch_assoc($res2)){
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $image_name = $row2['image_name'];
                    $category = $row2['category_id'];

                    ?>
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

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                    <?php
                            
                        }
                    } else {
                        // no food in this category
                        echo "<div class='error'>No Food in this category</div>";
                    }
                }
            ?>

            
  <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>