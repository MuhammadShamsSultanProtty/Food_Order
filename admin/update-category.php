<?php include('partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br/><br/>

        <?php
            if(isset($_GET['id']))
            {
               // echo "Getting the data";
               $id=$_GET['id'];

               $sql="SELECT * FROM tbl_category WHERE id=$id";

               $res=mysqli_query($conn,$sql);

               $count=mysqli_num_rows($res);

               if($count==1)
               {
                  // echo "Admain Available";
                  $row=mysqli_fetch_assoc($res);

                  $title = $row['title'];
                  $current_image = $row['image_name'];
                  $featured = $row['featured'];
                  $active = $row['active'];
               }
               else{
                   $_SESSION['no-category-found']="Category not found";
                   header('location:'.SITEURL.'admin/manage-category.php');
               }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

<form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Title:</td>
                            <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                        </tr>

                        <tr>
                            <td>Current Image:</td>
                            <td>
                            <?php
                                if($current_image!="")
                                {
                                    //display img
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>"width="150px" alt="">
                                    <?php
                                }
                                else
                                {
                                    //display msg
                                    echo "Image not aded yet!";
                                }
                            ?> 
                            </td>
                        </tr>

                        <tr>
                            <td>New Image:</td>
                            <td>
                            <input type="file" name="image" id="">
                            </td>
                        </tr>

                        <tr>
                            <td>Featured:</td>
                            <td>
                            <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes 
                            <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                            </td>
                        </tr>

                        <tr>
                            <td>Active:</td>
                            <td>
                            <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes 
                            <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No">No
                            </td>
                        </tr>  

                        <tr>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <td colspan="2"><input type="submit" name="submit" value="Update Category" class="btn-primary"></td>
                        </tr>
                    </table>
                </form>

 <?php

    if(isset($_POST['submit']))
    {
     // echo "Clicked";
     //1.Get all the values;
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //updating img if selected;
        if(isset($_FILES['image']['name']))
        {
            //Get the Image details;
            $image_name = $_FILES['image']['name'];
            if($image_name != "")
            {
                //image available;
                //upload the new image;
                

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
                    header('location:'.SITEURL.'admin/manage-category.php');
                    die();
                }
                //remove the current image;
                if($current_image!="")
                {
                    $remove_path = "../images/category/".$current_image;

                    $remove = unlink($remove_path);
                    //chech whether the image removed or not
                    if($remove==false)
                    {
                        $_SESSION['failed-remove'] = "<div class='error'>Failed to remove image!</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
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
        //update database
        //sql
        $sql2="UPDATE tbl_category SET
        title ='$title',
        image_name='$image_name',
        featured ='$featured',
        active = '$active'
        WHERE id='$id'
        ";
        //execute
        $res2 = mysqli_query($conn,$sql2);

        //redirect to manage category with msg
        //checking

        if($res2==true)
        {
            $_SESSION['update']="<div class='sucess'>Category updated successfully</div>";
            header("Location:".SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['update']="sorry failed to update ";
            header("Location:".SITEURL.'admin/manage-category.php');
        }
    }

?>
    </div>
</div>










<?php /*

if(isset($_POST['submit']))
{
    //echo "Button clicked";
    //get values
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    //sql to update
    $sql="UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id='$id'
    ";
    $res=mysqli_query($conn,$sql);

    //checking
    if($res==true)
    {
        $_SESSION['update']="Admin updated successfully";
        header("Location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['update']="sorry failed to update ";
        header("Location:".SITEURL.'admin/manage-admin.php');
    }
}*/
?>

<?php
include('partials/footer.php');
?>