<?php include('partials/menu.php'); ?>
        <!--Main-Content Sectin starts-->
        <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
                <br/>
                <br/>

            <?php
            
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
            <br/><br/><br/>
                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>Title:</td>
                            <td><input type="text" name="title" placeholder="Category Title "></td>
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
                            
                            <td colspan="2"><input type="submit" name="submit" value="Add Category" class="btn-primary"></td>
                        </tr>
                    </table>
                </form>
            <div class="clearfix"></div>
            <?php
            //check clicked or not;
            if(isset($_POST['submit']))
            {
                //echo "Button clicked";
                //get the value from form;
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

                //sql to insert

                $sql="INSERT INTO tbl_category SET 
                title='$title',
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
            }
            ?>

        </div>
    </div>
    <!--Main-content Sectin ends-->


<?php include('partials/footer.php'); ?>