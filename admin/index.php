<?php 
require "../partials/header.php";
?>

     <!-- main content starts -->
     <div class="main-content">
        <div class="wrapper" >
        <h1>DASHBOARD</h1>
        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
        <br>

        <div class="col-4" >
            <?php 
            // Create sql to fetch data from the database
            $sql = "SELECT * FROM tbl_category";
            // execute the query
            $res = mysqli_query($con, $sql);
            // check if the query is executed or bot
            if ($res){
                // count the number of rows available in the table
                $count = mysqli_num_rows($res);
            }
            ?>
            <h1><?php echo $count; ?></h1>
            <br>
            categories
        </div>



        <div class="col-4" >
        <?php 
            // Create sql to fetch data from the database
            $sql2 = "SELECT * FROM tbl_food";
            // execute the query
            $res2 = mysqli_query($con, $sql2);
            // check if the query is executed or bot
            if ($res2){
                // count the number of rows available in the table
                $count2 = mysqli_num_rows($res2);
            }
            ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            Foods
        </div>



        <div class="col-4" >
        <?php 
            // Create sql to fetch data from the database
            $sql3 = "SELECT * FROM tbl_order";
            // execute the query
            $res3 = mysqli_query($con, $sql3);
            // check if the query is executed or bot
            if ($res3){
                // count the number of rows available in the table
                $count3 = mysqli_num_rows($res3);
            }
            ?>
            <h1><?php echo $count3; ?></h1>
            <br>
            Total Orders
        </div>



        <div class="col-4" >
            <?php
            // create sql to generate total amount for the revenue
             $sql4 = "SELECT sum(total) AS Total FROM tbl_order WHERE status='Delivered'";
            //  execute the query
            $res4 = mysqli_query($con, $sql4);
            // get the value
            $row4 = mysqli_fetch_assoc($res4);
            $total_revenue = $row4['Total'];
            ?>
            <h1><?php echo "$". $total_revenue; ?></h1>
            <br>
            Revenue Generated
        </div>


        <div class="clearfix"></div>
        
        </div> 
</div>
        <!-- main content ends -->

        <?php 
require "../partials/footer.php";
?>

<!-- 07:42 -->