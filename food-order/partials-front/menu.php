<?php 
    include('config/constants.php');
    include('login-check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make a website responsive-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering System</title>

    <!-- Link the css file-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!--Navigation bar-->
    <section class="Navbar">
        <div class="container">
            <div class="logo">
                <img src="images/logo.png" alt="Logo" class="img-responsive">
            </div>
            <div class="Menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL;?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>category.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>food.php">Foods</a>
                    </li>
                    <li><a href="user_logout.php">Logout</a></li>
                    
                </ul>
            </div>
        </div>
    </section>
    <!-- End Navbar section-->