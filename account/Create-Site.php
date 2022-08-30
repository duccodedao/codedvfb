<!DOCTYPE html>

<html lang="en" class="dark-style layout-navbar-fixed layout-menu-100vh layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="/sneat/assets/" data-template="vertical-menu-template-starter">

<?php require_once("../config/function.php");?>
<?php require_once("../config/head.php");?>
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
            <?php require_once("../config/nav.php"); ?>
                <div class="content-wrapper">

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">Tạo website riêng</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="ribbon-title ribbon-primary">Thông tin &amp; cấu hình</div>
                                        <div class="mt-4">
                            <div class="alert text-white bg-warning col-md-6 mx-auto" role="alert">
                                - Bạn phải đạt cấp bậc cộng tác viên hoặc đại lý mới có thể tạo web con nhé! <br>
                                - Nghiêm cấm các tiên miền có chữ : Facebook, Instagram để tránh bị vi phạm bản quyền. <br>
                                - Khách hàng tạo tài khoản và sử dụng dịch vụ ở site con. Tiền sẽ trừ vào tài khoản của đại lý ở
                                site chính. Vì thế để khách hàng mua được tài khoản đại lý phải còn số dư. <br />
                                - Chúng tôi hỗ trợ mục đích kinh doanh của tất cả cộng tác viên và đại lý!
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <form submit-ajax="LTT" method="post" action="<?= BASE_URL('api/change-token'); ?>" api_token="<?= $LTT->getUsers('token'); ?>">
                                    <input type="hidden" name="action" value="change-token">
                                    <div class="form-group">
                                        <label class="form-label" for="">Api Token</label>
                                        <div class="input-group mb-3">
                                            <input class="form-control" type="text" value="<?= $LTT->getUsers('token'); ?>" id="" readonly>
                                            <button type="submit" class="btn btn-primary" id="changeToken"><i class="fa fa-exchange"></i> Thay đổi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <form submit-ajax="LTT" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                                    <input type="hidden" name="action" value="set_tao_site">
                                    <div class="form-group">
                                        <label class="form-label" for="">Tên miền</label>
                                        <div class="input-group mb-3">
                                            <input class="form-control" type="text" name="domain" value="" placeholder="Nhập tiên miền cần kích hoạt">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu ngay</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $check_mien = $LTT->get_row(" SELECT * FROM `ds_sitecon` WHERE `username` = '" . $LTT->getUsers('username') . "'  AND  `url_config` = '" . $url_site_name . "' ");
        if ($check_mien) {
        ?>
            <div class="row pt-4">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-4">Trỏ về nameserver</h6>
                            <div class="col-md-12">

                                <label class="form-label" for="">Namesever1</label>
                                <div class="alert alert-danger text-center" role="alert">
                                    <h4 class="ntiendat-text-white text-center"><a href="javascript:;"><b id="name_sv1"><?= $LTT->check('name_sv1'); ?></b>&nbsp;<i class="fa fa-copy" onclick="coppy('name_sv1');"></i></a></h4>

                                </div> 
                                <label for="">Namesever2</label>
                                <div class="alert alert-danger text-center" role="alert">
                                    <h4 class="ntiendat-text-white text-center">
                                        <a href="javascript:;"><b id="name_sv2"><?= $LTT->check('name_sv2'); ?></b>&nbsp;<i class="fa fa-copy" onclick="coppy('name_sv2');"></i></a>
                                    </h4>
                                </div>
                                <?php if (strlen($LTT->check('name_sv3')) >= 3){?>
                                    <label for="">Namesever3</label>
                                    <div class="alert alert-danger text-center" role="alert">
                                    <h4 class="ntiendat-text-white text-center">
                                        <a href="javascript:;"><b id="name_sv2"><?= $LTT->check('name_sv3'); ?></b>&nbsp;<i class="fa fa-copy" onclick="coppy('name_sv4');"></i></a>
                                    </h4>
                                    </div>
                                <?php } if (strlen($LTT->check('name_sv4')) >= 3){?>
                                    <label for="">Namesever4</label>
                                    <div class="alert alert-danger text-center" role="alert">
                                    <h4 class="ntiendat-text-white text-center">
                                        <a href="javascript:;"><b id="name_sv2"><?= $LTT->check('name_sv4'); ?></b>&nbsp;<i class="fa fa-copy" onclick="coppy('name_sv4');"></i></a>
                                    </h4>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
        <div class="row pt-4">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="ribbon-title ribbon-primary">Nhật Kí Tạo</div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr role="row" class="bg-primary">
                                        <th class="text-center text-white">ID</th>
                                        <th class="text-center text-white">Tên miền</th>
                                        <th class="text-white">Ngày tạo</th>
                                        <th class="text-white">Trạng thái</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $getlistcard = $LTT->get_list("SELECT * FROM  `ds_sitecon` WHERE `username` = '$my_user'  AND  `url_config` = '" . $url_site_name . "'");
                                    if ($getlistcard) {
                                        $i = 1;
                                        foreach ($getlistcard as $rowucard) { ?>
                                            <tr class="odd">
                                                <td><?= $i++ ?></td>
                                                <td><?= $rowucard['domain'] ?></td>
                                                <td><?= $rowucard['date'] ?></td>
                                                <td><?= $rowucard['status'] ?></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr class="odd">
                                            <td valign="top" colspan="100%">
                                                <center>
                                                    <img src="/assets1/images/nodata.svg" alt="" width="80" height="80" class="pt-3">
                                                    <p class="pt-3">Không có dữ liệu để hiển thị</p>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table><?php require_once("../config/scr.php");?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
                    <?php require_once("../config/end.php");?>
                    
</body>

</html>