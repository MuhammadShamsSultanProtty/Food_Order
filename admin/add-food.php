<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Add Food</h1>
    <br><br>
    <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset( $_SESSION['add']);
        }
    ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                
                <!--TITLE-->
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Food name">
                    </td>
                </tr>

                <!--DESCRIPTION-->
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="description of the food"></textarea>
                    </td>
                </tr>

                <!--PRICE-->
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="Enter price.">
                    </td>       
                </tr>

                <!--IMAGE-->
                <tr>
                    <td>Select Image:</td>
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
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                
                                //we do not have categories ;
                                ?>
                                <option value="0">No categories available!</option>
                                <?php
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
                        <input type="radio" name="featured" id="" value ="Yes">Yes
                        <input type="radio" name="featured" id="" value ="No">No
                    </td>
                </tr>
                <!--ACTIVE-->
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" id="" value ="Yes">Yes
                        <input type="radio" name="active" id="" value ="No">No
                    </td>
                </tr>
                <!--SUBMIT BUTTON-->
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit"value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            //Check whether button is clicked or not;
            if(isset($_POST['submit']))
            {
                //add the food;
                //echo "Button clicked!";
                //1.Get the data from Form;
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check wheather radio buttons are clicked or not;
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";//setting the deafult value;
                }
                //Active 
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";//setting the deafult value;
                }
                //2.Upload the image if selected;
                //Check wheather the select image is clicked or not and upload the image only if the image is selected;
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image;
                    $image_name = $_FILES['image']['name'];

                    //Check whether the Image is selected or not and upload only if selected;
                    if($image_name != "")
                    {
                        //image is selected;
                        //A. Rename the image;
                        //Get the extention of selected Image (jpg, png, gif etc.);
                        $ext = explode('.',$image_name);
                        $ext = end($ext);
                        //creat new image name;
                        $image_name = "Food_name-".rand(0000,9999).".".$ext;//New Image name like "Food_name-1234.jpg";
                        //B. Upload the image;
                        //Get the source path  & Destination path;

                        //source path is the current location of the image;
                        $src = $_FILES['image']['tmp_name'];

                        $dst = "../images/food/".$image_name;

                        //Finally Upload image;
                        $upload = move_uploaded_file($src,$dst);

                        //check whether uploted or not;
                        if($upload==false)
                        {
                            //failed to upload so redirect with message to add-food page;
                            $_SESSION['upload']="Failed to upload Image";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //stop the process;
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = "";//setting deafult value as blank;
                }
                //3.Insert the data into database;

                //Creat a sql to save or add food;

                $sql2 = "INSERT INTO tbl_food SET
                        title = '$title',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                ";

                //execute
                $res2 = mysqli_query($conn,$sql2);

                //4.Redirect with message to manage food page;
                if($res2==true)
                {
                    //data insertec;
                    $_SESSION['add']="Added";
                    //header;
                    header('location:'.SITEURL.'admin/manage-food.php');
                   
                }
                else{
                    //failed;
                    $_SESSION['add']="Failed";
                    //header('location:admin/manage-food.php');
                    header('location:'.SITEURL.'admin/add-food.php');
                }

                
            } 
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>
