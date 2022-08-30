<?php
require('head.php');
require('nav.php');
?>

<?php if ($LTT->getUsers('capbac') !== '99') {
    header('Location: /404');
    exit;
} ?>
<?php
$total_money = $LTT->get_row("SELECT SUM(`money`) FROM `users` WHERE `money` >= 0  AND  `url_config` = '" . $url_site_name . "' ")['SUM(`money`)'];

$total_thanhvien = $LTT->get_row("SELECT COUNT(*) FROM `users`  WHERE  `url_config` = '" . $url_site_name . "'")['COUNT(*)'];


$total_nap = $LTT->get_row("SELECT SUM(`tongnap`) FROM `users` WHERE `tongnap` >= 0 AND  `url_config` = '" . $url_site_name . "' ")['SUM(`tongnap`)'];


$total_tru = $LTT->get_row("SELECT SUM(`tongtru`) FROM `users` WHERE `tongtru` >= 0  AND  `url_config` = '" . $url_site_name . "'  ")['SUM(`tongtru`)'];


$total_card = $LTT->get_row("SELECT COUNT(*) FROM `history_naptien` WHERE  `url_config` = '" . $url_site_name . "' ")['COUNT(*)'];

$total_don = $LTT->get_row("SELECT COUNT(*) FROM `history_buy`  WHERE  `url_config` = '" . $url_site_name . "'")['COUNT(*)'];

?>
<!-- Content Wrapper. Contains page content -->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
            </div>
            <div class="card-body">
                <?php $getsvdv = $LTT->get_row("SELECT * FROM `history_buy` WHERE `id` = '" . $_GET['id'] . "' AND `ma_gd` = '" . $_GET['ma_don'] . "' AND `username` = '" . $_GET['username'] . "'") ?>
                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                    <input type="hidden" name="action" value="set_sua_don_dv">
                    <input type="hidden" name="id_dv" value="<?= $_GET['id']; ?>">
                    <input type="hidden" name="username" value="<?= $_GET['username']; ?>">
                    <input type="hidden" name="ma_gd" value="<?= $_GET['ma_don']; ?>">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="">Tên Khách:</label>
                                <input type="text" class="form-control" value="<?= $_GET['username']; ?>" require>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="">Dịch Vụ:</label>
                                <input type="text" class="form-control" value="<?= $getsvdv['type']; ?>" require>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="">Server : </label>
                                <input type="text" class="form-control" value="<?= $getsvdv['server_buy']; ?>" require>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="">ID Buy : </label>
                                <input type="text" class="form-control" value="<?= $getsvdv['link_buy']; ?>" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="">Bắt Đầu : </label>
                                <input type="text" class="form-control" name="number_star" value="<?= $getsvdv['number_star']; ?>" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="">Kết Thúc : </label>
                                <input type="text" class="form-control" name="number_end" value="<?= $getsvdv['number_end']; ?>" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="">Trạng Thái : </label>
                                <select class="form-control show-tick" name="trang_thai" required="">

                                    <option value="<?= $getsvdv['status']; ?>"><?php if ($getsvdv['status'] == "Success") { ?> Hoàn Thành <?php } elseif ($getsvdv['status'] == "Start") { ?>Đang Hoạt Động<?php } elseif ($getsvdv['status'] == "Pause") { ?> Đã Huỷ <?php } elseif ($getsvdv['status'] == "Pendding") { ?>Chờ Duyệt <?php } ?></option>

                                    <option value="Success">Hoàn Thành</option>
                                    <option value="Start">Bắt Đầu</option>
                                    <option value="Pause">Huỷ Đơn</option>
                                    <option value="Pendding">Chờ Duyệt</option>


                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mr-auto ml-auto pt-3">
                            <button type="submit" class="btn btn-primary btn-block"><em class="fa fa-paper-plane"></em> Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
require('foot.php');

?>