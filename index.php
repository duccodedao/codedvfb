

<?php require('config/function.php');
$status_site = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config` = '" . $url_site_name . "'
");
if ($status_site['status'] == "wait") {
  if ($LTT->check_ip(getip()) == "block") {
    header('Location: /BAND-IP');
    exit;
  }
  require('pages/active.php');
} else {

  if (isset($_SESSION['username'])) {
    header('Location: /home');
    exit;
  }
  if ($LTT->site('bao_tri') == "OFF") {
    header('Location: /bao_tri');
    exit;
  }
  if ($LTT->site('status') == "Band") {
    header('Location: /Band');
    exit;
  }?>
<!doctype html>
<html lang="vi">
<!--bộ code được phát chuyển bởi Thanh Vũ zalo 0528115572 fb https://facebook.com/vudegaming nghiêm cấm hành vi bán lại code chúng tôi sẽ từ chối bảo hành khi lỗi-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok</title>
    <meta name="csrf-token" content="8R60dWkFQ02f6wW9co6Q1bM72lcYTmI6f8ipML8f">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="MobileOptimized" content="320">
    <meta http-equiv="content-language" content="vi" />
    <meta name="copyright" content="<?= $_SERVER['SERVER_NAME'] ?>" />
    <meta name="author" content="<?= $_SERVER['SERVER_NAME'] ?>" />
    <meta name="keyword" content="<?= $LTT->site('tu_khoa'); ?>" />
    <meta name="robots" content="index, follow" />
    <meta name="revisit-after" content="1 days" />
    <meta http-equiv="content-language" content="vi" />
    <meta property="og:type" content="website" />
    <meta property="og:domain" content="<?= $_SERVER['SERVER_NAME'] ?>" />
    <meta property="og:title" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:image" content="<?= $LTT->site('anhbia'); ?>">
    <meta property="fb:app_id" content="" />
    <meta name="twitter:title" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>">
    <meta name="twitter:description" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>">
    <link rel="shortcut icon" href="<?= $LTT->site('favicon'); ?>" />
    <link rel="stylesheet" href="/assets1/themes/landing-font-end-5/css/animate.css?<?= rand(1, 999999999); ?>">
    <link rel="stylesheet" href="/assets1/themes/landing-font-end-5/css/bootstrap.min.css?<?= rand(1, 999999999); ?>">
    <link rel="stylesheet" href="/assets1/themes/landing-font-end-5/css/magnific-popup.css?<?= rand(1, 999999999); ?>">
    <link rel="stylesheet" href="/assets1/themes/landing-font-end-5/css/owl.carousel.min.css?<?= rand(1, 999999999); ?>">
    <link rel="stylesheet" href="/assets1/themes/landing-font-end-5/css/font-awesome.min.css?<?= rand(1, 999999999); ?>">
    <link rel="stylesheet" href="/assets1/themes/landing-font-end-5/css/flaticon.css?<?= rand(1, 999999999); ?>">
    <link rel="stylesheet" href="/assets1/themes/landing-font-end-5/css/hover-min.css?<?= rand(1, 999999999); ?>">
    <link rel="stylesheet" href="/assets1/themes/landing-font-end-5/css/style.css?<?= rand(1, 999999999); ?>">
    <link rel="stylesheet" href="/assets1/themes/landing-font-end-5/css/responsive.css?<?= rand(1, 999999999); ?>">
    <style>
        .page_speed_392861669 {
            background-image: url(/assets1/themes/landing-font-end-5/img/bg.png);
        }

        .page_speed_1388071015 {
            background-image: url(/assets1/themes/landing-font-end-5/img/01.png);
        }

        .page_speed_207883135 {
            background-image: url(/assets1/themes/landing-font-end-5/bg.png);
        }

        .page_speed_2095747978 {
            background-image: url(/assets1/themes/landing-font-end-5/01.png);
        }
    </style>
</head>
<style>
    span.price {
        font-size: 30px;
    }
</style>

<body>
    <div class="header-style-01">
        <nav class="navbar navbar-area navbar-expand-lg nav-style-02">
            <div class="container nav-container utility-nav">
                <div class="responsive-mobile-menu">
                    <div class="logo-wrapper">
                        <a href="/home" class="logo">
                            <img src="<?= $LTT->site('logo'); ?>" alt="">
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                    <ul class="navbar-nav">
                        <li><a href="/home">Trang chủ</a></li>
                        <li class="menu-item-has-children">
                            <a href="#">Dịch vụ nổi bật</a>
                            <ul class="sub-menu">
                                <li><a href="/home">Facebook</a></li>
                                <li>
                                    <a href="/home">Instagram </a>
                                </li>
                                <li><a href="/home">Youtube </a></li>
                                <li><a href="/home">Tiktok</a></li>
                                <li>
                                    <a href="/home">Một số dịch vụ khác</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Liên hệ hỗ trợ</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?= $LTT->site('facebook'); ?>">Facebook</a>
                                </li>
                                <li><a href="#"><?= $LTT->site('facebook'); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="nav-right-content">
                    <div class="btn-wrapper">
                        <a href="/Login" class="boxed-btn utility-btn style-01">Đăng nhập</a>
                        <a href="/Register" class="boxed-btn utility-btn">Đăng kí</a>
                    </div>
                </div>
        </nav>
    </div>
    <div class="header-area header-bg-04 header-utility page_speed_392861669">
        <div data-parallax='{"x": 100, "y": 60}' class="utility-bg-img wow animate__animated animate__zoomIn page_speed_1388071015"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-inner">
                        <h1 class="title wow animate__animated animate__fadeInUp">Tạo hiệu ứng cho sự nổi tiếng của bạn
                        </h1>
                        <p class="utility-para">Hệ thống chuyên cung cấp các dịch vụ tăng Like, Follow, Share,
                            Comment, View Video,... cho các Mạng xã hội như Facebook, Instagram, Tiktok...</p>
                        <div class="btn-wrapper padding-top-30">
                            <a href="/home" class="btn-startup style-01 boxed-btn reverse-color">Bắt
                                đầu ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom-area padding-top-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="single-app-item padding-bottom-55">
                        <div class="content">
                            <div class="icon">
                                <i class="flaticon-followers"></i>
                            </div>
                            <h3 class="title wow animate__animated animate__fadeInUp">Công nghệ</h3>
                            <p class="utility-para wow animate__animated animate__fadeInUp animated">Hệ thống được vận
                                hành hoàn toàn tự động 24/24.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="single-app-item padding-bottom-55">
                        <div class="content">
                            <div class="icon">
                                <i class="fa fa-lock"></i>
                            </div>
                            <h3 class="title wow animate__animated animate__fadeInUp">Bảo mật
                            </h3>
                            <p class="utility-para wow animate__animated animate__fadeInUp animated">Chúng tôi cam kết
                                sẽ bảo mật thông tin người dùng 1 cách tốt nhất.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="single-app-item padding-bottom-55">
                        <div class="content">
                            <div class="icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <h3 class="title wow animate__animated animate__fadeInUp">Hỗ trợ</h3>
                            <p class="utility-para wow animate__animated animate__fadeInUp animated">Đội ngũ hỗ trợ luôn
                                lắng nghe ý khiến khách hàng để phát triển hệ thống.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="price-plan-area price-bg padding-bottom-120 page_speed_207883135">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title brand desktop-center padding-bottom-50">
                        <h3 class="title">Cấp bậc ưu đãi khách hàng
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-price-plan-02 wow animate__animated animate__fadeInUp animated">
                        <div class="price-header">
                            <h4 class="title">Thành viên</h4>
                        </div>
                        <div class="price-wrap">
                            <span class="price">0đ</span>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li>Không có ưu đãi</li>
                            </ul>
                        </div>
                        <div class="price-footer">
                            <div class="btn-wrapper">
                                <a href="/home" class="boxed-btn btn-startup">Xem ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-price-plan-02 wow animate__animated animate__fadeInUp animated">
                        <div class="price-header">
                            <h4 class="title">Cộng tác viên </h4>
                        </div>
                        <div class="price-wrap">
                            <span class="price"><?= number_format($LTT->site('rate_ctv')) ?><sup>đ</sup></span>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li>Có ưu đãi giá dịch vụ cộng tác viên.</li>
                            </ul>
                        </div>
                        <div class="price-footer">
                            <div class="btn-wrapper">
                                <a href="/home" class="boxed-btn btn-startup">Xem ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="single-price-plan-02 wow animate__animated animate__fadeInUp animated">
                        <div class="price-header">
                            <h4 class="title">Đại lý </h4>
                        </div>
                        <div class="price-wrap">
                            <span class="price"><?= number_format($LTT->site('rate_daily')) ?><sup>đ</sup></span>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li>Có rất nhiều ưu đãi giá dịch vụ đại lý.</li>
                            </ul>
                        </div>
                        <div class="price-footer">
                            <div class="btn-wrapper">
                                <a href="/home" class="boxed-btn btn-startup">Xem ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="single-price-plan-02 wow animate__animated animate__fadeInUp animated">
                        <div class="price-header">
                            <h4 class="title">Nhà phân phối </h4>
                        </div>
                        <div class="price-wrap">
                            <span class="price"><?= number_format($LTT->site('rate_admin')) ?><sup>đ</sup></span>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li>Có rất nhiều ưu đãi giá dịch vụ cho nhà phân phối.</li>
                            </ul>
                        </div>
                        <div class="price-footer">
                            <div class="btn-wrapper">
                                <a href="/home" class="boxed-btn btn-startup">Xem ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tracks-manages-area padding-top-120 padding-bottom-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="tracks-content-area padding-bottom-50">
                        <div class="section-title wow animate__animated animate__fadeInUp animated">
                            <h4 class="title">Bạn còn chờ đợi gì nữa?
                            </h4>
                            <p class="tracks-pera">Hãy sử dụng thử dịch vụ của chúng tôi nhé.
                            </p>
                            <div class="btn-wrapper padding-top-30">
                                <a href="/Login" class="btn-startup style-01 boxed-btn reverse-color text-white">Đăng nhập</a>&nbsp;&nbsp;
                                <a href="/Register" class="btn-startup style-01 boxed-btn reverse-color text-white">Đăng kí</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div data-parallax='{"x": -50, "y": 0}' class="supports-img bg-image wow animate__animated animate__backInUp page_speed_2095747978"></div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-area">
        <div class="copyright-area style-03">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-area-inner">
                            © 2022 <a href="/home"><?= $LTT->site('ten_website'); ?> | All rights reserved.</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <script src="/assets1/themes/landing-font-end-5/js/jquery-2.2.4.min.js"></script>
    <script src="/assets1/themes/landing-font-end-5/js/bootstrap.min.js"></script>
    <script src="/assets1/themes/landing-font-end-5/js/jquery.magnific-popup.js"></script>
    <script src="/assets1/themes/landing-font-end-5/js/wow.min.js"></script>
    <script src="/assets1/themes/landing-font-end-5/js/owl.carousel.min.js"></script>
    <script src="/assets1/themes/landing-font-end-5/js/waypoints.min.js"></script>
    <script src="/assets1/themes/landing-font-end-5/js/jquery.counterup.min.js"></script>
    <script src="/assets1/themes/landing-font-end-5/js/jquery.ripples-min.js"></script>

    <script src="/assets1/themes/landing-font-end-5/js/tilt.jquery.js"></script>
    <script src="/assets1/themes/landing-font-end-5/js/imagesloaded.pkgd.min.js"></script>
    <script src="/assets1/themes/landing-font-end-5/js/isotope.pkgd.min.js"></script>
    <script src="/assets1/themes/landing-font-end-5/js/parallax.js"></script>
    <script src="/assets1/themes/landing-font-end-5/js/main.js"></script>
</body>

</html>
<?php } ?>
