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
                                <label class="form-label" for="">T??n Kh??ch:</label>
                                <input type="text" class="form-control" value="<?= $_GET['username']; ?>" require>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="">D???ch V???:</label>
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
                                <label class="form-label" for="">B???t ?????u : </label>
                                <input type="text" class="form-control" name="number_star" value="<?= $getsvdv['number_star']; ?>" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="">K???t Th??c : </label>
                                <input type="text" class="form-control" name="number_end" value="<?= $getsvdv['number_end']; ?>" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="">Tr???ng Th??i : </label>
                                <select class="form-control show-tick" name="trang_thai" required="">

                                    <option value="<?= $getsvdv['status']; ?>"><?php if ($getsvdv['status'] == "Success") { ?> Ho??n Th??nh <?php } elseif ($getsvdv['status'] == "Start") { ?>??ang Ho???t ?????ng<?php } elseif ($getsvdv['status'] == "Pause") { ?> ???? Hu??? <?php } elseif ($getsvdv['status'] == "Pendding") { ?>Ch??? Duy???t <?php } ?></option>

                                    <option value="Success">Ho??n Th??nh</option>
                                    <option value="Start">B???t ?????u</option>
                                    <option value="Pause">Hu??? ????n</option>
                                    <option value="Pendding">Ch??? Duy???t</option>


                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mr-auto ml-auto pt-3">
                            <button type="submit" class="btn btn-primary btn-block"><em class="fa fa-paper-plane"></em> C???p nh???t</button>
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