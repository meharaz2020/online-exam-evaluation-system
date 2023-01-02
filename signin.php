
 
<?php
session_start();
ob_start();
include "admin/db.php";
if (isset($_SESSION['user_id'])) {
    header('Location: admin/dashboard.php');
}

?>
 






 


<!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sikkha</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.html">
    <link rel="shortcut icon" type="image/x-icon" href="index/img/logo/logo.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="index/css/bootstrap.min.css">
    <link rel="stylesheet" href="index/css/owl.carousel.min.css">
    <link rel="stylesheet" href="index/css/animate.min.css">
    <link rel="stylesheet" href="index/css/magnific-popup.css">
    <link rel="stylesheet" href="index/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="index/css/themify-icons.css">
    <link rel="stylesheet" href="index/css/slick.css">
    <link rel="stylesheet" href="index/css/meanmenu.css">
    <link rel="stylesheet" href="index/css/default.css">
    <link rel="stylesheet" href="index/css/style.css">
    <link rel="stylesheet" href="index/css/responsive.css">
    <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
     
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="admin/image/Escool.png" />
    <style>
        .error {
            color: red;
            font-style: italic;

            font-weight: bold;

        }
    </style>
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- Add your site or application content here -->
    <!-- header-start -->
    <header id="home">
        <div class="header-area">
            <!-- header-top -->
            <div class="header-top primary-bg" style="height:50px;padding:16px;">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="header-contact-info d-flex">
                                <div class="header-contact header-contact-phone">
                                    <span class="ti-headphone"></span>
                                    <p class="phone-number">+0123456789</p>
                                </div>
                                <div class="header-contact header-contact-email">
                                    <span class="ti-email"></span>
                                    <p class="email-name">esikkha@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="header-social-icon-list">
                                <ul>
                                    <li><a style="text-decoration:none;"href="#"><span class="ti-facebook"></span></a></li>
                                    <li><a style="text-decoration:none;"href="#"><span class="ti-twitter-alt"></span></a></li>
                                    <li><a style="text-decoration:none;"href="#"><span class="ti-dribbble"></span></a></li>
                                    <li><a style="text-decoration:none;"href="#"><span class="ti-google"></span></a></li>
                                    <li><a style="text-decoration:none;"href="#"><span class="ti-pinterest"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /end header-top -->
            <!-- header-bottom -->
            <div class="header-bottom-area header-sticky" style="transition: .6s;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2 col-md-6 col-6">
                            <div class="logo">
                                <a href="index.php">
                                <img src="index/img/310182337_783307596233828_2070287894972276206_n.png" style="height:70px;width:90px" alt="">
                                 </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-6 col-6">
                            <div class="header-bottom-icon f-right">

                            </div>
                            <div class="main-menu f-right">
                                <nav id="mobile-menu" style="display: block;">
                                    <ul>
                                        <li>
                                            <a style="text-decoration:none;" href="index.php">Home</a>

                                        </li>
                                        <li>
                                            <a style="text-decoration:none;"href="index/about_us.php">About Us</a>

                                        </li>                                       


                                        <li>
                                            <a style="text-decoration:none;"href="index/faq.php">Faq</a>
                                        </li>
                                        <li>
                                            <a style="text-decoration:none;"href="index/contact_us.php">Contact Us</a>
                                        </li>
                                        <li>
                                            <a style="text-decoration:none;"href="signin.php">sign in</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile-menu"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /end header-bottom -->
        </div>
    </header>
    <!-- header-end -->
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                          
                            <h4 class="text-center">Welcome! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <?php include "index/message.php"; ?>

                            <div class="col-sm-12  col-lg-12" style="text-align:center;">
                                 
                            </div>
                            <form class="pt-3" action="index/backend/signin.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" name="uname" autocomplete="off" placeholder="Username or ID">
                                </div>
                                

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="id_password" name="pass" autocomplete="off" placeholder="Password" name="password" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-gradient-primary" style="padding-bottom:22px;" type="button"> <i id="togglePassword" class="mdi mdi-eye"></i></button>
                                        </div>
                                    </div>
                                </div>
                             

                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input" name="checked"> Keep me signed in </label>
                                </div>
                                

                                <div class="mt-3">
                                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" name="signin">SIGN IN</button>
                                </div>
                                <!-- <div class="my-2 d-flex justify-content-last align-items-center">

                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div> -->

                                <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.php" class="text-primary" style="text-decoration:none;">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
  

    <!-- footer start -->
    <footer id="Contact">
        <div class="footer-area primary-bg pt-150">
            <div class="container">
                <div class="footer-top pb-35">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="footer-widget mb-30">
                                <div class="footer-logo">
                                    <!-- <img src="" style="height:35px;width:80px;" alt=""> -->
                                </div>
                                <div class="footer-para">
                                    <p>Sorem ipsum dolor sit amet conse ctetur adipiscing elit, sed do eiusmod incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nostrud exercition ullamco laboris nisi </p>
                                </div>
                                <div class="footer-socila-icon">
                                    <span>Follow Us</span>
                                    <div class="footer-social-icon-list">
                                        <ul>
                                            <li><a style="text-decoration:none;"href="#"><span class="ti-facebook"></span></a></li>
                                            <li><a style="text-decoration:none;"href="#"><span class="ti-twitter-alt"></span></a></li>
                                            <li><a style="text-decoration:none;"href="#"><span class="ti-dribbble"></span></a></li>
                                            <li><a style="text-decoration:none;"href="#"><span class="ti-google"></span></a></li>
                                            <li><a style="text-decoration:none;"href="#"><span class="ti-pinterest"></span></a></li>
                                            <li><a style="text-decoration:none;"href="#"><span class="ti-instagram"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="footer-widget mb-30">
                                <div class="footer-heading">
                                    <h1>Quick Links</h1>
                                </div>
                                <div class="footer-menu clearfix">
                                    <ul>
                                        <li><a style="text-decoration:none;"href="#">Privacy Policy</a></li>
                                        <li><a style="text-decoration:none;"href="#">Condition</a></li>
                                        <li><a style="text-decoration:none;"href="#">Support</a></li>
                                        <li><a style="text-decoration:none;"href="#">Consultation</a></li>
                                        <li><a style="text-decoration:none;"href="#">Team Member</a></li>
                                        <li><a style="text-decoration:none;"href="#">Our Services</a></li>
                                        <li><a style="text-decoration:none;"href="#">About Us</a></li>
                                        <li><a style="text-decoration:none;"href="#">Contact Us</a></li>
                                        <li><a style="text-decoration:none;"href="#">Who we are</a></li>
                                        <li><a style="text-decoration:none;"href="#">Get a Quote</a></li>
                                        <li><a style="text-decoration:none;"href="#">Recent Post</a></li>
                                        <li><a style="text-decoration:none;"href="#">Who we are</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4  col-md-6">
                            <div class="footer-widget mb-30">
                                <div class="footer-heading">
                                    <h1>Contact Us</h1>
                                </div>
                                <div class="footer-contact-list">
                                    <div class="single-footer-contact-info">
                                        <span class="ti-headphone "></span>
                                        <span class="footer-contact-list-text">+003 (1234) 7894</span>
                                    </div>
                                    <div class="single-footer-contact-info">
                                        <span class="ti-email "></span>
                                        <span class="footer-contact-list-text">youremail@gmail.com</span>
                                    </div>
                                    <div class="single-footer-contact-info">
                                        <span class="ti-location-pin"></span>
                                        <span class="footer-contact-list-text">123 New Street, 6th Floor, New York</span>
                                    </div>
                                </div>
                                <div class="opening-time">
                                    <span>Opening Hour</span>
                                    <span class="opening-date">
                                        Sun - Sat : 10:00 am - 05:00 pm
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom pt-25 pb-25">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="footer-copyright text-center">
                                    <span>&copy; Escool 2022</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#id_password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="admin/assets/js/off-canvas.js"></script>
    <script src="admin/assets/js/hoverable-collapse.js"></script>
    <script src="admin/assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- JS here -->
    <script src="index/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="index/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="index/js/popper.min.js"></script>
    <script src="index/js/bootstrap.min.js"></script>
    <script src="index/js/owl.carousel.min.js"></script>
    <script src="index/js/isotope.pkgd.min.js"></script>
    <script src="index/js/one-page-nav-min.js"></script>
    <script src="index/js/slick.min.js"></script>
    <script src="index/js/ajax-form.js"></script>
    <script src="index/js/wow.min.js"></script>
    <script src="index/js/jquery.meanmenu.min.js"></script>
    <script src="index/js/jquery.scrollUp.min.js"></script>
    <script src="index/js/jquery.barfiller.js"></script>
    <script src="index/js/imagesloaded.pkgd.min.js"></script>
    <script src="index/js/jquery.counterup.min.js"></script>
    <script src="index/js/waypoints.min.js"></script>
    <script src="index/js/jquery.magnific-popup.min.js"></script>
    <script src="index/js/plugins.js"></script>
    <script src="index/js/main.js"></script>
</body>

 
 
    
     

 
     
    
 