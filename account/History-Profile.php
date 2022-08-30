<!DOCTYPE html>
<?php require_once("../config/function.php");?>
<html lang="en" class="dark-style layout-navbar-fixed layout-menu-100vh layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="/sneat/assets/" data-template="vertical-menu-template-starter">

<?php
require_once("../config/head.php");?>
<?php
if (empty($_SESSION['username'])){
    header("Location: /Login");
}
?>
<title>Lịch sử tài khoản</title>


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
            <?php require_once("../config/nav.php");?>
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Lịch sử tài khoản</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="ribbon-title ribbon-primary">Nhật kí hoạt động</div>
                                    <div class="mt-4">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap">
                                                <thead>
                                                    <tr role="row" class="bg-primary">
                                                        <th class="text-center text-white">ID</th>
                                                        <th class="text-center text-white">Thời gian</th>
                                                        <th class="text-center text-white">Loại</th>
                                                        <th class="text-center text-white">Mã đơn</th>
                                                        <th class="text-white">Nội dung</th>
                                                    </tr>
                                                </thead>
                                                <tbody role="alert" aria-live="polite" aria-relevant="all" class="">
                                                    <?php $getlistcard = $LTT->get_list("SELECT * FROM `history_buy` WHERE `username` = '" . $LTT->getUsers('username') . "' AND  `url_config` = '" . $url_site_name . "'  ORDER BY `id` DESC");
                                                    if ($getlistcard) {
                                                        $i = 0;
                                                    foreach ($getlistcard as $rowucard) { 
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?=$i?></td>
                                                        <td class="text-center"><?=$rowucard['date']?></td>
                                                        <td class="text-center"><span class="badge bg-info"><?=$rowucard['type']?></span>
                                                        </td>
                                                        <td class="text-center">
                                                        <?=$rowucard['ma_gd']?>
                                                        </td>
                                                        <td><?=$rowucard['type']?> | Tăng <?=$rowucard['soluong']?>  <?=$rowucard['type']?>  ở
                                                            máy chủ <?=$rowucard['sv']?>  cho ID Facebook: <?=$rowucard['link_buy'] ?> , trừ <?=$rowucard['tong_tien']?> 
                                                            coin trong tài khoản</td>
                                                    </tr>
                                                    <?php }}?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once("../config/scr.php");?>
                <?php require_once("../config/end.php");?>
</body>

</html>