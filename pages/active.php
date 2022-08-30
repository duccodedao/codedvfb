<?php
$status_site = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config` = '" . $url_site_name . "'
");
if ($status_site['status'] !== "wait") {
    header('Location: /');
    exit;
}

/*thanh vũ*/
?>
<!doctype html>
<html lang="vi">

<head>
    <title>Kích Hoạt</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="MobileOptimized" content="320">
    <meta http-equiv="content-language" content="vi" />
    <meta name="copyright" content="thanhvu" />
    <meta name="author" content="thanhvu" />
    <meta name="keyword" content="<?= $LTT->site('tu_khoa'); ?>" />
    <meta name="robots" content="index, follow" />
    <meta name="revisit-after" content="1 days" />
    <meta http-equiv="content-language" content="vi" />
    <meta property="og:url" content="https://<?= $_SERVER['SERVER_NAME'] ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:domain" content="<?= $_SERVER['SERVER_NAME'] ?>" />
    <meta property="og:title" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>" />
    <meta property="og:description" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>" />
    <meta property="og:image" content="<?= BASE_URL('assets1/img/home-banner.jpg'); ?>" />
    <meta property="fb:app_id" content="" />
    <meta name="twitter:title" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>">
    <meta name="twitter:description" content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>">
    <meta name="csrf-token" content="EAAGNO4a7r2wBAD30V2NTzCNJA8nYn1UAwrCOS4AgxuxMhA3pVyLidPSTUyJfWzE6obIXeYQP7P334AMOph07HWePcAZAc6whr01CTyigjbvFR1KVExDfftRuyPZBfNPg9NvkZA5b1TRHb3BobZCbVvkTcFgAXYeljXTHHddzZCalAmor">
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="b9e3e84309a92aaf852234bf-|49" defer=""></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png" href="<?= $LTT->site('favicon'); ?>" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets1/themes/login-v4/css/style.css?<?= rand(1, 999999); ?>">
    <link rel="stylesheet" href="/assets1/themes/login-v4/css/main.css?<?= rand(1, 999999); ?>">
    <link rel="stylesheet" href="/assets1/themes/login-v4/css/app.css?<?= rand(1, 999999); ?>">
    <link rel="stylesheet" href="/assets1/themes/login-v4/css/bootstrap.css?<?= rand(1, 999999); ?>">
</head>
<div class="wrapper">
    <section class="login-content">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center height-self-center">
                <div class="col-md-5 col-sm-12 col-12 align-self-center">
                    <div class="sign-user_card">
                        <h4 class="title">
                            Kích Hoặt</h4>
                        <br>
                        <form submit-ajax="NTD" method="post" action="<?= BASE_URL('api/active'); ?>">
                            <o id="callback"></o>
                            <input type="hidden" name="_token" value="EAAGNO4a7r2wBAD30V2NTzCNJA8nYn1UAwrCOS4AgxuxMhA3pVyLidPSTUyJfWzE6obIXeYQP7P334AMOph07HWePcAZAc6whr01CTyigjbvFR1KVExDfftRuyPZBfNPg9NvkZA5b1TRHb3BobZCbVvkTcFgAXYeljXTHHddzZCalAmor">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="floating-label form-group">
                                        <input class="floating-input form-control" type="text" name="key_active" placeholder="Nhập token kích hoạt site">
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-info-but btn-block btn-lg">
                                <h5 class="text-button">Kích hoạt</h5>
                            </button>

                        </form>
                        <!--thanh vũ-->

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?= BASE_URL('assets1/js/backend-bundle.min.js'); ?>" type="b9e3e84309a92aaf852234bf-text/javascript"></script>
<script src="<?= BASE_URL('assets1/js/all.min.js?' . time()); ?>" type="b9e3e84309a92aaf852234bf-text/javascript"></script>

<script type="b9e3e84309a92aaf852234bf-text/javascript">
    const pusher = new Pusher('668e4c588c763d16fcc4', {
        cluster: 'ap1'
    });
</script>
<script src="<?= BASE_URL('assets1/js/function.vendors3243242.js?' . time()); ?>" type="b9e3e84309a92aaf852234bf-text/javascript"></script>
<script type="b9e3e84309a92aaf852234bf-text/javascript">
    $(document).ready(function() {
        if (!getCookie('modalSystem')) {
            $('#modalSystem').modal('show');
        }
    });
    /*thanh vũ*/
    function closeModalSystem() {
        setCookie('modalSystem', true, 1);
        $('#modalSystem').modal('hide');
    }
</script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="b9e3e84309a92aaf852234bf-|49" defer=""></script>

</body>

</html>