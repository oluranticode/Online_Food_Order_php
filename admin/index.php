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
            <h1>5</h1>
            <br>
            categories
        </div>

        <div class="col-4" >
            <h1>5</h1>
            <br>
            categories
        </div>

        <div class="col-4" >
            <h1>5</h1>
            <br>
            categories
        </div>

        <div class="col-4" >
            <h1>5</h1>
            <br>
            categories
        </div>

        <div class="col-4" >
            <h1>5</h1>
            <br>
            categories
        </div>

        <div class="col-4" >
            <h1>5</h1>
            <br>
            categories
        </div>

        <div class="clearfix"></div>
        
        </div> 
</div>
        <!-- main content ends -->

        <?php 
require "../partials/footer.php";
?>