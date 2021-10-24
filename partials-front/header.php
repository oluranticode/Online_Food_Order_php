<?php include('config/config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order Shop</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/admin.css"> -->
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <!-- <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive"> -->
                    <h4>TemzyFood</h3>
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php SITEURL; ?>index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->