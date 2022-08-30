<!DOCTYPE html>
<?php require('../config/function.php');
if ($LTT->site('bao_tri') == "ON") {
    header('Location: /');
    exit;
} ?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Đang Bao Trì!</title>
    <meta name="author" content="" />
    <meta name="keywords" content="soon, css3, template, html5 template" />
    <meta name="description" content="ukieBoy - Page Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Font Awesome -->
    <link type="text/css" media="all" href="/assets/bao-tri/assets/fonts/font-awesome-4.2.0/css/font-awesome.min.css?<?= rand(1, 10000000); ?>" rel="stylesheet" />
    <!-- Libs CSS -->
    <link type="text/css" media="all" href="/assets/bao-tri/assets/boostrap-files/css/bootstrap.min.css?<?= rand(1, 10000000); ?>" rel="stylesheet" />
    <!-- Animations -->
    <link type="text/css" media="all" href="/assets/bao-tri/assets/css/animate.css?<?= rand(1, 10000000); ?>" rel="stylesheet" />
    <!-- Template CSS -->
    <link type="text/css" media="all" href="/assets/bao-tri/assets/css/style.css?<?= rand(1, 10000000); ?>" rel="stylesheet" />
    <!-- Responsive CSS -->
    <link type="text/css" media="all" href="/assets/bao-tri/assets/css/respons.css?<?= rand(1, 10000000); ?>" rel="stylesheet" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/bao-tri/assets/img/favicons/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/bao-tri/assets/img/favicons/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/bao-tri/assets/img/favicons/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" href="/assets/bao-tri/assets/img/favicons/apple-touch-icon.png" />
    <link rel="shortcut icon" href="/assets/bao-tri/assets/img/favicons/favicon.png" />

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,800italic,800,700italic,700,600italic,600,400italic,300' rel='stylesheet' type='text/css' />
    <script data-n-head="ssr" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script data-n-head="ssr" src="https://code.iconify.design/1/1.0.5/iconify.min.js"></script>

</head>

