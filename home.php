<!DOCTYPE html>

<html lang="en" class="dark-style layout-navbar-fixed layout-menu-100vh layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="/sneat/assets/" data-template="vertical-menu-template-starter">
<?php require_once("config/function.php");require_once("config/head.php"); ?>


<head>
    <title>Trang chủ</title>
    <style>
    .page_speed_770896680 {
        width: 95%;
    }
    </style>
</head>
<style>
.table th {
    text-transform: none !important;
    font-size: 14px !important;
}

.table> :not(caption)>*>* {
    padding: 5px 10px !important;
}

.badge {
    text-transform: none !important;
    padding: 0.5rem 0.5rem !important;
}

.table td {
    font-size: 14px !important;
}

#swal2-title,
#swal2-html-container {
    font-weight: 600 !important;
}
</style>
<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php require_once("config/nav.php") ?>
            <div class="preloader">
                <div class="preloader-icon"></div>
            </div>
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Trang chủ</h4>
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                        <div class="col-lg-9 col-xlg-9 col-md-7">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="card-info">
                                                    <p class="card-text">Số dư</p>
                                                    <div class="d-flex align-items-end mb-2">
                                                        <h4 class="card-title mb-0 me-2"><b class="text-danger"><?=$LTT -> getUsers("money")?></b>
                                                            coin</h4>
                                                    </div>
                                                </div>
                                                <div class="card-icon">
                                                    <span class="badge bg-label-success rounded p-2">
                                                        <i class="fa-solid fa-coins bx-sm"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="card-info">
                                                    <p class="card-text">Đã nạp</p>
                                                    <div class="d-flex align-items-end mb-2">
                                                        <h4 class="card-title mb-0 me-2"><b
                                                                class="text-danger"><?=$LTT -> getUsers("tongnap")?></b> coin</h4>
                                                    </div>
                                                </div>
                                                <div class="card-icon">
                                                    <span class="badge bg-label-primary rounded p-2">
                                                        <i class="fa-solid fa-coins bx-sm"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="card-info">
                                                    <p class="card-text">Nạp tháng</p>
                                                    <div class="d-flex align-items-end mb-2">
                                                        <h4 class="card-title mb-0 me-2"><b
                                                                class="text-danger">0</b> coin</h4>
                                                    </div>
                                                </div>
                                                <div class="card-icon">
                                                    <span class="badge bg-label-info rounded p-2">
                                                        <i class="fa-solid fa-coins bx-sm"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="home-notification mb-3">
                                <?php foreach ($LTT->get_list("SELECT * FROM `note_thongbao`  WHERE `url_config` = '" . $url_site_name . "' ORDER BY `id` DESC") as $rownoti) { ?>
                                <div class="d-flex flex-column comment-section mb-1">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="avatar me-3">
                                                        <img src="https://graph.facebook.com/<?= $LTT->site('id_page'); ?>/picture?width=100&height=100&access_token=6628568379|c1e620fa708a1d5696fb991c1bde5662"
                                                            alt="Avatar" class="rounded-circle">
                                                    </div>
                                                    <div class="me-2">
                                                        <h6 class="mb-0"><?= $LTT->site('full_name_admin'); ?></h6>
                                                        <small class="text-muted"><?= $rownoti['date'] ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <p><?= $rownoti['noidung'] ?></p>
                                            <div class="d-flex gap-1 mt-4">
                                                <a href="#" class="btn btn-label-secondary" title=""
                                                    data-bs-toggle="tooltip" data-bs-original-title="Like">
                                                    <i class="fa-solid fa-heart"></i>&nbsp;<?= rand(1, 9999); ?>
                                                </a>
                                                <a href="#" class="btn btn-label-secondary" title=""
                                                    data-bs-toggle="tooltip" data-bs-original-title="Comments">
                                                    <i class="fa-solid fa-comment"></i>&nbsp;<?= rand(1, 100); ?>
                                                </a>
                                                <a href="#" class="btn btn-label-secondary" title=""
                                                    data-bs-toggle="tooltip" data-bs-original-title="Share">
                                                    <i class="fa-solid fa-share"></i>&nbsp;<?= rand(1, 1000); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xlg-3 col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="ribbon-title ribbon-primary">Nâng VIP</div>
                                            <div class="mt-4">
                                                <center><img src="/assets/images/svg/vip.svg" alt="" width="80"
                                                        height="80">
                                                </center>
                                                <div class="text-center mb-3">
                                                    <h5>
                                                        Nâng cấp bậc!
                                                    </h5>
                                                    <p class="text-soft">Bạn sẽ nhận được nhiều ưu hơn hơn như: giảm
                                                        giá dịch vụ, tạo
                                                        website riêng, hỗ trợ ...</p>
                                                </div>
                                                <div class="d-grid gap-2 col-12 mx-auto">
                                                    <a href="/Bank"
                                                        class="btn btn-success">Nâng ngay nào!</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $total_don = $LTT->get_row("SELECT COUNT(*) FROM `history_buy`  WHERE  `url_config` = '" . $url_site_name . "' AND `username` = '" . $my_user . "' ")['COUNT(*)'];
                                $total_don_chay = $LTT->get_row("SELECT COUNT(*) FROM `history_buy`  WHERE  `url_config` = '" . $url_site_name . "' AND `username` = '" . $my_user . "'  AND `status` = 'Start' ")['COUNT(*)'];
                                $total_don_done = $LTT->get_row("SELECT COUNT(*) FROM `history_buy`  WHERE  `url_config` = '" . $url_site_name . "' AND `username` = '" . $my_user . "'  AND `status` = 'Success' ")['COUNT(*)'];
                                $total_don_huy = $LTT->get_row("SELECT COUNT(*) FROM `history_buy`  WHERE  `url_config` = '" . $url_site_name . "' AND `username` = '" . $my_user . "'  AND `status` = 'Pause' ")['COUNT(*)'];
                                ?>
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="ribbon-title ribbon-primary">Thống kê &amp; tiến trình đơn
                                            </div>
                                            <div class="mt-4">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="card overflow-hidden mb-3 bg-warning text-white">

                                                            <div class="card-body position-relative text-center">
                                                                <div
                                                                    class="display-4 fs-3 mb-2 font-weight-normal font-sans-serif text-white">
                                                                    <?=$total_don?></div>
                                                                <h6 class="ml-1 text-white">Đơn đã mua</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card overflow-hidden mb-3 bg-info text-white">

                                                            <div class="card-body position-relative text-center">
                                                                <div
                                                                    class="display-4 fs-3 mb-2 font-weight-normal font-sans-serif text-white">
                                                                    <?=$total_don_chay?></div>
                                                                <h6 class="ml-1 text-white">Đơn đang chạy</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card overflow-hidden mb-3 bg-success text-white">

                                                            <div class="card-body position-relative text-center">
                                                                <div
                                                                    class="display-4 fs-3 mb-2 font-weight-normal font-sans-serif text-white">
                                                                    <?=$total_don_done?></div>
                                                                <h6 class="ml-1 text-white">Đơn hoàn thành</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card overflow-hidden mb-3 bg-danger text-white">

                                                            <div class="card-body position-relative text-center">
                                                                <div
                                                                    class="display-4 fs-3 mb-2 font-weight-normal font-sans-serif text-white">
                                                                    <?=$total_don_huy?></div>
                                                                <h6 class="ml-1 text-white">Đơn đã hủy</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalSystem" tabindex="-1" role="dialog"
                        aria-labelledby="modalSystemLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <center>
                                        <img src="https://subgiare.vn/assets/images/svg/notification.svg" alt=""
                                            width="76">
                                    </center>
                                    <div class="pt-3 text-center">
                                        <h3>Thông báo hệ thống</h3>
                                    </div>
                                    <img src="<?= $LTT->site('anh_thong_bao'); ?>" style="width: 100%;"><br><br>
                                    <p class="text-center"><?=$LTT->site('thongbao')?></p>
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng
                                            thông báo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <?php require_once("config/scr.php");?>
    <?php require_once("config/end.php");?>
</body>

</html>