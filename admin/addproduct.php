<?php

session_start();
include("../db.php");

$categories;
$brands;

if (isset($_POST['btn_save'])) {
    $product_name = $_POST['product_name'];
    $details = $_POST['details'];
    $price = $_POST['price'];
    $product_type = $_POST['categories'];
    $brand = $_POST['brands'];
    $tags = $_POST['tags'];

    //picture coding
    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif") {
        if ($picture_size <= 50000000) {
            $pic_name = time() . "_" . $picture_name;
        }
        move_uploaded_file($picture_tmp_name, "../product_images/" . $pic_name);

        mysqli_query(
            $con,
            "insert into products (product_cat, product_brand,product_title,product_price, product_desc, product_image,product_keywords) values ('$product_type','$brand','$product_name','$price','$details','$pic_name','$tags')"
        ) or die("query incorrect");

        header("location: sumit_form.php?success=1");
    }

    mysqli_close($con);
} else {
    $sqlCategories = "SELECT * FROM categories";
    $sqlBrands = "SELECT * FROM brands";
    $catQuery = mysqli_query($con, $sqlCategories);
    while ($row = mysqli_fetch_array($catQuery)) {
        $categories[] = $row;
    }

    $brandsQuery = mysqli_query($con, $sqlBrands);
    while ($row = mysqli_fetch_array($brandsQuery)) {
        $brands[] = $row;
    }
}
include "sidenav.php";
include "topitems.php";
?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
            <div class="row">


                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Додати продукт</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Назва продукту</label>
                                        <input type="text" id="product_name" required name="product_name"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="">Додати зображення</label>
                                        <input type="file" name="picture" required class="btn btn-fill btn-success"
                                               id="picture">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Опис</label>
                                        <textarea rows="4" cols="80" id="details" required name="details"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ціна</label>
                                        <input type="text" id="price" name="price" required class="form-control">
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Категорії</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Категорія продукту</label>
                                        <select style="margin-top: 10px; background-color: #972fb9; color: #fff"
                                                class="custom-select" name="categories"
                                                id="categories">
                                            <?php
                                            foreach ($categories as $category) : ?>
                                                echo $brands;
                                                <option value="<?= $category['cat_id'] ?>"><?= $category['cat_title'] ?></option>
                                            <?php
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Бренд продукту</label>
                                        <select style="margin-top: 10px; background-color: #972fb9; color: #fff"
                                                class="custom-select" name="brands" id="brand">
                                            <?php
                                            foreach ($brands as $brandItem) : ?>
                                                echo $brands;
                                                <option value="<?= $brandItem['brand_id'] ?>"><?= $brandItem['brand_title'] ?></option>
                                            <?php
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ключові слова продукту</label>
                                        <input type="text" id="tags" name="tags" required class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" id="btn_save" name="btn_save" required
                                    class="btn btn-fill btn-primary">Оновити продукт
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
<?php
include "footer.php";
?>
