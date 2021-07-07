<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- form to add category-->
        <form action="" method="POST" enctype="multipart/form-data"> <!--enctype says in what form the data should be encrypted while submitting it to server-->
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2"> <!--merging 2 columns-->
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
            if(isset($_POST['submit']))//checks if the submit button is clicked or not
            {
                //obtain the value that is entered in the form
                $title = $_POST['title'];

                //check for featured button
                if(isset($_POST['featured']))
                {
                    //obtain the value entered
                    $featured = $_POST['featured'];
                }
                else
                {
                    //default value will be not selected
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //check if any image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //upload the image. src and dest path required
                    $image_name = $_FILES['image']['name'];
                    // Upload the Image only if image is selected
                    if($image_name != "")
                    {
                        //uniform naming by changing the existing name to a name in standard format
                        $ext = end(explode('.', $image_name));
                        
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // rename the image lyk Food_Category_834.jpg
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);//copy the image to destination folder

                        //unable to upload the image
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            header('location:'.SITEURL.'admin/add-category.php');//redirect to add category page
                            die();
                        }

                    }
                }
                //no image is selected and that field is left blank
                else
                {
                    $image_name="";
                }

                //Create SQL Query to insert category data into Database
                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                //Check whether the query executed or not and data added or not
                if($res==true)
                {
                    //Query Executed and Category Added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to Add CAtegory
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>