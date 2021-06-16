<?php include('partials/menu.php'); ?>
<?php

//echo "Delete page";

    //include('../config/constants.php');
    //echo "Delete food";
    //checking;
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //echo 'Get value and delete';
        $id=$_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../images/food/".$image_name;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove']="Failed to remove Image!";

                header('location:'.SITEURL.'admin/manage-food.php');

                die();
            }
        }

        $sql="DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        //check
        if($res==true)
        {
            $_SESSION['delete']="Food deleted successfully!";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete']="Failed to delete Food!";
            header('location:'.SITEURL.'admain/manage-food.php');
        }
    }
    else
    {
        $_SESSION['delete']="Unauthorized Access!";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>