<body>

    <!-- Load page -->
    <div class="animationload">
        <div class="loader"></div>
    </div>
    <!-- End load page -->


    <!-- Content Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <div class="navbar text-center">
                <div class="container">

                    <!-- menu -->
                    <nav id="navigation-menu" role="navigation">
                        <ul class="nav navbar-nav animated" data-animation="fadeIn" data-animation-delay="300">
                            <li><a class="active gohome">Home</a></li>

                            <li><a class="goabout">Về Chúng Tôi</a></li>
                            <li><a class="gocontact">Liên Hệ</a></li>
                            <li><a class="gofeatures">Cài Đặt</a></li>
                        </ul>
                    </nav>
                    <!-- end menu -->

                </div>
                <!-- end container -->
            </div>
        </header>
        <!-- end Header -->

        <!-- Carousel -->
        <section id="carousel" data-ride="carousel">
            <div class="container">
                <!-- carousel inner -->
                <div class="carousel-inner">

                    <!-- Stopwatch -->
                    <div class="stopwatch item active">

                        <!-- section watch -->
                        <div class="row">

                            <h3 class="text-baotri"> Đang Bảo Trì</h3>
                            <!-- End Watch -->

                        </div>

                        <!-- Home page -->
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="animated" data-animation="fadeIn" data-animation-delay="500">

                                    <h4 class="text-nho-bt">hệ thống đang bảo trì.</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="animated" data-animation="fadeIn" data-animation-delay="500">
                                    <div class="boy">
                                        <div class="sea_legs"></div>
                                        <div class="fisher"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Home page -->

                    </div>
                    <!-- end Stopwatch -->


                    <!-- Subscribe -->
                    <div class="subscribe item">

                        <!-- section title -->
                        <div class="row">
                            <div class="col-sm-12 text-center">

                            </div>
                        </div>

                        <!-- section text -->


                        <!-- section newsletter -->
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="footerbar animated" data-animation="fadeIn" data-animation-delay="500">
                                    <form name="subscribe-form" id="subscribe-form" method="post">
                                        <input type="text" name="email" id="subscribe-input" class="subscribe-input" value="" placeholder="Enter Your Email Address" />
                                        <input type="submit" class="subscribe-submit" id="subscribe-submit" value="Subscribe" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Subscribe -->


                    <!-- About Us -->
                    <div class="about-us item">

                        <!-- section title -->
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="titlebar">
                                    <h3 class="animated blue ntiendat-text-trang" data-animation="fadeIn" data-animation-delay="700">Dịch vụ chúng tôi cung cấp</h3>
                                    <div class="about-logo animated" data-animation="fadeIn" data-animation-delay="700"></div>
                                </div>
                            </div>
                        </div>

                        <!-- section text -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card"><br>
                                    <div class="card-body pb-5">
                                        <div class="pt-4 pb-5"> <img src="https://img.icons8.com/dusk/452/facebook--v1.png" class="img-fluid img-center" width="50px" alt="Illustration"> </div>
                                        <h5 class="h4 lh-130 mb-3">
                                            <center></center>
                                        </h5>
                                        <p class="text-muted mb-0">Chuyên cung cấp các dịch vụ tăng Like Facebook, Share, Comment, Follow Chất Lượng...</p><br>
                                    </div>
                                </div>
                            </div><br>
                            <div class="col-md-4">
                                <div class="card"> <br>
                                    <div class="card-body pb-5">
                                        <div class="pt-4 pb-5"> <img src="https://img.icons8.com/color/452/instagram-new--v1.png" class="img-fluid img-center" width="50px" alt="Illustration"> </div>
                                        <h5 class="h4 lh-130 mb-3">
                                            <center>Instagram</center>
                                        </h5>
                                        <p class="text-muted mb-0">Mang lại cho người dùng mội lượng tương tác thật, giúp tăng sự nổi tiếng của bạn.</p> <br>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-4">
                                <div class="card"> <br>
                                    <div class="card-body pb-5">
                                        <div class="pt-4 pb-5"> <img src="https://img.icons8.com/ios-filled/452/tiktok--v1.png" class="img-fluid img-center" width="50px" alt="Illustration"> </div>
                                        <h5 class="h4 lh-130 mb-3">
                                            <center>TikTok</center>
                                        </h5>
                                        <p class="text-muted mb-0">Tăng Tim, Follow, Comment một cách hiệu quả, giúp bạn có nhiều sự phát triển hơn.</p> <br>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end About Us -->


                    <!-- Contact Us -->
                    <div class="contact-us item">

                        <!-- section title -->


                        <!-- section text -->
                        <div class="container">
                            <div class="row justify-content-center text-center">
                                <div class="col-lg-12">

                                    <h3 class="title"><span class="font-weight-bold ntiendat-text-trang">Liên Hệ</span></h3>
                                    <div class="">

                                        <a href="<?= $LTT->site('facebook'); ?>"><img src="https://img.icons8.com/fluency/452/facebook-new.png" width="50px"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="https://zalo.me/<?= $LTT->site('phone_zalo'); ?>"><img src="https://img.icons8.com/color/452/zalo.png" width="50px"></a>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                    <!-- end Contact Us -->


                    <!-- Features -->
                    <div class="features item">

                        <!-- section title -->
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="titlebar">
                                    <h3 class="title"><span class="font-weight-bold ntiendat-text-trang">Đăng Nhập Trang Quản Trị</span></h3>
                                </div>
                            </div>
                        </div>

                        <!-- section text -->
                        <div class="card">
                            <br> <br>
                            <form novalidate="" role="form" action="" method="POST">
                                <div class="mb-3">
                                    <input class="form-control" name="username" type="text" placeholder="Nhập tài khoản" />
                                </div> <br>
                                <div class="mb-3">


                                    <input class="form-control" name="password" type="password" placeholder="Nhập mật khẩu" />
                                </div>
                                <br>
                                <div class="mb-3">
                                    <center><button class="btn btn-primary d-block w-100 mt-3" type="submit" name="login" id="log" onclick="log()">Đăng Nhập</button></center>
                                </div><br>
                            </form>
                            <?php
                            if (isset($_POST['login'])) {
                                if (empty(check_string($_POST['username'])) || empty(check_string($_POST['password']))) {
                                    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng nhập đủ thông tin !", "error");</script>';
                                } else {
                                    $usernamee = $_POST['username'];

                                    if (check_username(check_string($_POST['username'])) == false) {
                                        echo '<script type="text/javascript">swal("Thất Bại", "Nhập tài khoản hợp lệ", "error");</script>';
                                    } else {
                                        if (!$LTT->get_row(" SELECT * FROM `users` WHERE `username` = '" . check_string($_POST['username']) . "' AND  `url_config` = '" . $url_site_name . "' ")) {
                                            echo '<script type="text/javascript">swal("Thất Bại", "Tên đăng nhập không tồn tại !", "error");</script>';
                                        } else {
                                            $checkuseriui = $LTT->get_row(" SELECT * FROM `users` WHERE `username` = '" . check_string($_POST['username']) . "' AND `password` = '" . check_string(typepass($_POST['password'])) . "'  AND  `url_config` = '" . $url_site_name . "' ");
                                            $cap_bac = $checkuseriui['capbac'];
                                            if ($cap_bac !== "99") {
                                                echo '<script type="text/javascript">swal("Thất Bại", "Đăng nhập thất bại  !", "error");</script>';
                                            } else {
                                                if (!$checkuseriui) {
                                                    echo '<script type="text/javascript">swal("Thất Bại", "Mật khẩu không chính xác !", "error");</script>';
                                                } else {
                                                    if ($LTT->get_row(" SELECT * FROM `users` WHERE `username` = '" . check_string($_POST['username']) . "' AND `banned` > '1' ")) {
                                                        echo '<script type="text/javascript">swal("Thất Bại", "Tài Khoản Đã Bị Band !", "error");</script>';
                                                    } else {

                                                        $remember = check_string($_POST['remember']);
                                                        if ($remember == 'on') {
                                                        }

                                                        $LTT->update("users", [
                                                            'lastdate' => gettime()
                                                        ], " `username` = '" . check_string($_POST['username']) . "'  AND  `url_config` = '" . $url_site_name . "' ");

                                                        $_SESSION['username'] = check_string($_POST['username']);
                                                        echo '<script type="text/javascript">swal("Thành Công", "Đăng Nhập Thành Công !", "success");setTimeout(function(){ window.location.href = "/Admin-Website"});</script>';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            ?>


                        </div>


                    </div>
                    <!-- end Features -->

                </div>
                <!-- end carousel-inner -->
            </div>
            <!-- end container -->
        </section>
        <!-- end Carousel -->

    </div>
    <!-- end Content Wrapper -->

    <!-- Footer -->
    <footer id="footer">
        <div class="container">

            <!-- footer socials -->
            <div class="row">

                <div class="footer_socials col-sm-12 text-center">



                    <div class="copyright">copyright 2022 All Right Reserved</div>

                </div>

            </div>
            <!-- end footer socials -->

        </div>
        <!-- end container -->
    </footer>
    <!-- end footer -->


    <!-- Scripts -->
    <script src="/assets/bao-tri/assets/js/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="/assets/bao-tri/assets/boostrap-files/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/bao-tri/assets/js/modernizr.custom.js" type="text/javascript"></script>
    <script src="/assets/bao-tri/assets/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="/assets/bao-tri/assets/js/jquery.stellar.min.js" type="text/javascript"></script>
    <script src="/assets/bao-tri/assets/js/jquery.parallax-1.1.3.js" type="text/javascript"></script>
    <script src="/assets/bao-tri/assets/js/jquery.appear.js" type="text/javascript"></script>
    <script src="/assets/bao-tri/assets/js/placeholders.min.js" type="text/javascript"></script>
    <script src="/assets/bao-tri/assets/js/jquery.nicescroll.min.js" type="text/javascript"></script>
    <script src="/assets/bao-tri/assets/js/jquery.lwtCountdown-1.0.js" type="text/javascript"></script>
    <script src="/assets/bao-tri/assets/js/scripts.js" type="text/javascript"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js'></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    [if lt IE 9]-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</body>
</html>