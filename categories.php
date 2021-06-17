<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //Display all catagories from database;
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

            $res = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($res);

            if($count>0)
                {
                    //Category available;
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //Get the values like id,title,image_name;
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="category-foods.html">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Display message;
                                        echo "Image not available";
                                    }
                                    else
                                    {
                                        //Image available;
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }
                else
                {
                    //Category not available;
                    echo "Category not added!";
                }
            
            ?>

            <!-- <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="images/pizza.jpg" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Pizza</h3>
            </div>
            </a> -->
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>