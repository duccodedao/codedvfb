<?php if ($LTT->check_ip(getip()) == "block") {
    header('Location: /BAND-IP');
    exit;
} ?>
<!doctype html>
<html lang="vi">


<meta charset="utf-8">
    <link rel="shortcut icon" href="<?= $LTT->site('favicon'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="<?= $LTT->site('tu_khoa'); ?>" />
    <meta name="keyword" content="<?= $LTT->site('tu_khoa'); ?>" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="content-language" content="vi" />
    <meta property="og:url" content="https://<?= $_SERVER['SERVER_NAME'] ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:domain" content="<?= $_SERVER['SERVER_NAME'] ?>" />
    <meta property="og:title" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>" />
    <meta property="og:description" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>" />
    <meta property="og:image" content="<?= BASE_URL('assets/img/home-banner.jpg'); ?>" />
    <meta name="og:title" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>">
    <meta name="og:description" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>">
    <meta name="csrf-token" content="9jILCFLdUiKHj5NIvPwKO98dWO5obzeL3msiDKcQ">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/sneat/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="/sneat/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/sneat/assets/vendor/fonts/flag-icons.css" />
    <link rel="stylesheet" href="/sneat/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/sneat/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/sneat/assets/css/demo.css" />
    <link rel="stylesheet" href="/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/sneat/assets/vendor/css/pages/page-auth.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/app.css?v=1656312455">
    <script src="/sneat/assets/vendor/js/helpers.js"></script>
    <script src="/sneat/assets/vendor/js/template-customizer.js"></script>
    <script src="/sneat/assets/js/config.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <style>
        .page_speed_960096975 {
            vertical-align: middle;
        }
    </style>

</head>
