<?php include('partials-front/header.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
                // create sql query to select data from the database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' LIMIT 3";
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
               
                <h3 class="float-text text-white"><?php echo $title; ?></h3>
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

                <h3 class="float-text text-white">Pizza</h3>
            </div>
            </a> -->

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>