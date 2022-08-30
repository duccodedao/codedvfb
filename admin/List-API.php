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
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 35.9219px;">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thời gian: activate to sort column ascending" style="width: 178.25px;">Thời gian</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Mã đơn: activate to sort column ascending" style="width: 178.25px;">Tên API</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Link buff: activate to sort column ascending" style="width: 178.25px;">Token</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="server buff: activate to sort column ascending" style="width: 178.25px;">Link Callback</th>

                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="To status: activate to sort column ascending" style="width: 178.25px;">Trạng thái</th>

                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 211.047px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getlist_api = $LTT->get_list("SELECT * FROM `list_api` WHERE  `url_config` = '" . $url_site_name . "' ");
                                if ($getlist_api) {
                                    foreach ($getlist_api as $row_API) { ?>
                                        <tr class="odd">
                                            <td><?= $row_API['id'] ?></td>
                                            <td><?= $row_API['date'] ?></td>
                                            <td><?= $row_API['name_api'] ?></td>
                                            <td><?= $row_API['token'] ?></td>
                                            <td><?= $row_API['link_callback'] ?></td>

                                            <td><?php if ($row_API['status'] == "wait") { ?> <b><button type="button" class="btn btn-warning btn-sm">Đang Chờ</button></b>
                                            <?php } elseif ($row_API['status'] == "block") { ?>
                                                <b><button type="button" class="btn btn-danger btn-sm">Đã Khoá</button></b>
                                            <?php } elseif ($row_API['status'] == "active") { ?>
                                                <b><button type="button" class="btn btn-success btn-sm">Đã Duyệt</button></b>
                                            <?php } ?>
                                            </td>
                                            <td><b>
                                                    <form submit-ajax="NTD" action="<?= BASE_URL('api/them-api'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                                                        <input type="hidden" name="action" value="set_apier">
                                                        <?php if ($row_API['status'] == 'wait') { ?>
                                                            <input type="hidden" name="action2" value="duyet">
                                                            <input type="hidden" name="token" value="<?= $row_API['token'] ?>">
                                                            <input type="hidden" name="id" value="<?= $row_API['id'] ?>">
                                                            <button type="submit" class="btn btn-success btn-sm">Duyệt</button>
                                                        <?php } elseif ($row_API['status'] == 'active') { ?>
                                                            <input type="hidden" name="action2" value="block">
                                                            <input type="hidden" name="token" value="<?= $row_API['token'] ?>">
                                                            <input type="hidden" name="id" value="<?= $row_API['id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm">Khoá</button>
                                                        <?php } elseif ($row_API['status'] == 'block') { ?>
                                                            <input type="hidden" name="action2" value="mo">
                                                            <input type="hidden" name="token" value="<?= $row_API['token'] ?>">
                                                            <input type="hidden" name="id" value="<?= $row_API['id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm">Mở</button>
                                                        <?php } ?>
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