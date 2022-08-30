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


<!-- Main content -->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <!--<div class="row">-->
                <!--    <div class="col-6"><a href="<?= BASE_URL('recharge/banking'); ?>" class="btn btn-outline-primary btn-block">Chuyển khoản</a>-->
                <!--    </div>-->
                <!--    <div class="col-6"><a href="<?= BASE_URL('recharge/card'); ?>" class="btn btn-primary btn-block">Thêm thông báo</a>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
            <div class="card-body">
                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                    <input type="hidden" name="action" value="band_ip">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <center><label class="form-label" for="">Nhập IP</label></center>
                                <input placeholder="Nhập IP muốn band" type="text" class="form-control" name="ip_band">
                            </div>
                        </div>
                        <div class="col-md-4 mr-auto ml-auto pt-3">
                            <button type="submit" class="btn btn-primary btn-block">Khoá<em class="fa fa-paper-plane"></em></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title mb-3">Danh sách IP band</h6>
                <div class="table-responsive scrollbar">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-bordered table-striped fs--1 mb-3 dataTables-NTD dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead class="bg-200 text-900">
                                <tr role="row" history>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 35.9219px;">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thời gian: activate to sort column ascending" style="width: 44350px;">Địa Chỉ Ip</th>

                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 211.047px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getlist_api = $LTT->get_list("SELECT * FROM `band_ip` WHERE  `url_config` = '" . $url_site_name . "' ");
                                if ($getlist_api) {
                                    foreach ($getlist_api as $row_API) { ?>
                                        <tr class="odd">
                                            <td><?= $row_API['id'] ?></td>
                                            <td><?= $row_API['ip_band'] ?></td>




                                            <td><b>
                                                    <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                                                        <input type="hidden" name="action" value="xoa_ip_band">

                                                        <input type="hidden" name="xoa_ip_band" value="<?= $row_API['ip_band'] ?>">

                                                        <button type="submit" class="btn btn-danger btn-sm">Xoá</button>

                                                    </form>
                                                </b>



                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="dataTables_empty">
                                            <center>Không có dữ liệu để hiển thị</center>
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
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
require('foot.php');

?>