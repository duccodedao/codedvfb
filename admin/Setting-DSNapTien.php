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
                <h6 class="card-title mb-3">Lịch sử nạp bank</h6>
                <div class="table-responsive scrollbar">
                    <div class="table-responsive scrollbar">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                            <table class="table table-bordered table-striped fs--1 mb-3 dataTables-NTD dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead class="bg-200 text-900">
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 35.9219px;">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thời gian: activate to sort column ascending" style="width: 178.25px;">Thời gian</th>
                                        <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Loại: activate to sort column ascending" style="width: 63.9531px;">Loại</th>-->
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Mã giao dịch: activate to sort column ascending" style="width: 122.516px;">Ngân Hàng</th>

                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Người chuyển: activate to sort column ascending" style="width: 134.234px;">Người chuyển</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thực nhận: activate to sort column ascending" style="width: 101.312px;">Thực nhận</th>

                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Nội dung: activate to sort column ascending" style="width: 211.812px;">Trạng Thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $getlistcard = $LTT->get_list("SELECT * FROM `history_naptien` WHERE `type` = 'Bank'  AND  `url_config` = '" . $url_site_name . "' ORDER BY `id` DESC ");
                                    if ($getlistcard) {
                                        foreach ($getlistcard as $rowucard) { ?>
                                            <tr class="odd">
                                                <td><?= $rowucard['id'] ?></td>
                                                <td><?= $rowucard['date'] ?>

                                                </td>
                                                </td>
                                                <td><?= ($rowucard['loaithe']) ?></td>


                                                <td><?= $rowucard['namemomo'] ?></td>
                                                <td><?= $rowucard['thucnhan'] ?> đ</td>

                                                <td><b><button type="button" class="btn btn-success btn-sm">Đã Duyệt</button></b></td>
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
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title mb-3">Lịch sử nạp thẻ</h6>
                <div class="table-responsive scrollbar">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-bordered table-striped fs--1 mb-3 dataTables-NTD dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead class="bg-200 text-900">
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 58.8438px;">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Loại thẻ: activate to sort column ascending" style="width: 162.031px;">Loại thẻ</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Mệnh giá: activate to sort column ascending" style="width: 193.031px;">Mệnh giá</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Seri: activate to sort column ascending" style="width: 96.0781px;">Seri</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Mã thẻ: activate to sort column ascending" style="width: 148.969px;">Mã thẻ</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Trạng thái: activate to sort column ascending" style="width: 211.047px;">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getlistcard = $LTT->get_list("SELECT * FROM `history_naptien` WHERE `type` = 'napthe'  AND  `url_config` = '" . $url_site_name . "' ORDER BY `id` DESC ");
                                if ($getlistcard) {
                                    foreach ($getlistcard as $rowucard) { ?>
                                        <tr class="odd">
                                            <td><?= $rowucard['id'] ?></td>
                                            <td><?= $rowucard['loaithe'] ?></td>
                                            <td><?= format_money($rowucard['menhgia']) ?>đ</td>
                                            <td><?= $rowucard['soseri'] ?></td>
                                            <td><?= $rowucard['sothe'] ?></td>
                                            <td><b><?= statuscard($rowucard['trangthai']) ?></b></td>
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