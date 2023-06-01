<?php

session_start();
include("../db.php");
include "sidenav.php";
$errors = [];
$first_name = '';
$email = '';
if (isset($_POST['btn_save'])) {
    $first_name = htmlspecialchars($_POST['first_name']);
    $email = htmlspecialchars(strval($_POST['email']));
    $user_password = htmlspecialchars(md5($_POST["password"]));

    if (issetParam('user_info', 'first_name', $first_name, $con)) {
        $errors[] = 'Користувач з таким логіном вже існує';
    }
    if (issetParam('user_info', 'email', $email, $con)) {
        $errors[] = 'Користувач з такою поштою вже існує';
    }
    if (issetParam('admin_info', 'admin_name', $first_name, $con)) {
        $errors[] = 'Адмін з таким логіном вже існує';
    }
    if (issetParam('admin_info', 'admin_email', $email, $con)) {
        $errors[] = 'Адмін з такою поштою вже існує';
    }
    if (empty($errors)) {
        $sql = "INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES (NULL, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $first_name, $email, $user_password);
        $stmt->execute();
        mysqli_close($con);
        header("Location: ../admin");
    }
}

function issetParam($table, $param, $val, $con)
{
    $result = mysqli_query(
        $con,
        "SELECT `$table`.* FROM `$table` WHERE `$param` = '$val'"
    );
//    $sql = "SELECT * FROM ${table} WHERE ${param} = ${$val}";
//    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}

?>

    <div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="javascript:void(0)">Admin</a>

            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">person</i>

                            <p class="d-lg-none d-md-block">
                                Some Actions
                            </p>
                        </a>

                    </li>
                    <!-- your navbar here -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="content ">
        <div class="container">
            <!-- your content here -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Додати адміністратора</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" name="form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Ім'я</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control"
                                               required value="<?= $first_name ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" required
                                               value="<?= $email ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Пароль</label>
                                        <input type="password" id="password" name="password" class="form-control"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <ul class="list-group">
                                        <?php
                                        foreach ($errors as $error): ?>
                                            <li class="list-group-item text-danger"><?= $error ?></li>
                                        <?php
                                        endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right">
                                Створити адміністратора
                            </button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>