<?php include('partials/menu.php'); ?>

<?php
    //check whether id is  set or not;
    if(isset($_GET['id']))
    {
        //Get all the details; 
        $id = $_GET['id'];

        //SQL query to get the selected food details;
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        
        //Execute the query;
        $res2 = mysqli_query($conn,$sql2);

        //Get the value based on query executed;
        $row2 = mysqli_fetch_assoc($res2);

        //Get the individual values of the selected food;

        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        //Redirect to manage food;
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                
                <!--TITLE-->
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <!--DESCRIPTION-->
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <!--PRICE-->
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>       
                </tr>

                <!--IMAGE-->
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image=="")
                            {
                                //Image not availavle;
                                echo "Image is not available!";
                            }
                            else
                            {
                                //image available;
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                   <!-- <td>
                        <input type="file" name="image" id="">
                    </td>-->
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>                   
                </tr>
                <!--CATEGORY-->
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                        <?php 
                            //creat php to display categories from databases;
                            //1.creat sql to get all active categories;
                            $sql = "SELECT * FROM tbl_category WHERE active ='Yes'";

                            //executing query;
                            $res = mysqli_query($conn,$sql);

                            //count rows to check wheather we have categories or not;
                            $count = mysqli_num_rows($res);

                            //If count is > 0 we have categories otherwise we don't have categories;
                            if($count>0)
                            {
                                //we have categories;
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    //get the details of category;
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    ?>
                                        <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                
                                //we do not have categories ;
                                echo "<option value='0'>Category not available<option>";
                            }
                            //2.Display on Dropdown;
                        ?>                            
                        </select>
                    </td>
                </tr>
                <!--FEATURED-->
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" id="" value ="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" id="" value ="No">No
                    </td>
                </tr>
                <!--ACTIVE-->
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" id="" value ="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" id="" value ="No">No
                    </td>
                </tr>
                <!--SUBMIT BUTTON-->
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit"value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            //Check 
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. Get all the details from the form;
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                //2. Upload the image if selected;

                    //check wheather upload button is clicked or not;
                    if(isset($_FILES['image']['name']))
                    {
                        //Upload Button Clicked;
                        $image_name = $_FILES['image']['name'];//this is new image name;

                        //check wheather the file is available or not;
                        if($image_name!="")
                        {
                            $ext = explode('.',$image_name);

                            $ext = end($ext);

                            $image_name = "Food_name-".rand(0000,9999).".".$ext;  

                            $src = $_FILES['image']['tmp_name'];

                            $dst = "../images/food/".$image_name;   
                            
                            $upload = move_uploaded_file($src,$dst);

                            //check whether uploted or not;
                            if($upload==false)
                            {
                                //failed to upload so redirect with message to add-food page;
                                $_SESSION['upload']="Failed to upload Image";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //stop the process;
                                die();
                            }
                            //3. remove the image if new image is uploaded;
                            //B.Remove current img;
                            if($current_image != "")
                            {
                                //Current image is available;
                                //Remove it;
                                $remove_path = "../images/food/".$current_image;

                                $remove = unlink($remove_path);

                                //check 
                                if($remove==false)
                                {
                                    $_SESSION['remove']="Failed to remove Image";
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    //stop the process;
                                    die();
                                }
                            }
                        }
                        else
                        {
                            $image_name = $current_image;
                        }
                        
                    }
                    else
                    {
                        $image_name = $current_image;

                    }              
                //4. update the database;
                $sql3 = "UPDATE tbl_food SET
                        title='$title',
                        description='$description',
                        price='$price',
                        image_name='$image_name',
                        category_id='$category',
                        featured='$featured',
                        active='$active'
                        WHERE id=$id
                        ";

                $res3 = mysqli_query($conn,$sql3);
                if($res3==true)
                {
                    $_SESSION['update']="Updated";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['update']="Failed";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                //5. redirect to manage food with session message;

            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>