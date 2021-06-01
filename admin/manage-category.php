<?php
include('partials/menu.php');
?>

    <!--Main-Content Sectin starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Category Management</h1>
            
            <br/><br/>

            <?php
            
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
            <br/><br/>

                <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Catagory</a>
            <br/><br/>
            <table class="tbl-full">
                <tr>
                    <th>S.L</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                $sn=1;
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                        ?>

                            <tr>
                            <td><?php echo $sn++?></td>
                            <td><?php echo $title?></td>

                            <td>
                                <?php 
                                   if($image_name!="")
                                   {
                                      ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" width="100px">
                                      <?php
                                   } 
                                   else
                                   {
                                    echo "Image not added!";
                                   }
                                ?>
                            </td>

                            <td><?php echo $featured?></td>
                            <td><?php echo $active?></td>
                            <td>
                                <a href="#" class="btn-secondary">Update Category</a>
                                <a href="#" class="btn-danger">Delet Category</a>
                            </td>
                            </tr>

                        <?php


                    }
                }
                else
                {
                    ?>

                    <tr>
                        <td colspan="6">No category added!</td>
                    </tr>

                    <?php
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