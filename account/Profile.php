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
                    <h4 class="fw-bold py-3 mb-4">Thông tin tài khoản</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="ribbon-title ribbon-primary">Thông tin tài khoản</div>
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label class="form-label" for="">Họ và tên</label>
                                                <input type="text" class="form-control"
                                                    value="<?=$LTT -> getUsers("name")?>" readonly>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label class="form-label" for="">Email</label>
                                                <input type="text" class="form-control"
                                                    value="<?=$LTT -> getUsers("email")?>" readonly>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label class="form-label" for="">Tài khoản</label>
                                                <input type="text" class="form-control"
                                                    value="<?=$LTT -> getUsers("username")?>" readonly>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label class="form-label" for="">Số dư</label>
                                                <input type="text" class="form-control"
                                                    value="<?=$LTT -> getUsers("money")?> coin" readonly>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label class="form-label" for="">Cấp độ</label>
                                                <input type="text" class="form-control" value="<?=$level?>" readonly>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label class="form-label" for="">Thời gian tham gia</label>
                                                <input type="text" class="form-control"
                                                    value="<?= $LTT->getUsers('date'); ?>" readonly>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <form submit-ajax="LTT" method="post"
                                                    action="<?= BASE_URL('api/change-token'); ?>"
                                                    api_token="<?= $LTT->getUsers('token'); ?>">
                                                    <label class="form-label" for="">Api Token</label>
                                                    <input type="hidden" name="action" value="change-token">
                                                    <div class="input-group">
                                                        <input class="form-control" type="text"
                                                            value="<?= $LTT->getUsers('token'); ?>" id="" readonly>
                                                        <button type="submit" class="btn btn-primary"
                                                            id="changeToken"><i class="fa fa-exchange"></i> Thay
                                                            đổi</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="ribbon-title ribbon-primary">Đổi mật khẩu</div>
                                    <div class="mt-4">
                                        <form submit-ajax="LTT" action="<?= BASE_URL("api/change-pass"); ?>"
                                            method="post" api_token="<?= $LTT->getUsers('token') ?>"
                                            href="/auth/logout">
                                            <input type="hidden" name="action" value="change-pass">
                                            <div class="mb-3">
                                                <label class="form-label">Mật khẩu cũ</label>
                                                <input type="password" class="form-control" name="old_password"
                                                    placeholder="Nhập mật khẩu cũ">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Mật khẩu mới</label>
                                                <input type="password" class="form-control" name="new_password"
                                                    placeholder="Nhập mật khẩu mới">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Mật khẩu mới</label>
                                                <input type="password" class="form-control" name="confirm_new_password"
                                                    placeholder="Nhập lại mật khẩu mới">
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-lock"></i>
                                                    Thay
                                                    đổi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="ribbon-title ribbon-primary">Nhật kí hoạt động</div>
                                    <div class="mt-4">
                                        <form action="https://subgiare.vn/profile/info">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control"
                                                    placeholder="Nhập id, content tìm kiếm ..." name="search" value="">
                                                <button class="btn btn-primary" type="submit"><i
                                                        class="fa fa-search"></i> Tìm kiếm</button>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap">
                                                <thead>
                                                    <tr role="row" class="bg-primary">
                                                        <th class="text-center text-white">ID</th>
                                                        <th class="text-center text-white">Username</th>
                                                        <th class="text-white">Nội dung</th>
                                                        <th class="text-white">IP</th>
                                                        <th class="text-center text-white">Thời gian</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $getlistcard = $LTT->get_list("SELECT * FROM `log_site` WHERE `username` = '" . $LTT->getUsers('username') . "' AND  `url_config` = '" . $url_site_name . "'  ORDER BY `id` DESC");
                                    if ($getlistcard) {
                                        foreach ($getlistcard as $rowucard) { ?>
                                                    <tr class="odd">
                                                        <td><?= $rowucard['id'] ?></td>
                                                        <td><?= $rowucard['username'] ?></td>
                                                        <td><?= $rowucard['note'] ?></td>
                                                        <td><?= $rowucard['ip'] ?></td>
                                                        <td><?= $rowucard['date'] ?></td>
                                                    </tr>
                                                    <?php }
                                    } else { ?>
                                                    <tr class="odd">
                                                        <td valign="top" colspan="100%">
                                                            <center>
                                                                <img src="/assets/images/nodata.svg" alt="" width="80"
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
                </div>
                <?php require_once("../config/scr.php");?>
                <?php require_once("../config/end.php");?>

</body>

</html>