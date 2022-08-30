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
        <h6 class="card-title mb-3">Danh sách hỗ trợ</h6>
        <div class="table-responsive scrollbar">
          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
            <table class="table table-striped table-bordered mt-4 dataTables-NTD dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
              <thead class="bg-200 text-900">
                <tr role="row">
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 35.9219px;">#</th>
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thời gian: activate to sort column ascending" style="width: 178.25px;">Thời gian</th>
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Mã đơn: activate to sort column ascending" style="width: 178.25px;">Tài Khoản</th>
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Mã đơn: activate to sort column ascending" style="width: 178.25px;">Loại Hỗ Trợ</th>
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Link buff: activate to sort column ascending" style="width: 178.25px;">Tiêu Đề Hỗ Trợ</th>
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="server buff: activate to sort column ascending" style="width: 178.25px;">ID Đơn Hỗ Trợ</th>
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Số lượng: activate to sort column ascending" style="width: 178.25px;">Nội Dung</th>

                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="to money: activate to sort column ascending" style="width: 178.25px;">Nội Dung Xử Lý</th>

                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="To status: activate to sort column ascending" style="width: 178.25px;">Trạng thái</th>

                </tr>
              </thead>
              <tbody>
                <?php $getlistbuff = $LTT->get_list("SELECT * FROM `list_hotro` WHERE   `url_config` = '" . $url_site_name . "'
 ORDER BY `id` DESC ");
                if ($getlistbuff) {
                  foreach ($getlistbuff as $rowhbuff) { ?>
                    <tr class="odd">
                      <td><?= $rowhbuff['id'] ?></td>
                      <td><?= $rowhbuff['date'] ?></td>
                      <td><?= $rowhbuff['username'] ?></td>
                      <td><?= $rowhbuff['loai_hotro'] ?></td>
                      <td><?= $rowhbuff['tieu_de_hotro'] ?></td>

                      <td><?= $rowhbuff['id_hotro'] ?>
                      </td>

                      <td><?= $rowhbuff['noi_dung_hotro'] ?>
                      </td>
                      <td><b><?= $rowhbuff['noi_dung_xuly'] ?></b></td>
                      <td<?php if ($rowhbuff['status'] == "wait") { ?> <b><a href="/admin/sua_ho_tro.php?id=<?= $rowhbuff['id'] ?>&loai_ho_tro=<?= $rowhbuff['loai_hotro'] ?>" type="button" class="btn btn-warning btn-sm">Xử Lý Ngay</a></b>
                      <?php } else { ?>
                        <b><button type="button" class="btn btn-success btn-sm">Đã Xử Lý</button></b>

                      <?php } ?>
                      </td>

                    </tr>
                <?php }
                } ?>
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