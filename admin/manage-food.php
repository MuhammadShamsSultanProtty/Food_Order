<?php
include('partials/menu.php');
?>

    <!--Main-Content Sectin starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Food Management</h1>
            <br/><br/>
            <?php
 
                       if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);
                        }
                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }
                        if(isset($_SESSION['remove']))
                        {
                            echo $_SESSION['remove'];
                            unset($_SESSION['remove']);
                        }

            ?>
            
            <br/><br/>
                <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
            <br/><br/>
            <table class="tbl-full">
                <tr>
                    <th>S.L</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                 <?php 
                    //Creat sql to get all the data from database;
                    $sql = "SELECT * FROM tbl_food";
                    //execute query;
                    $res = mysqli_query($conn,$sql);

                    //count wheather we have foods or not;
                    $count = mysqli_num_rows($res);
                        //Creat serial ver;
                        $sn = 1;
                    if($count>0)
                    {
                        //we have food in database;
                        //Get the food from database;
                        while($row = mysqli_fetch_assoc($res))
                        {
                            //get values from indevidual colums;
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                            <tr>
                                <td><?php echo $sn++."."; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php 
                                        //Check wheather we have image or not;
                                        if($image_name=="")
                                        {
                                            //we do not have image;display error message;
                                            echo "No picture added";
                                        }   
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" width="150px">   
                                            <?php
                                        } 
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="#" class="btn-secondary">Update Food</a>          
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>& image_name=<?php echo $image_name; ?>" class="btn-danger">Delet Food</a>
                            </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        //no dont have any food;
                        echo "<tr><td colspan='7' class ='error'>Food not added yet.</td></tr>";
                    }
                 ?>       
            </table>

            <div class="clearfix"></div>

        </div>
    </div>
    <!--Main-content Sectin ends-->

<?php
include('partials/footer.php');
?>