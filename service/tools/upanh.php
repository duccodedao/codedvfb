<title>Up Ảnh</title>
<?php require('../../config/head.php');
if (empty($_SESSION['username'])) {
    header('Location: /auth/login');
    exit;
} else {
    // $selectservice = $LTT->get_row("SELECT * FROM `rate_service` WHERE `code_service` = 'sub_shopee' AND `status_service` = '1' "); 
    $getrate = $LTT->get_list("SELECT * FROM `server_service` WHERE `code_service` = 'sub_shopee' AND `status_service` = '1' ");
} ?>


<script type="b9e3e84309a92aaf852234bf-text/javascript">
    const profile = {
        "id": "<?= $LTT->getUsers('id'); ?>",
        "fullname": "<?= $LTT->getUsers('name'); ?>",
        "email": "<?= $LTT->getUsers('email'); ?>",
        "username": "<?= $LTT->getUsers('username'); ?>",
        "coin": "<?= $LTT->getUsers('money'); ?>",
        "level": "<?php if ($LTT->getUsers('level') == NULL) {
                        echo 'member';
                    } else {
                        echo $LTT->getUsers('level');
                    } ?>",
        "blocked": "<?php if ($LTT->getUsers('banned') == 0) {
                        echo 'false';
                    } else {
                        echo 'true';
                    } ?>",
        "detail_blocked": "<?php if ($LTT->getUsers('banned') == 0) {
                                echo 'Active';
                            } else {
                                echo 'Block';
                            } ?>",
        "api_token": "<?= $LTT->getUsers('token'); ?>",
        "created_at": "<?= $LTT->getUsers('date'); ?>",
        "updated_at": "<?= $LTT->getUsers('lastdate'); ?>",
        "website": [<?= $LTT->getUsers('domain_sitecon'); ?>],
        "avatar": "<?= $LTT->site('logo_user'); ?><?= $LTT->getUsers('username'); ?>",
        "isAdmin": "<?php if ($LTT->getUsers('capbac') == 3) {
                        echo 'true';
                    } else {
                        echo 'false';
                    } ?>",
        "position": "<?= levelmem($LTT->getUsers('capbac')); ?>",
        "levelMember": "<?= levelmem($LTT->getUsers('capbac')); ?>",
        "codeRecharge": "<?= $LTT->getUsers('cuphap'); ?>",
        "loaded": "<?= $LTT->getUsers('tongnap'); ?>",
        "pepper": "<?= $LTT->getUsers('tongtru'); ?>",
        "statusAccount": "<?php if ($LTT->getUsers('banned') == 0) {
                                echo 'Active';
                            } else {
                                echo 'Block';
                            } ?>"
    };
    const setting = {
        "title": "Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>",
        "domain": "<?= $LTT->site('ten_website'); ?>",
        "keyword": "like, sub, share, vip like, buff m\u1eaft, t\u0103ng follow, mua like, mua sub, sub r\u1ebb, hack like, hack sub, hack follow, t\u0103ng like, t\u0103ng follow, t\u0103ng share, t\u0103ng comment, ch\u00e9o like, ch\u00e9o sub, shop sub",
        "fullname_admin": "<?= $LTT->site('full_name_admin'); ?>",
        "fb_admin": "<?= $LTT->site('facebook'); ?>",
        "zalo_admin": "https:\/\/zalo.me\/<?= $LTT->site('phone_zalo'); ?>",
        "modal_system": "H\u1ec7 th\u1ed1ng ho\u00e0n to\u00e0n t\u1ef1 \u0111\u1ed9ng h\u00f3a 100%, t\u1ef1 \u0111\u1ed9ng n\u1ea1p ti\u1ec1n (n\u1ea1p \u00edt nh\u1ea5t 10k, n\u1ea1p sai n\u1ed9i dung tr\u1eeb 10% ph\u00ed). Ch\u00fac b\u1ea1n s\u1eed d\u1ee5ng d\u1ecbch v\u1ee5 vui v\u1ebb nh\u00e9."
    };
</script>

