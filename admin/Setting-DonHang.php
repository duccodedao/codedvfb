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
            <div class="card-body">
                <h6 class="card-title mb-3">Danh sách đơn hàng</h6>
                <div class="table-responsive scrollbar">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-bordered table-striped fs--1 mb-3 dataTables-NTD dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead class="bg-200 text-900">
                                <tr role="row" history>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 58.8438px;">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 58.8438px;">Thời gian</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Người buff: activate to sort column ascending" style="width: 162.031px;">Username</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="type order: activate to sort column ascending" style="width: 193.031px;">Dịch vụ</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Số lượng: activate to sort column ascending" style="width: 96.0781px;">Số lượng</th>
                                    <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Hoàn thành: activate to sort column ascending" style="width: 96.0781px;">Hoàn thành</th>-->
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Tổng tiền: activate to sort column ascending" style="width: 148.969px;">Tổng tiền</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Link buff: activate to sort column ascending" style="width: 148.969px;">ID or Link</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Server: activate to sort column ascending" style="width: 148.969px;">Mã đơn</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Server: activate to sort column ascending" style="width: 148.969px;">Server</th>

                                    <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Note: activate to sort column ascending" style="width: 148.969px;">Note</th>-->
                                    <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 148.969px;">Date</th>-->
                                    <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Mã giao dịch: activate to sort column ascending" style="width: 148.969px;">Mã giao dịch</th>-->
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Trạng thái: activate to sort column ascending" style="width: 211.047px;">Trạng thái</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 211.047px;">Thao tác</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 211.047px;">Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getlistcard = $LTT->get_list("SELECT * FROM `history_buy` WHERE  `url_config` = '" . $url_site_name . "' ORDER BY `id` DESC ");
                                if ($getlistcard) {
                                    foreach ($getlistcard as $rowucard) { ?>
                                        <tr class="odd">
                                            <td><?= $rowucard['id'] ?></td>
                                            <td><?= $rowucard['date'] ?></td>
                                            <td><?= $rowucard['username'] ?></td>
                                            <td><?= $rowucard['type'] ?></td>
                                            <td><?= $rowucard['soluong'] ?></td>
                                            <!--<td><?= $rowucard['da_buft'] ?></td>-->
                                            <td><?= format_money($rowucard['tong_tien']) ?></td>
                                            <td><b><?= $rowucard['link_buy'] ?></b></td>
                                            <td><?= $rowucard['ma_gd'] ?></td>
                                            <td><?= $rowucard['server_buy'] ?></td>

                                            <!--<td><?= $rowucard['note_buft'] ?></td>-->
                                            <!--<td><?= $rowucard['date'] ?></td>-->
                                            <!--<td><?= $rowucard['ma_gd'] ?></td>-->
                                            <td><b><?= statusorder($rowucard['status']) ?></b></td>
                                            <td><b>
                                                    <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                                                        <input type="hidden" name="action" value="set_donhang">
                                                        <?php if ($rowucard['status'] == 'Pendding') { ?>
                                                            <input type="hidden" name="action2" value="duyet">
                                                            <input type="hidden" name="code_order" value="<?= $rowucard['ma_gd'] ?>">
                                                            <input type="hidden" name="id" value="<?= $rowucard['id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm">Duyệt đơn</button>
                                                        <?php } else { ?>
                                                            <input type="hidden" name="action2" value="huy">
                                                            <input type="hidden" name="code_order" value="<?= $rowucard['ma_gd'] ?>">
                                                            <input type="hidden" name="id" value="<?= $rowucard['id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm">Hủy đơn</button>
                                                        <?php } ?>
                                                    </form>
                                                </b>



                                            </td>
                                            <td><a href="<?= BASE_URL('') ?>admin/edit_don_hang.php?id=<?= $rowucard['id'] ?>&ma_don=<?= $rowucard['ma_gd'] ?>&username=<?= $rowucard['username'] ?>" type="button" class="btn btn-success btn-sm">Chỉnh sửa</a></td>
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