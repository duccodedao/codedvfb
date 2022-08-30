<!DOCTYPE html>
<?php require('../config/function.php');

if ($LTT->site('status') !== "Band") {
  header('Location: /');
  exit;
}
?>
<html lang="zxx">
<!--<![endif]-->
<!-- Begin Head -->

<head>
  <title>404</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="MobileOptimized" content="320">
  <!--Start Style -->
  <link rel="stylesheet" type="text/css" href="/assets/fontend-themes-css/fonts.css">
  <link rel="stylesheet" type="text/css" href="/assets/fontend-themes-css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/fontend-themes-css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/fontend-themes-css/icofont.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/fontend-themes-css/style.css">
  <link rel="stylesheet" id="theme-change" type="text/css" href="#">
  <!-- Favicon Link -->
  <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
</head>


<body>
  <div class="loader">
    <div class="spinner">
      <img src="/assets/images/loading_web.gif" alt="" />
    </div>
  </div>
  <!-- Main Body -->
  <div class="fb-main-404section">
    <div class="fb-404page">
      <img src="/assets/images/error.png" alt="" width="60%">
      <h1>Website Đã Bị Khoá</h1>
      <p>Chúng tôi đã khoá trang vì một lý do nào đó.</p>
      <div class="fb-404btn">
        <a href="https://zalo.me/" class="ad-btn">Tìm Hiểu</a>
      </div>
    </div>
  </div>
  <!-- Color Setting -->

  <!-- Color Setting -->
  <!-- Script Start -->
  <script src="/assets/fontend-themes-js//jquery.min.js"></script>
  <script src="/assets/fontend-themes-js//popper.min.js"></script>
  <script src="/assets/fontend-themes-js//bootstrap.min.js"></script>
  <script src="/assets/fontend-themes-js//custom.js"></script>
</body>

</html>