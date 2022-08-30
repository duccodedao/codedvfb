<!DOCTYPE html>
<?php require_once("../../config/function.php");?>
<html lang="en" class="dark-style layout-navbar-fixed layout-menu-100vh layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="/sneat/assets/" data-template="vertical-menu-template-starter">
<?php
$text = getCurURL();
$dichvu1 = (explode('/', $text));
$dich_vu = $dichvu1['5'];
if ($dich_vu == "cmt") {
    $dtb = "cmt_ins";
    $action = $dichvu1['5'];
    $title = "Tăng Comment Bài Viết";
} elseif ($dich_vu == "like") {
    $dtb = "like_ins";
    $action = $dichvu1['5'];
    $title = "Like Bài Viết";
} elseif ($dich_vu == "follow") {
    $dtb = "sub_ins";
    $action = $dichvu1['5'];
    $title = "Follow Instagram";
} ?><?php require('../../config/head.php');
if (empty($_SESSION['username'])) {
    header('Location: /Login');
    exit;
} else {
    $getrate = $LTT->get_list("SELECT * FROM `server_service` WHERE `code_service`='$dtb' AND `status_service`='1' AND `url_config`='" . $url_site_name . "' ");
} ?>
<title>List <?= $title; ?></title>
<!DOCTYPE html>

<html lang="en" class="dark-style layout-navbar-fixed layout-menu-100vh layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="/sneat/assets/" data-template="vertical-menu-template-starter">


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


            <?php require_once("../../config/nav.php"); ?>
            <div class="content-wrapper">

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Đơn like bài viết Instagram</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4 card-tab">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6 d-grid gap-2">
                                            <a href="/dich-vu/instagram/like" class="btn btn-outline-primary"><img
                                                    src="https://subgiare.vn/assets/images/svg/order.svg" alt=""
                                                    width="25" height="25">
                                                Thêm đơn</a>
                                        </div>
                                        <div class="col-6 d-grid gap-2">
                                            <a href="/dich-vu/instagram/like/list" class="btn btn-primary"><img
                                                    src="https://subgiare.vn/assets/images/svg/list-order.svg" alt=""
                                                    width="25" height="25">
                                                Danh sách đơn</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="https://subgiare.vn/service/instagram/like-post/list">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                placeholder="Nhập id, code_order, link_post tìm kiếm ..." name="search"
                                                value="">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i>
                                                Tìm kiếm</button>
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
                                                    <td><span
                                                            class="badge badge-primary"><?= $rowhbuff['server_buy'] ?></span>
                                                    </td>
                                                    <td><b
                                                            class="text-danger"><?= $rowhbuff['soluong'] ?></b><sup>sub</sup>
                                                    </td>

                                                    <td><b
                                                            class="text-danger"><?= $rowhbuff['tong_tien'] ?></b><sup>đ</sup>
                                                    </td>
                                                    <td><b><?= $rowhbuff['hinh_thuc'] ?></b></td>
                                                    <td><b><?= statusorder($rowhbuff['status']) ?></b></td>

                                                </tr>
                                                <?php }
                                    } else { ?>
                                                <tr class="odd">
                                                    <td valign="top" colspan="100%">
                                                        <center>
                                                            <img src="/assets1/images/nodata.svg" alt="" width="80"
                                                                height="80" class="pt-3">
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

                <?php require_once("../../config/scr.php");?>
                <?php require_once("../../config/end.php");?>

</body>

</html>