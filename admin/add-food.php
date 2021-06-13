<?php
include('partials/menu.php');
?>


    <!--Main-Content Sectin starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
                <br/>
                <br/>
            

            <br/><br/><br/>
            <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Title:</td>
                            <td><input type="text" name="title" placeholder="Title of the food"></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><textarea name="description" cols="50" rows="7" placeholder="Description of the food"></textarea></td>
                        </tr>
                        <tr>
                            <td>Price:</td>
                            <td>
                                <input type="number" name="price">
                            </td>
                        </tr>
                        <tr>
                            <td>Select Image:</td>
                            <td>
                            <input type="file" name="image" id="">
                            </td>
                        </tr>
                        <tr>
                            <td>Category:</td>
                            <td>
                                <select name="category">
                                    <?php
                                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                        $res = mysqli_query($conn,$sql);
                                        $count = mysqli_num_rows($res);
                                        if($count>0)
                                        {
                                            while($row = mysqli_fetch_assoc($res))
                                            {
                                                $id= $row['id'];
                                                $title = $row['title'];
                                                ?>

                                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <option value="0">No Category Found</option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Featured:</td>
                            <td>
                            <input type="radio" name="featured" value="Yes">Yes 
                            <input type="radio" name="featured" value="No">No
                            </td>
                        </tr>
                        <tr>
                            <td>Active:</td>
                            <td>
                            <input type="radio" name="active" value="Yes">Yes 
                            <input type="radio" name="active" value="No">No
                            </td>
                        </tr>                    
                        <tr>
                            
                            <td colspan="2"><input type="submit" name="submit" value="Add Food" class="btn-primary"></td>
                        </tr>
                    </table>
                </form>


                <?php
            //check clicked or not;
            if(isset($_POST['submit']))
            {
                //echo "Button clicked";
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                if(isset($_POST['featured']))
                {
                    //get the value;
                    $featured = $_POST['featured'];
                }
                else
                {
                    //set deafault
                    $featured="No";
                }
                if(isset($_POST['active']))
                {
                    //get the value;
                    $active = $_POST['active'];
                }
                else
                {
                    //set deafault
                    $active="No";
                }
                
            }
               /* //get the value from form;
                $title = $_POST['title'];
                //for radio input type;
                if(isset($_POST['featured']))
                {
                    //get the value;
                    $featured = $_POST['featured'];
                }
                else
                {
                    //set deafault
                    $featured="No";
                }
                if(isset($_POST['active']))
                {
                    //get the value;
                    $active = $_POST['active'];
                }
                else
                {
                    //set deafault
                    $active="No";
                }

                //check whether the image is selected or not
                //print_r($_FILES['image']);

                //die();//break the code here

                if(isset($_FILES['image']['name']))
                {
                    //we will upload the image;
                    $image_name=$_FILES['image']['name'];
                    //If image name is available only then upload image;
                    if($image_name!="")
                    {

                        //auto rename

                        $ext = end(explode('.',$image_name));

                        $image_name="Ecom".rand(000,999).'.'.$ext;

                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path,$destination_path);


                        //check;
                        if($upload==false)
                        {
                            $_SESSION['upload']="Sorry failed to upload";
                            header('location:'.SITEURL.'admin/add-category.php');
                            die();
                        }

                    } 
                    
                }
                else
                {
                    //Don't upload and set it blank;
                    $image_name="";
                }

                //sql to insert

                $sql="INSERT INTO tbl_category SET 
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";
                //execute query

                $res=mysqli_query($conn,$sql);
                //check
                if($res==true)
                {
                    //executed;
                    $_SESSION['add']="Successfully added the category";
                    //rediorect;
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //failed
                    $_SESSION['add']="Sorry failed to add the category";
                    //rediorect;
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }*/
            ?>
            <div class="clearfix"></div>

        </div>
    </div>
    <!--Main-content Sectin ends-->






<?php
include('partials/footer.php');
?>