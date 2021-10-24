<?php require "../partials/header.php"; ?>

<div class="main-content">
        <div class="wrapper" >
        <h1>UPDATE ORDER</h1>
        <?php
            // Get the id
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                // get the data from the dtabase
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                // execute the query
                $res = mysqli_query($con, $sql);
                // check if the query execute
                if($res){
                    $count = mysqli_num_rows($res);
                    if($count==1){
                        // fecth data
                        while($row = mysqli_fetch_assoc($res)){
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
                        }
                    } else {
                         // redirect to the manage order
                header("location:".SITEURL.'admin/manage-order.php');
                    }
                }
            } else {
                // redirect to the manage order
                header("location:".SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">
        <table>
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><b><?php echo $price; ?></b></td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>

                <tr>
                    <td>Total</td>
                    <td><b><?php echo $total; ?></b></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                        <option <?php if($status=="Ordered"){ echo "selected";} ?> value="Ordered"> ordered</option>
                        <option <?php if($status=="On Delivery"){ echo "selected";} ?> value="On Delivery"> On Delivery</option>
                        <option <?php if($status=="Delivered"){ echo "selected";} ?> value="Delivered"> Delivered</option>
                        <option <?php if($status=="Cancelled"){ echo "selected";} ?> value="Cancelled"> Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>customer Name</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>

                <tr>
                    <td>customer Contact</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>

                <tr>
                    <td>customer Email</td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>

                <tr>
                    <td>customer Address</td>
                    <td><textarea name="customer_address"><?php echo $customer_address; ?> </textarea> </td>
                </tr>

               

                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" >
                    <input type="hidden" name="price" value="<?php echo $price; ?>" >
                    <td>  <input type="submit" class="btn-secondary1" name="submit" value="Update Order"> </td>
                </tr>
</table>
                
            </form>

            <?php 
            // check if the button is clicked or not
            if(isset($_POST['submit'])){
                // Get data from the form
                $id = $_POST['id'];
                // $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];   //ordered, cancelled, failed
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                // Update the database
                $sql2 = "UPDATE tbl_order SET
                qty = $qty,
                total = $total,
                 status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                WHERE id = $id 
                ";

                // execute the query
                $res2 = mysqli_query($con, $sql2);
                // check if the query is executed or not
                if($res2){
                    $_SESSION['order-update-mesg'] = "<div class='success'>order Updated</div>";
                    // redirect to home page
                    header("location:".SITEURL.'admin/manage-order.php');
                } else {
                    $_SESSION['order-update-mesg'] = "<div class='error'>Update Failed</div>";
                    // redirect to home page
                    header("location:".SITEURL.'admin/manage-order.php');
                }

            }
                
            ?>


</div>
</div>

<?php require "../partials/footer.php"; ?>