<body class="">
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <div class="wrapper">
        <?php require('../../config/nav.php'); ?>
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between"><i class="ri-menu-line wrapper-menu"></i>
                        <a href="<?= BASE_URL('home'); ?>" class="header-logo"><img src="<?= $LTT->site('logo'); ?>" class="img-fluid rounded-normal light-logo" alt="logo"><img src="<?= $LTT->site('logo'); ?>" class="img-fluid rounded-normal darkmode-logo" alt="logo">
                        </a>
                    </div>
                    <div class="iq-search-bar device-search">
                        <form>
                            <div class="input-prepend input-append">
                                <div class="btn-group">
                                    <label class="dropdown-toggle searchbox" data-toggle="dropdown">
                                        <input class="dropdown-toggle search-query text search-input" type="text" placeholder="Tìm kiếm ..."><span class="search-replace"></span><a class="search-link" href="#"><i class="ri-search-line"></i></a><span class="caret"></span>
                                    </label>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="list/api">
                                                <div class="item"><i class="far fa-file-alt bg-primary"></i>Tài liệu Api </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="change-mode">
                            <div class="custom-control custom-switch custom-switch-icon custom-control-inline">
                                <div class="custom-switch-inner">
                                    <p class="mb-0"></p>
                                    <input type="checkbox" class="custom-control-input" id="dark-mode" data-active="true">
                                    <label class="custom-control-label" for="dark-mode" data-mode="toggle"><span class="switch-icon-left"><i class="a-left"></i></span><span class="switch-icon-right"><i class="a-right"></i></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation"><i class="ri-menu-3-line"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <li class="nav-item nav-icon search-content"><a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ri-search-line"></i></a>
                                    <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                        <form action="#" class="searchbox p-2">
                                            <div class="form-group mb-0 position-relative">
                                                <input type="text" class="text search-input font-size-12" placeholder="type here to search."><a href="#" class="search-link"><i class="las la-search"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon dropdown"><a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ri-question-line"></i></a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton01">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0 ">
                                                <div class="p-3"><a href="<?= $LTT->site('facebook'); ?>" target="_blank" class="iq-sub-card"><i class="las la-info-circle"></i>Facebook Admin</a><a href="https://zalo.me/<?= $LTT->site('phone_zalo'); ?>" target="_blank" class="iq-sub-card"><i class="las la-info-circle"></i>Zalo Admin</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon dropdown caption-content">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="line-height"><img src="<?= $LTT->site('logo_user'); ?><?= $LTT->getUsers('username'); ?>" alt="" class="caption bg-primary ">
                                        </div>
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton03">
                                        <div class="card mb-0">
                                            <div class="card-header d-flex justify-content-between align-items-center mb-0">
                                                <div class="header-title">
                                                    <h4 class="card-title mb-0">Tài khoản</h4>
                                                </div>
                                                <div class="close-data text-right badge badge-primary cursor-pointer "><i class="ri-close-fill"></i>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="profile-header">
                                                    <div class="cover-container text-center">
                                                        <div class="mx-auto d-block"><img src="<?= $LTT->site('logo_user'); ?><?= $LTT->getUsers('username'); ?>" alt="" class="rounded-circle profile-icon bg-primary ">
                                                        </div>
                                                        <div class="profile-detail mt-3">
                                                            <h5><a><?= $LTT->getUsers('username'); ?></a></h5>
                                                            <p><a><?= levelmem($LTT->getUsers('capbac')); ?></a>
                                                            </p>
                                                            </p>
                                                        </div><a href="<?= BASE_URL('auth/logout'); ?>" class="btn btn-primary">Đăng xuất</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb iq-bg-danger">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL('home'); ?>" class="text-danger"><i class="ri-home-4-line mr-1 float-left"></i><?= $LTT->site('ten_website'); ?></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Up Ảnh</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row d-none d-md-block">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                                <div class="image"> <img src="<?= $LTT->site('logo_user'); ?><?= $LTT->getUsers('username'); ?>" class="rounded" width="155"> </div>
                                <div class="ml-3 w-100">
                                    <h4><a><?= $LTT->getUsers('username'); ?></a></h4>
                                    <span><?= levelmem($LTT->getUsers('capbac')); ?></span>
                                    <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
                                        <div class="d-flex flex-column"> <span class="statistical">Số dư</span> <span class="number"><?= format_money($LTT->getUsers('money')); ?> coin</span> </div>
                                        <div class="d-flex flex-column"> <span class="statistical">Đã nạp</span> <span class="number"><?= format_money($LTT->getUsers('tongnap')); ?> coin</span> </div>
                                        <div class="d-flex flex-column"> <span class="statistical">Đã tiêu</span> <span class="number"><?= format_money($LTT->getUsers('tongtru')); ?> coin</span> </div>
                                    </div>
                                    <div class="button mt-2 d-flex flex-row align-items-center">
                                        <a href="/profile/info" class="btn btn-sm btn-warning w-100"><img src="/icon/profile.svg" alt="" width="24" height="24"> Thông tin tài
                                            khoản</a>
                                        <a href="/recharge/banking" class="btn btn-sm btn-success w-100 ml-2"><img src="/icon/bank.svg" alt="" width="24" height="24"> Nạp tiền
                                            vào tài khoản</a>
                                        <a href="/auth/logout" class="btn btn-sm btn-danger w-100 ml-2"><img src="/icon/logout.svg" alt="" width="24" height="24"> Đăng xuất tài
                                            khoản</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">

                            <div class="card-body">
                                <form id="imageform" method="post" enctype="multipart/form-data" action="/service/tools/lib_uploadimage.php">
                                    <p><input type="file" name="file" /></p>
                                    <p><input type="submit" name="photoimg" value="Upload Ảnh" /></p>

                                    <?
                                    function er($text)
                                    {
                                        return '<div style="width: 95%; padding: 6px; border-radius: 5px;background: #D7C042;"><b style="color: red">Lỗi:</b>' . $text . '</div>';
                                    }
                                    if ($_GET['er'] == 7) $error = er("Bạn hãy chọn ảnh để upload nhé!!!");
                                    if ($_GET['er'] == 2) $error = er("Ảnh Quá Lớn, vui lòng chọn file < 20MB");
                                    if ($_GET['er'] == 3) $error = er("Có Vẻ Ảnh Bạn Chọn Không Phải Là Ảnh");
                                    if ($_GET['er'] == 4) $error = er("Chiều dài và rộng của ảnh quá lớn. Hãy upload ảnh nhỏ hơn 20000x20000 px");
                                    if ($_GET['er'] == 5) $error = er("Định Dạng Ảnh Không Được Phép Upload");
                                    if ($_GET['er'] == 6) $error = er("Không thể upload ảnh của bạn, hãy thử lại!");
                                    if ($_GET['er'] == 1) $error = er("Hành động của bạn không hợp lệ !!!");
                                    if (isset($error)) {
                                        echo $error;
                                    } else if (isset($_GET['link'])) {
                                        echo '<p>Copy Link Ảnh Này Của Bạn Dán Vào Nơi bạn cần<br><input value="' . base64_decode($_GET['link']) . '"></p>';
                                    }


                                    if (!isset($_POST['photoimg']))
                                        die(header('location: ./?er=1'));
                                    if (!isset($_FILES['file']['name']) or $_FILES['file']['name'] == null)
                                        die(header('location: ./?er=7'));
                                    // Kiểm tra size
                                    if ($_FILES['file']['size'] > 20000000)
                                        die(header('location: ./?er=2'));
                                    //Kiểm tra nếu là ảnh
                                    if (!getimagesize($_FILES['file']['tmp_name']))
                                        die(header('location: ./?er=3'));
                                    // Kiểm tra phân giải
                                    list($width, $height, $type, $attr) = getimagesize($_FILES['file']['tmp_name']);
                                    if ($width > 30000 || $height > 30000)
                                        die(header('location: ./?er=4'));
                                    # Kiểm tra định dạng file
                                    $access = array(".gif", ".png", ".jpg", ".jpeg");
                                    $checkimage = false;
                                    foreach ($access as $file) {
                                        if (preg_match("/$file\$/i", $_FILES['file']['name'])) {
                                            $checkimage = true;
                                            $mime = $file;
                                            break;
                                        }
                                    }

                                    if ($checkimage == false) {
                                        die(header('location: ./?er=5'));
                                    }

                                    $client_id = "4ec3406826c04ac";
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
                                    curl_setopt($ch, CURLOPT_POST, TRUE);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => base64_encode(file_get_contents($_FILES['file']['tmp_name']))));
                                    $reply = curl_exec($ch);
                                    curl_close($ch);
                                    $reply = json_decode($reply, true);
                                    if ($reply['success'] == 1) {
                                        die(header('location: ./?link=' . base64_encode($reply['data']['link'])));
                                    } else {
                                        die(header('location: ./?er=6'));
                                    }

                                    ?>
                                </form>
                                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css'>
                                <script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js'></script>


                            </div>
                        </div>
                    </div>
                </div>



                <script src="https://code.jquery.com/jquery.min.js"></script>

            </div>
        </div>
    </div>

    </div>
    </div>
    </div>
    </div>
    <?php require('../../config/end.php'); ?>