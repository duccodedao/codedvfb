<?php require('../../config/function.php');
$text = getCurURL();
$dichvu1 = (explode('/', $text));
$dich_vu = $dichvu1['5'];
if ($dich_vu == "sub") {
    $dtb = "sub_twitter";
    $action = $dichvu1['5'];
    $title = "Tăng Follow Twitter";
} elseif ($dich_vu == "like") {
    $dtb = "like_twitter";
    $action = $dichvu1['5'];
    $title = "Like Twitter";
} ?><?php require('../../config/head.php');
    if (empty($_SESSION['username'])) {
        header('Location: /Login');
        exit;
    } else {
        $getrate = $LTT->get_list("SELECT * FROM `server_service` WHERE `code_service`='$dtb' AND `status_service`='1' ");
    } ?>
<title>List <?= $title; ?></title>
<script type="b9e3e84309a92aaf852234bf-text/javascript">
    const profile = {
        "id": "<?= $LTT->getUsers('id'); ?>",
        "fullname": "<?= $LTT->getUsers('name'); ?>",
        "email": "<?= $LTT->getUsers('email'); ?>",
        "username": "<?= $LTT->getUsers('username'); ?>",
        "đ": "<?= $LTT->getUsers('money'); ?>",
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
        "website": [],
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
<?php require('../../config/nav.php'); ?>

<div class="layout-wrapper">
    <div class="header">
        <div class="menu-toggle-btn">
            <a href="#">
                <i class="bi bi-list"></i>
            </a>
        </div>
        <a href="/home" class="logo">
            <img width="130" src="<?= $LTT->site('logo'); ?>" alt="logo">
        </a>
        <div class="page-title">Đơn <?= $title; ?></div>
        <form class="search-form">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm...">
                <a href="#" class="btn btn-outline-light close-header-search-bar">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </form>
        <div class="header-bar ms-auto">
            <ul class="navbar-nav justify-content-end gap-3">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-notify" data-count="2" data-sidebar-target="#notifications">
                        <i class="bi bi-bell icon-lg"></i>
                    </a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="dropdown" class="btn btn-white py-1 px-2 dropdown-toggle custom-shadow">
                        <span class="avatar avatar-sm me-2">
                            <img src="https://ui-avatars.com/api/?background=random&amp;name=<?= $LTT->getUsers('name'); ?>" class="rounded-circle" alt="avatar">
                        </span>
                        <span class="d-none d-md-inline"><?= $LTT->getUsers('name'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/Profile">Tài khoản của tôi</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/Logout">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="header-mobile-buttons">
            <a href="#" class="search-bar-btn">
                <i class="bi bi-search"></i>
            </a>
            <a href="#" class="actions-btn">
                <i class="bi bi-three-dots"></i>
            </a>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid gap-2">
                                <a href="/dich-vu/<?= $dichvu1['4']; ?>/<?= $dich_vu; ?>" class="btn btn-outline-primary"><img src="/assets/images/order.svg" alt="" width="25" height="25">
                                    Thêm đơn</a>
                            </div>
                            <div class="col-6 d-grid gap-2">
                                <a href="<?= $text; ?>" class="btn btn-primary"><img src="/assets/images/list-order.svg" alt="" width="25" height="25">
                                    Danh sách đơn</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= $text; ?>">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nhập id, code_order, id_video tìm kiếm ..." name="search" value="">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr role="row" class="bg-primary">
                                        <th class="text-center text-white">ID</th>
                                        <th class="text-center text-white">Thời gian</th>
                                        <th class="text-center text-white">Mã đơn</th>
                                        <th class="text-center text-white">Link Video</th>
                                        <th class="text-center text-white">Máy chủ</th>
                                        <th class="text-center text-white">Số lượng</th>
                                        <th class="text-center text-white">Tổng thanh toán</th>
                                        <th class="text-center text-white">Hình Thức</th>
                                        <th class="text-center text-white">Trạng thái</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $getlistbuff = $LTT->get_list("SELECT * FROM `history_buy` WHERE `type` = '$dtb' AND `username` = '$my_user'  AND  `url_config` = '" . $url_site_name . "'  ORDER BY `id` DESC ");
                                    if ($getlistbuff) {
                                        foreach ($getlistbuff as $rowhbuff) { ?>
                                            <tr class="odd">
                                                <td><?= $rowhbuff['id'] ?></td>
                                                <td><?= $rowhbuff['date'] ?></td>
                                                <td><?= $rowhbuff['ma_gd'] ?></td>
                                                <td><?= $rowhbuff['link_buy'] ?></td>
                                                <td><span class="badge badge-primary"><?= $rowhbuff['server_buy'] ?></span>
                                                </td>
                                                <td><b class="text-danger"><?= $rowhbuff['soluong'] ?></b><sup>sub</sup>
                                                </td>

                                                <td><b class="text-danger"><?= $rowhbuff['tong_tien'] ?></b><sup>đ</sup>
                                                </td>
                                                <td><b><?= $rowhbuff['hinh_thuc'] ?></b></td>
                                                <td><b><?= statusorder($rowhbuff['status']) ?></b></td>

                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr class="odd">
                                            <td valign="top" colspan="100%">
                                                <center>
                                                    <img src="/assets/images/nodata.svg" alt="" width="80" height="80" class="pt-3">
                                                    <p class="pt-3">Không có dữ liệu để hiển thị</p>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?php require('../../config/end.php'); ?>