<?php include('partials/menu.php'); ?>
<?php
    //include('../config/constants.php');
    //echo "Delete category";
    //checking;
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //echo 'Get value and delete';
        $id=$_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../images/category/".$image_name;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove']="Failed to remove category!";

                header('location:'.SITEURL.'admin/manage-category.php');

                die();
            }
        }

        $sql="DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        //check
        if($res==true)
        {
            $_SESSION['delete']="Category deleted successfully!";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete']="Failed to delete Category!";
            header('location:'.SITEURL.'admain/manage-category.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>