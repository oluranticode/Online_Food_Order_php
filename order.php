<?php include('partials-front/header.php'); ?>

    <?php 
    // get the food_id
    if(isset($_GET['food_id'])){
        // get the id and other variables
        $food_id = $_GET['food_id'];
        // Create Sql to select all data neccessary from food table
        $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
        // execute the query
        $res = mysqli_query($con, $sql);
        // check if the query has been executed
        if($res){
            // count the number of rows in the table
            $count = mysqli_num_rows($res);
            if($count==1){
                // get data from database
                $row = mysqli_fetch_assoc($res);
                // these are the data from the database
                $id = $row['id'];
                $title = $row['title'];               
                $price = $row['price'];
                $image_name = $row['image_name'];
            } else {
                // no food is available
                // redirect to home page
                header("location:".SITEURL);
            }

        }
    } else {
        // redirect back to the home page
        header("location:".SITEURL);
    }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                    <?php 
                    // Upload Image
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
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1">
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>

            <?php 
            // check if the submit button is clicked or not
            if(isset($_POST['submit'])){
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $order_date = date("Y-m-d h:i:sa");
                $status = "successfuly Orderd";   //ordered, cancelled, failed
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                // insert into the database
                $sql2 = "INSERT INTO tbl_order SET
                food = '$food',
                price = $price,
                qty = $qty,
                total = $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                ";
                // execute the query
                $res2 = mysqli_query($con, $sql2);
            // check if the query is executed or not
                if($res2){
                    $_SESSION['order-msg'] = "<div class='success'>Ordered Successfully</div>";
                    // redirect to home page
                header("location:".SITEURL);
                } else {
                    $_SESSION['order-msg'] = "<div class='error'>Ordered Failed</div>";
                    // redirect to home page
                header("location:".SITEURL);
                }
            }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>