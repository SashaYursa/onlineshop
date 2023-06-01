<?php

session_start();
include("../db.php");
$product_id = $_GET['product_id'];

$result = mysqli_query(
    $con,
    "SELECT product_id,product_cat,product_desc,product_brand,product_title,product_price,product_image,product_keywords from products where product_id = $product_id"
) or die ("query 1 incorrect.......");

list($product_id, $product_cat, $product_desc, $product_brand, $product_title, $product_price, $product_image, $product_keywords) = mysqli_fetch_array(
    $result
);
$categories = [];
$categoriesQuery = mysqli_query(
    $con,
    "SELECT * FROM `categories`"
);

while ($row = mysqli_fetch_array($categoriesQuery)) {
    $categories[] = $row;
}
$brands = [];
$brandsQuery = mysqli_query(
    $con,
    "SELECT * FROM `brands`"
);
while ($row = mysqli_fetch_array($brandsQuery)) {
    $brands[] = $row;
}
if (isset($_POST['btn_save'])) {
    $product_title = $_POST['product_name'];
    $product_desc = $_POST['product_desc'];
    $product_cat = $_POST['categories'];
    $product_brand = $_POST['brands'];
    $product_price = $_POST['product_price'];
    $product_keywords = $_POST['product_keywords'];
    $product_id = $_POST['product_id'];
//picture coding
    if (!empty($_FILES['picture']['name'])) {
        $picture_name = $_FILES['picture']['name'];

        $picture_type = $_FILES['picture']['type'];
        $picture_tmp_name = $_FILES['picture']['tmp_name'];
        $picture_size = $_FILES['picture']['size'];
        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif") {
            if ($picture_size <= 50000000) {
                $product_image = time() . "_" . $picture_name;
            }
            move_uploaded_file($picture_tmp_name, "../product_images/" . $product_image);
        }
    }
    mysqli_query(
        $con,
        "update products set 
                    `product_title`='$product_title', 
                    `product_desc`='$product_desc', 
                    `product_cat`='$product_cat', 
                    `product_brand`='$product_brand', 
                    `product_price`='$product_price', 
                    `product_image`='$product_image', 
                    `product_keywords`= '$product_keywords' 
                where `product_id`=$product_id"
    ) or die("Query 2 is inncorrect..........");

    header("location: productlist.php");
    mysqli_close($con);
}
include "sidenav.php";
include "topitems.php";
?>
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-5 mx-auto">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h5 class="title">Edit User</h5>
                    </div>
                    <form action="" name="form" method="post" enctype="multipart/form-data">
                        <div class="card-body">

                            <input type="hidden" name="product_id" id="user_id" value="<?php
                            echo $product_id; ?>"/>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Назва</label>
                                    <input type="text" id="product_name" name="product_name" class="form-control"
                                           value="<?php
                                           echo $product_title; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Опис</label>
                                    <textarea style="min-height: 150px" type="text" id="product_desc"
                                              name="product_desc"
                                              class="form-control"
                                    ><?php
                                        echo $product_desc; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Категорія товару</label>
                                    <select style="margin-top: 10px; background-color: #972fb9; color: #fff"
                                            class="custom-select" name="categories" id="product_cat">
                                        <?php
                                        foreach (
                                            $categories

                                            as $category
                                        ) : ?>
                                            <option value="<?= $category['cat_id'] ?>"
                                                <?php
                                                if ($category['cat_id'] == $product_cat) echo 'selected' ?>>
                                                <?= $category['cat_title'] ?>
                                            </option>
                                        <?php
                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Бренд товару</label>
                                    <select style="margin-top: 10px; background-color: #972fb9; color: #fff"
                                            class="custom-select" name="brands" id="brand">
                                        <?php
                                        foreach ($brands as $brandItem) : ?>
                                            <option
                                                    value="<?= $brandItem['brand_id'] ?>"
                                                <?php
                                                if ($brandItem['brand_id'] == $product_brand) echo 'selected' ?>>
                                                <?= $brandItem['brand_title'] ?>
                                            </option>
                                        <?php
                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="">
                                    <label for="">Фото</label>
                                    <input type="file" name="picture" class="btn btn-fill btn-success"
                                           id="picture">
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Ціна</label>
                                    <input type="text" name="product_price" id="product_price" class="form-control"
                                           value="<?php
                                           echo $product_price; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Ключові слова</label>
                                    <input type="text" name="product_keywords" id="product_keywords"
                                           class="form-control"
                                           value="<?php
                                           echo $product_keywords; ?>">
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="submit" id="" name="btn_save" class="btn btn-fill btn-primary">Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
<?php
include "footer.php";
?>