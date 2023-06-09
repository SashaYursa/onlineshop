<div class="main main-raised">
    <div class="container mainn-raised" style="width:100%;">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->


            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                <div class="item active">
                    <img src="img/banner1.png" alt="Los Angeles" style="width:100%;">
                </div>
                <div class="item">
                    <img src="img/banner1.png" alt="Los Angeles" style="width:100%;">
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control _26sdfg" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Попередній</span>
                </a>
                <a class="right carousel-control _26sdfg" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Далі</span>
                </a>
            </div>
        </div>


        <!-- SECTION -->
        <div class="section mainn mainn-raised">


            <!-- container -->
            <div class="container">

                <!-- row -->
                <div class="row">
                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <a href="product.php?p=78">
                            <div class="shop">
                                <div class="shop-img">
                                    <img src="./img/Chavun112.png" alt="">
                                </div>
                                <div class="shop-body">
                                    <h3>Казани<br>Чавунні</h3>
                                    <a href="product.php?p=78" class="cta-btn">Здійснити покупку<i
                                                class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- /shop -->

                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <a href="product.php?p=72">
                            <div class="shop">
                                <div class="shop-img">
                                    <img src="./img/chavun2.png" alt="">
                                </div>
                                <div class="shop-body">
                                    <h3>Чавунні<br>Каструлі</h3>
                                    <a href="product.php?p=72" class="cta-btn">Здійснити покупку<i
                                                class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- /shop -->

                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <a href="product.php?p=79">
                            <div class="shop">
                                <div class="shop-img">
                                    <img src="./img/chavun3.png" alt="">
                                </div>
                                <div class="shop-body">
                                    <h3>Сковорідки<br>Чавунні</h3>
                                    <a href="product.php?p=79" class="cta-btn">Здійснити покупку<i
                                                class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- /shop -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->


        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">

                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">
                                Новинки
                            </h3>
                        </div>
                    </div>
                    <!-- /section title -->

                    <!-- Products tab & slick -->
                    <div class="col-md-12 mainn mainn-raised">
                        <div class="row">
                            <div class="products-tabs">
                                <!-- tab -->
                                <div id="tab1" class="tab-pane active">
                                    <div class="products-slick" data-nav="#slick-nav-1">

                                        <?php
                                        include 'db.php';

                                        $product_query = "SELECT products.*, categories.cat_title as category  FROM `products` LEFT JOIN `categories` ON `categories`.`cat_id` = `products`.`product_cat` ORDER BY product_id DESC LIMIT 10 OFFSET 0 ";
                                        $run_query = mysqli_query($con, $product_query);
                                        if (mysqli_num_rows($run_query) > 0) {
                                            while ($row = mysqli_fetch_array($run_query)) {
                                                $pro_id = $row['product_id'];
                                                $pro_cat = $row['product_cat'];
                                                $pro_brand = $row['product_brand'];
                                                $pro_title = $row['product_title'];
                                                $pro_price = $row['product_price'];
                                                $pro_image = $row['product_image'];

                                                $cat_name = $row["category"];

                                                echo "
				
                        
                                
								<div class='product'>
									<a href='product.php?p=$pro_id'><div class='product-img'>
										<img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>$pro_price</h4>
										<div class='product-rating'>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
										</div>
										<div class='product-btns'>
										
										</div>
									</div>
									<div class='add-to-cart'>
										<button pid='$pro_id' id='product' class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i> додати в кошик</button>
									</div>
								</div>
                               
							
                        
			";
                                            };
                                        }
                                        ?>
                                        <!-- product -->


                                        <!-- /product -->


                                        <!-- /product -->
                                    </div>
                                    <div id="slick-nav-1" class="products-slick-nav"></div>
                                </div>
                                <!-- /tab -->
                            </div>
                        </div>
                    </div>
                    <!-- Products tab & slick -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->

        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">

                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title"></h3>
                        </div>
                    </div>
                    <!-- /section title -->

                    <!-- Products tab & slick -->
                    <div class="col-md-12 mainn mainn-raised">
                        <div class="row">
                            <div class="products-tabs">
                                <!-- tab -->
                                <div id="tab2" class="tab-pane fade in active">
                                    <div class="products-slick" data-nav="#slick-nav-2">
                                        <!-- product -->
                                        <?php
                                        include 'db.php';

                                        $product_query = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_id BETWEEN 59 AND 65";
                                        $run_query = mysqli_query($con, $product_query);
                                        if (mysqli_num_rows($run_query) > 0) {
                                            while ($row = mysqli_fetch_array($run_query)) {
                                                $pro_id = $row['product_id'];
                                                $pro_cat = $row['product_cat'];
                                                $pro_brand = $row['product_brand'];
                                                $pro_title = $row['product_title'];
                                                $pro_price = $row['product_price'];
                                                $pro_image = $row['product_image'];

                                                $cat_name = $row["cat_title"];

                                                echo "
				
                        
                                
								<div class='product'>
									<a href='product.php?p=$pro_id'><div class='product-img'>
										<img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
										<div class='product-label'>
											<span class='new'>NEW</span>
										</div>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<div class='product-rating'>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
										</div>
									</div>
									<div class='add-to-cart'>
										<button pid='$pro_id' id='product' class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i> Додати до кошику</button>
									</div>
								</div>
                               
							
                        
			";
                                            };
                                        }
                                        ?>

                                        <!-- /product -->
                                    </div>
                                    <div id="slick-nav-2" class="products-slick-nav"></div>
                                </div>
                                <!-- /tab -->
                            </div>
                        </div>
                    </div>
                    <!-- /Products tab & slick -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->

        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-4 col-xs-6">
                        <div class="section-title">
                            <h4 class="title">Топ продажів</h4>
                            <div class="section-nav">
                                <div id="slick-nav-3" class="products-slick-nav"></div>
                            </div>
                        </div>


                        <div class="products-widget-slick" data-nav="#slick-nav-3">
                            <div id="get_product_home">
                                <!-- product widget -->

                                <!-- product widget -->
                            </div>

                            <div id="get_product_home2">
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- /product widget -->

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- /product widget -->

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- product widget -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-6">
                        <div class="section-title">
                            <h4 class="title">Топ продажів</h4>
                            <div class="section-nav">
                                <div id="slick-nav-4" class="products-slick-nav"></div>
                            </div>
                        </div>

                        <div class="products-widget-slick" data-nav="#slick-nav-4">
                            <div>
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- /product widget -->

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- /product widget -->

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- product widget -->
                            </div>

                            <div>
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- /product widget -->

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- /product widget -->

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- product widget -->
                            </div>
                        </div>
                    </div>

                    <div class="clearfix visible-sm visible-xs">

                    </div>

                    <div class="col-md-4 col-xs-6">
                        <div class="section-title">
                            <h4 class="title">Топ продажів</h4>
                            <div class="section-nav">
                                <div id="slick-nav-5" class="products-slick-nav"></div>
                            </div>
                        </div>

                        <div class="products-widget-slick" data-nav="#slick-nav-5">
                            <div>
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- /product widget -->

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- /product widget -->

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- product widget -->
                            </div>

                            <div>
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- /product widget -->


                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- /product widget -->

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/" alt="">
                                    </div>
                                    <div class="product-body">

                                    </div>
                                </div>
                                <!-- product widget -->
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->
    </div>
		