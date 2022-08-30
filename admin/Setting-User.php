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
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-alt"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Số Dư</span>
            <span class="info-box-number">
              <?= format_money($total_money); ?>
              <small>đ</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Tổng Nạp</span>
            <span class="info-box-number"><?= format_money($total_nap); ?> <small>đ</small></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Đã Tiêu</span>
            <span class="info-box-number"><?= format_money($total_tru); ?><small>đ</small></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Tổng Thành Viên</span>
            <span class="info-box-number"><?= format_money($total_thanhvien); ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-12 col-md-6 col-md-6">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fab fa-cc-apple-pay"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Tổng Đơn Nạp</span>
            <span class="info-box-number">
              <?= $total_card; ?>
              <small>thẻ</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>


      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Tổng Đơn</span>
            <span class="info-box-number"><?= format_money($total_don); ?> <small>đơn</small></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->


    <!-- /.row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Cộng/Trừ Tiền</h3><br>

            <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
              <input type="hidden" name="action" value="set_congtien">
              <div class="form-group">
                <label class="col-form-label">Action:</label>
                <select class="form-control show-tick" name="action2" required>


                  <option value="cong">Cộng Tiền</option>
                  <option value="tru">Trừ Tiền</option>
                </select>
              </div>
              <div class="form-group">

                <label class="col-form-label">Username:</label>
                <input type="text" class="form-control" name="username">
              </div>
              <div class="form-group">
                <label class="col-form-label">Nhập số tiền:</label>
                <input type="number" class="form-control" name="usermoney">
              </div>
              <div class="form-group">
                <label class="col-form-label">Nội Dung:</label>
                <input type="text" class="form-control" placeholder="Admin cộng tiền..." name="noidung">
              </div>
              <button type="submit" class="btn btn-primary">Thực Hiện</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Khoá / Mở Tài Khoản</h3><br>

            <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
              <input type="hidden" name="action" value="set_band">
              <div class="form-group">

                <label class="col-form-label">Username:</label>
                <input type="text" class="form-control" name="username">
              </div>
              <div class="form-group">
                <label class="col-form-label">Action:</label>
                <select class="form-control show-tick" name="action2" required>

                  <option value="khoa">Khoá</option>
                  <option value="mo">Mở</option>
                  <option value="xoa">Xoá</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Thực Hiện</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-12">
        <!-- MAP & BOX PANE -->

        <!-- /.card -->


        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Thành Viên</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>


          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive scrollbar">
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <table class="table table-bordered table-striped fs--1 mb-3 dataTables-NTD dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                  <thead class="bg-200 text-900">
                    <tr role="row" history>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 58.8438px;">#</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending" style="width: 162.031px;">Name</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending" style="width: 162.031px;">Username</th>

                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending" style="width: 162.031px;">Cấp Bậc</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending" style="width: 162.031px;">Thời Gian Tạo Tài Khoản</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending" style="width: 162.031px;">Địa Chỉ ip</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Money: activate to sort column ascending" style="width: 162.031px;">Money</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Tổng nạp: activate to sort column ascending" style="width: 193.031px;">Tổng Nạp</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Tổng trừ: activate to sort column ascending" style="width: 96.0781px;">Tổng Đã Tiêu</th>
                      <?php if ($url_site_name == $URL_ADMIN) { ?><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Tổng trừ: activate to sort column ascending" style="width: 96.0781px;">Site</th><?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($url_site_name == $URL_ADMIN) {
                      $getlistcard = $LTT->get_list("SELECT * FROM `users` ORDER BY `id` DESC ");
                    } else {
                      $getlistcard = $LTT->get_list("SELECT * FROM `users`  WHERE `url_config` = '" . $url_site_name . "' ORDER BY `id` DESC ");
                    }
                    if ($getlistcard) {
                      foreach ($getlistcard as $rowucard) { ?>
                        <tr class="odd">
                          <td><?= $rowucard['id'] ?></td>
                          <td><?= $rowucard['name'] ?></td>
                          <td><?= $rowucard['username'] ?></td>

                          <td><?= $rowucard['capbac'] ?></td>
                          <td><?= $rowucard['date'] ?></td>

                          <td><?= $rowucard['ip'] ?></td>

                          <td><?= format_money($rowucard['money']); ?>đ</td>
                          <td><?= format_money($rowucard['tongnap']); ?>đ</td>
                          <td><?= format_money($rowucard['tongtru']); ?>đ</td>
                          <?php if ($url_site_name == $URL_ADMIN) { ?><td><?= $rowucard['url_config']; ?></td><?php } ?>
                          <!--<form id="active-form">-->
                          <input type="hidden" id="moneyuser" value="<?= $rowucard['username'] ?>" />
                          <!--</form>-->

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
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New</a>
            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All</a>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->


      <!-- /.col -->
    </div>

    <div class="row">
      <!-- Left col -->
      <div class="col-md-12">
        <!-- MAP & BOX PANE -->

        <!-- /.card -->


        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Latest Orders</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive scrollbar">
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <table class="table table-bordered table-striped fs--1 mb-3 dataTables-NTD dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                  <thead class="bg-200 text-900">
                    <tr role="row">
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 58.8438px;">#</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="note: activate to sort column ascending" style="width: 162.031px;">Username </th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="note: activate to sort column ascending" style="width: 162.031px;">Nội Dung </th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="ip: activate to sort column ascending" style="width: 193.031px;">Địa Chỉ ip</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="date: activate to sort column ascending" style="width: 96.0781px;">Thời Gian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($url_site_name == $URL_ADMIN) {
                      $getlistcard = $LTT->get_list("SELECT * FROM `log_site` ");
                    } else {
                      $getlistcard = $LTT->get_list("SELECT * FROM `log_site` WHERE `url_config` = '" . $url_site_name . "'");
                    }
                    if ($getlistcard) {
                      foreach ($getlistcard as $rowucard) { ?>
                        <tr class="odd">
                          <td><?= $rowucard['id'] ?></td>
                          <td><?= $rowucard['username'] ?></td>
                          <td><?= $rowucard['note'] ?></td>
                          <td><?= $rowucard['ip'] ?></td>
                          <td><?= $rowucard['date'] ?></td>
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
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->

          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->


      <!-- /.col -->
    </div>

    <!-- /.row -->
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
require('foot.php');

?>