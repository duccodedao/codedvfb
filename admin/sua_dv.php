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
                <?php $getsvdv = $LTT->get_row("SELECT * FROM `server_service` WHERE `id` = '" . $_GET['id'] . "'") ?>
                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                    <input type="hidden" name="action" value="set_sua_gia_dv">
                    <input type="hidden" name="idsv" value="<?= $_GET['id']; ?>">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Thông báo server:</label>
                                <input type="text" class="form-control" name="notesv" value="<?= $getsvdv['title_service']; ?>" require>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Rate server:</label>
                                <input type="text" class="form-control" name="ratesv" value="<?= $getsvdv['rate_service']; ?>" require>
                            </div>
                        </div>
                        <?php
                        if ($url_site_name == $URL_ADMIN) { ?> <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="">Server name: </label>
                                    <input type="text" class="form-control" name="server_name" value="<?= $getsvdv['server_name']; ?>" require>
                                </div>
                            </div><?php } ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Server : </label>
                                <input type="text" class="form-control" value="<?= $getsvdv['server_service']; ?>" require>
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