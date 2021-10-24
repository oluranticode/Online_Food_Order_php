<?php 
require "../partials/header.php";
?>

     <!-- main content starts -->
     <div class="main-content">
        <div class="wrapper-order" >
        <h1>MANAGE ORDER</h1>
        <?php
        if(isset($_SESSION['order-update-mesg'])){
                echo $_SESSION['order-update-mesg'];
                unset($_SESSION['order-update-mesg']);
        }
        ?>
        
             
        <table class="tbl-full">
                <tr>
                        <th>S.N</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                </tr>
                
        <?php 
                // Create Sql to fetch data from the database
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                // execute the query
                $res = mysqli_query($con, $sql);
                // check if the query has been executed or not
                if($res){
                        // count the rows
                        $count = mysqli_num_rows($res);
                        $sn = 1;
                        if($count>0){
                        // fetch all data from the db
                        while($row=mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];   
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];

                                ?>
                        <tr>
                                <td><?php echo $sn++; ?> </td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php  
                                // Ordered, Delivered, On Delivery, Cancelled
                                     if($status=="Ordered"){
                                             echo "<label style='color: brown'>$status</label>";
                                     } 
                                     elseif ($status=="Delivered") {
                                        echo "<label style='color: green'>$status</label>";
                                     } 
                                     elseif ($status=="On Delivery") {
                                        echo "<label style='color: blue'>$status</label>";
                                     }
                                     elseif ($status=="Cancelled") {
                                        echo "<label style='color: red'>$status</label>";
                                     } else {
                                             echo $status;
                                     }         
                                 ?>
                                </td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td><a class="btn-secondary1" href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>">Update</a>
                                </td>
                        </tr>
                                <?php
                        }
                        } else {
                                echo "<tr>
                                <td class='error'> No data Found </td>
                                </tr>";
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