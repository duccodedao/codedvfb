<?php
require('head.php');
require('nav.php');
if ($url_site_name !== $URL_ADMIN) {
    header('Location: /');
    exit;
}
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

                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                    <input type="hidden" name="action" value="set_config_admin">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Link Host</label>
                                <input type="text" class="form-control" value="<?= $LTT->check('link_host'); ?>" name="link_host"></input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">IP Host</label>
                                <input type="text" class="form-control" value="<?= $LTT->check('ip_host'); ?>" name="ip_host">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Tài Khoản Host</label>
                                <input type="text" class="form-control" name="username_host" value="<?= $LTT->check('username_host'); ?>" require>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Mật Khẩu Host</label>
                                <input type="text" class="form-control" name="password_host" value="<?= $LTT->check('password_host'); ?>" require>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">NameServer 1 *</label>
                                <input type="text" class="form-control" value="<?= $LTT->check('name_sv1'); ?>" name="name_sv1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">NameServer 2 *</label>
                                <input type="text" class="form-control" value="<?= $LTT->check('name_sv2'); ?>" name="name_sv2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">NameServer 3 ( Nếu có )</label>
                                <input type="text" class="form-control" value="<?= $LTT->check('name_sv3'); ?>" name="name_sv3">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">NameServer 4 ( Nếu có )</label>
                                <input type="text" class="form-control" value="<?= $LTT->check('name_sv4'); ?>" name="name_sv4">
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