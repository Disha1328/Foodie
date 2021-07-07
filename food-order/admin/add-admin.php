<?php include('../config/constants.php'); ?>
<link rel="stylesheet" href="../css/admin.css">
<div class="main-content">
    <div class="wrapper">
    <h1>WELCOME TO FOODIE</h1>
    <br><br>
    <h1>REGISTER ADMIN</h1>
        <?php
            if(isset($_SESSION['add'])) //Checks if session is set or not
            {
                echo $_SESSION['add']; //Display the session message
                unset($_SESSION['add']); //Remove Session Message when we refresh the page
            }
        ?>

        <br><br>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Register" class="btn-secondary">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <a href="login.php" class="btn-primary">Already registered</a>
                    </td>
                </tr>
                        
                       
                    

                

            </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 

    //Get the value entered in the form, process it and store it in the database table
    if(isset($_POST['submit']))//isset checks if submit button is clicked or not
    {
        // Button Clicked
        //Get the Data from form
        $full_name = $_POST['full_name']; //$full_name is the name of the row in the database
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5
        

        //SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Check if data is inserted into table or not
        if($res==TRUE)
        {
            //Data Inserted
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "Admin added successfully";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/login.php');
        }
        else
        {
            //Unable to insert data
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "Failed to add admin";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
    
?>