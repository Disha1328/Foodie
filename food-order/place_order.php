<?php include ('partials-front/menu.php')?>
<?php
    //check whether food id is set or not
    if(isset($_GET['food_id']))
    {
        //Get the details and display it in the order form
        $food_id=$_GET['food_id'];
        $sql="SELECT * FROM tbl_food WHERE id=$food_id";
        //execute the query
        $res=mysqli_query($conn, $sql);
        //count the rows
        $count=mysqli_num_rows($res);
        //check whether the data is available or not
        if($count==1)
        {
            //data is present
            //get data from database
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
        }
        else{
            //food not available and redirect to home
            header('location:'.SITEURL);
        }
    }
    else{
        header('location:'.SITEURL);
    }
?>
    <!-- place order-->
    <section class="place-order text-center">
        <div class="container">
            <h2 class="text-center text-white">Confirm your order</h2>
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected food</legend>
                    <div class="food-menu-img">
                    <?php
                        //check if image is available or not
                        if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                    ?>
                        
                    </div>
                    <div class="description">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">Rs <?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Name</div>
                    <input type="text" name="name" placeholder="Eg Name" class="input-responsive" required>

                    <div class="order-label">Contact Number</div>
                    <input type="text" name="phno" placeholder="1234567890" class="input-responsive" required>

                    <div class="order-label">Email id</div>
                    <input type="text" name="mail" placeholder="asdf@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows ="10" placeholder="layout,city,state" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Place Order" class="btn btn-primary">
                </fieldset>
            </form>
            <?php 

                
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price of 1 item x quantity

                    $order_date = date("Y-m-d h:i:sa"); //Order Date

                    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = $_POST['name'];
                    $customer_contact = $_POST['phno'];
                    $customer_email = $_POST['mail'];
                    $customer_address = $_POST['address'];


                    //Save the Order in Databaase
                    //Create SQL to save the data
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
                    //Execute the Query
                    $res2= mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div class='success text-center'>Order Placed Successfully!!</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }

                }
            
            ?>


        </div>
    </section>
    <!-- End search food section-->

    <?php include ('partials-front/footer.php')?>