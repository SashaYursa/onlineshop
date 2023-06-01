<?php

include "header.php";
include "db.php";
$userID = 0;
if (isset($_SESSION['uid'])) {
    $userID = $_SESSION['uid'];
} else {
    return;
}
$sql = "SELECT * FROM user_info WHERE `user_id` = $userID";
$run_query = mysqli_query($con, $sql);
$user = mysqli_fetch_array($run_query);
$sql = "SELECT COUNT(order_id) as order_count FROM orders_info WHERE orders_info.user_id = $userID";
$run_query = mysqli_query($con, $sql);
$ordersCount = mysqli_fetch_array($run_query);
$sql = "SELECT * FROM orders_info WHERE orders_info.user_id = $userID";
$run_query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($run_query)) {
    $orders[] = $row;
}
foreach ($orders as $key => $order) {
    $orders[$key]['order-info'] = getOrdersData($order['order_id'], $con);
}
function getOrdersData($orderID, $con)
{
    $sql = "SELECT * FROM `order_products` LEFT JOIN products ON products.product_id = order_products.product_id WHERE order_products.order_id = $orderID";
    $run_query = mysqli_query($con, $sql);
    if (mysqli_num_rows($run_query) > 0) {
        $res = [];
        while ($row = mysqli_fetch_array($run_query)) {
            $res[] = $row;
        }
        return $res;
    }
}

?>

<style>
    body {
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    }

    table, th {
        text-align: center;
    }

    .emp-profile {
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }

    .profile-img {
        text-align: center;
    }

    .profile-head > h5 {
        font-size: 18px;
    }

    .profile-img img {
        width: 70%;
        height: 100%;
    }

    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }

    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .profile-head h5 {
        color: #333;
    }

    .profile-head h6 {
        color: #0062cc;
    }

    .profile-edit-btn {
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }

    .proile-rating {
        font-size: 16px;
        color: #000;
        margin-top: 5%;
    }

    .proile-rating span {
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }

    .profile-head .nav-tabs {
        margin-top: 45px;
    }

    .profile-head .nav-tabs .nav-link {
        font-weight: 600;
        border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
        border: none;
        border-bottom: 2px solid #0062cc;
    }

    .profile-work {
        padding: 14%;
        margin-top: -15%;
    }

    .profile-work p {
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }

    .profile-work a {
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-work ul {
        list-style: none;
    }

    .profile-tab label {
        font-weight: 600;
    }

    .profile-tab p {
        font-weight: 600;
        color: #0062cc;
    }

    .orders {
        width: 100%;
    }

    .outer-table > tr > td, .outer-table > tr > th {
        vertical-align: middle !important;
        font-size: 20px;
    }

    @import url('https://fonts.googleapis.com/css?family=Assistant');

    body {
        background: #eee;
        font-family: Assistant, sans-serif;
    }

    .cell-1 {
        border-collapse: separate;
        border-spacing: 0 4em;
        background: #fff;
        border-bottom: 5px solid transparent;
        /*background-color: gold;*/
        background-clip: padding-box;
    }

    thead {
        background: #dddcdc;
    }

    .toggle-btn {
        width: 40px;
        height: 21px;
        background: grey;
        border-radius: 50px;
        padding: 3px;
        cursor: pointer;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn > .inner-circle {
        width: 15px;
        height: 15px;
        background: #fff;
        border-radius: 50%;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn.active {
        background: blue !important;
    }

    .toggle-btn.active > .inner-circle {
        margin-left: 19px;
    }

    .order-item {
        display: flex;
    }

    .order-image {
        width: 100px;
    }

    .product-title {
    }

    .product-price {
    }
</style>

<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="img/user.png" alt=""/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        <?= $user['first_name'] . ' ' . $user['last_name'] ?>
                    </h5>
                    <p class="proile-rating">Замовлень : <span><?= $ordersCount[0] ?></span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" role="tab" aria-controls="home"
                               aria-selected="true">Дані</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $user['email'] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Мобільний телефон</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $user['mobile'] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Адреса</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $user['address1'] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Місто</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $user['address2'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10 orders">
            <div class="rounded">
                <div class="table-responsive table-borderless">
                    <table class="table ">
                        <thead class="outer-table">
                        <tr>
                            <th>Номер замовлення</th>
                            <th>Товари</th>
                            <th>Поштовий індекс</th>
                            <th>Ціна</th>
                            <th>Картка</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="table-body outer-table">
                        <?php
                        $i = 1;
                        foreach (
                            $orders

                            as $order
                        ) : ?>
                            <tr class="cell-1">
                                <td><strong><?= $i ?></strong></td>
                                <td>
                                    <div class="order-items">

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Зображення</th>
                                                <th>Назва</th>
                                                <th>Ціна</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($order['order-info'] as $product) : ?>
                                                <tr class="cell-1">
                                                    <td><img class="order-image"
                                                             src="/product_images/<?= $product['product_image'] ?>"/>
                                                    </td>
                                                    <td>
                                                        <p class="product-title"><?= $product['product_title'] ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="product-price"><?= $product['product_price'] . 'грн' ?></p>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td><?= $order['zip'] ?></td>
                                <td><?= $order['total_amt'] . 'грн' ?></td>
                                <td><?= $order['cardnumber'] ?></td>
                            </tr>

                            <?php
                            $i++;
                        endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php"; ?>
