<?php
session_start();
ob_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: ../signin.php');
}
$user = $_SESSION['user_id'];

?>
<?php

$user_name = mysqli_query($db, "SELECT * FROM users WHERE id = '$user'");

$userData = mysqli_fetch_assoc($user_name);
$fn = $userData['name'];
$role = $userData['role'];
$image = $userData['image'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
    $fr = new format();

    class format
    {
        public function title()
        {
            $path = $_SERVER['SCRIPT_FILENAME'];
            $title = basename($path, '.php');
            if ($title == 'index') {
                $title = 'home';
            } elseif ($title == 'contact') {
                $title = 'contact';
            } elseif ($title == 'profile') {
                $td = 'profile';
            }
            return ucwords($title);
        }
    }
    $datatittle = $fr->title()

    ?>
    <title> <?php echo  $datatittle; ?> - <?php
                                            $path = $_SERVER['SCRIPT_FILENAME'];
                                            $titlee = basename($path, '.php');
                                            if ($titlee == 'profile') {
                                                echo $fn;
                                            } else {
                                                echo "Esikkha";
                                            } ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <script src="assets/js/jquery.js"></script>

    <link rel="shortcut icon" href="../admin/image/Escool.png" />
</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="teacherdashboard.php"><img style="height: 60px;" src="../index/img/310182337_783307596233828_2070287894972276206_n.png" alt="logo" /></a>

                <a class="navbar-brand brand-logo-mini" href="teacherdashboard.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <!-- <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                        </div>
                    </form>
                </div> -->
                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>


                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="logout.php">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                    <!-- <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li> -->
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <?php if (!$image == "") { ?>
                                    <img src="../admin/image/photo/<?php echo  $userData['image']; ?>" alt="image">
                                <?php   } ?>
                                <?php if ($image == "") { ?>
                                    <img src="../admin/image/photo/default.jpg">
                                <?php   } ?>
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black"><?php echo $fn; ?></p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="profile.php">
                                <i class="mdi mdi-face me-2 text-success"></i> Profile </a>
                            <div class="dropdown-divider"></div>

                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <?php
        ob_end_flush();
        ?>