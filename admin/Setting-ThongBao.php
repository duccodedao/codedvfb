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
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                    <input type="hidden" name="action" value="set_noti2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <center><label class="form-label" for="">Nhập Link Ảnh</label></center>
                                <input type="text" value="<?= $LTT->site('anh_thong_bao'); ?>" class="form-control" name="anh_thong_bao">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <center><label class="form-label" for="">Nhập thông báo nổi</label></center>
                                <input type="text" value="<?= $LTT->site('thongbao'); ?>" class="form-control" name="thongbao_noi">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <center><label class="form-label" for="">Thông Báo Gmail Cho Khách</label></center>

                                <select class="form-control show-tick" name="thong_bao_mail" required="">
                                    <option value="<?= $LTT->site('thong_bao_mail'); ?>"><?= $LTT->site('thong_bao_mail'); ?></option>
                                    <option value="ON">ON</option>
                                    <option value="OFF">OFF</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4 mr-auto ml-auto pt-3">
                            <button type="submit" class="btn btn-primary btn-block">Sửa <em class="fa fa-paper-plane"></em></button>
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
                    <input type="hidden" name="action" value="set_noti">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <center><label class="form-label" for="">Nhập thông báo</label></center>
                                <textarea type="number" rows="5" cols="50" class="form-control" name="thongbao"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 mr-auto ml-auto pt-3">
                            <button type="submit" class="btn btn-primary btn-block">Thông báo ngay <em class="fa fa-paper-plane"></em></button>
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
                <h6 class="card-title mb-3">Danh sách thông báo</h6>
                <div class="table-responsive scrollbar">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-bordered table-striped fs--1 mb-3 dataTables-NTD dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead class="bg-200 text-900">
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 58.8438px;">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Người đăng: activate to sort column ascending" style="width: 162.031px;">Người đăng</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Nội dung: activate to sort column ascending" style="width: 193.031px;">Nội dung</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 96.0781px;">Date</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 148.969px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getlistcard = $LTT->get_list("SELECT * FROM `note_thongbao` WHERE `nguoidang` = '$my_user'  AND  `url_config` = '" . $url_site_name . "' ORDER BY `id` DESC ");
                                if ($getlistcard) {
                                    foreach ($getlistcard as $rowucard) { ?>
                                        <tr class="odd">
                                            <td><?= $rowucard['id'] ?></td>
                                            <td><?= $rowucard['nguoidang'] ?></td>
                                            <td><?= $rowucard['noidung'] ?></td>
                                            <td><?= $rowucard['date'] ?></td>
                                            <td>
                                                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                                                    <input type="hidden" name="action" value="xoa_thongbao">
                                                    <input type="hidden" name="idnote" value="<?= $rowucard['id'] ?>">

                                                    <button type="submit" class="btn btn-danger btn-sm">Xóa thông báo</button>
                                                </form>

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