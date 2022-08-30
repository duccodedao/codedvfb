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
                <h6 class="card-title mb-3">Điều kiện tạo site</h6>
            </div>
            <div class="card-body">
                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post"
                    api_token="<?= $LTT->getUsers('token'); ?>">
                    <input type="hidden" name="action" value="set_dk_tao_site">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <center><label class="form-label" for="">Số Dư</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="so_du_tao_site"
                                    value="<?= $LTT->site('so_du_tao_site') ?>"
                                    placeholder=" Nhập tên chủ tài khoản"></input>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <center><label class="form-label" for="">Tổng Tiêu</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="so_tieu_tao_site"
                                    value="<?= $LTT->site('so_tieu_tao_site') ?>"
                                    placeholder=" Nhập số tài khoản"></input>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <center><label class="form-label" for="">Cấp Bậc Tối Thiểu</label></center>
                                <select class="form-control show-tick" name="cap_bac_tao_site" required="">

                                    <?php
                                    if ($LTT->site('cap_bac_tao_site') == 0) {
                                        $cap_bac_tao = "Thành Viên";
                                    } elseif ($LTT->site('cap_bac_tao_site') == 1) {
                                        $cap_bac_tao = "Cộng Tác Viên";
                                    } elseif ($LTT->site('cap_bac_tao_site') == 2) {
                                        $cap_bac_tao = "Đại Lý";
                                    } elseif ($LTT->site('cap_bac_tao_site') == 3) {
                                        $cap_bac_tao = "Nhà Phân Phối";
                                    }
                                    ?>

                                    <option value="<?= $LTT->site('cap_bac_tao_site') ?>"><?= $cap_bac_tao; ?></option>
                                    <option value="0">Thành Viên</option>
                                    <option value="1">Cộng Tác Viên</option>
                                    <option value="2">Đại Lý</option>
                                    <option value="3">Nhà Phân Phối</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mr-auto ml-auto pt-3">
                            <button type="submit" class="btn btn-primary btn-block">Cập Nhật <em
                                    class="fa fa-paper-plane"></em></button>
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
                <h6 class="card-title mb-3">Danh sách site con</h6>
                <div class="table-responsive scrollbar">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-bordered table-striped fs--1 mb-3 dataTables-NTD dataTable no-footer"
                            id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead class="bg-200 text-900">
                                <tr role="row" history>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="#: activate to sort column ascending"
                                        style="width: 58.8438px;">#</th>

                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Người buff: activate to sort column ascending"
                                        style="width: 162.031px;">Username</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="type order: activate to sort column ascending"
                                        style="width: 193.031px;">Tên Website</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Trạng thái: activate to sort column ascending"
                                        style="width: 211.047px;">Tên Website Mẹ</th>


                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Server: activate to sort column ascending"
                                        style="width: 148.969px;">Thời Gian</th>


                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Trạng thái: activate to sort column ascending"
                                        style="width: 211.047px;">Trạng thái</th>

                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Trạng thái: activate to sort column ascending"
                                        style="width: 211.047px;">IP</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Thao tác: activate to sort column ascending"
                                        style="width: 211.047px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($url_site_name == $URL_ADMIN) {
                                    $getlistcard = $LTT->get_list("SELECT * FROM `ds_sitecon`  ORDER BY `id_site` DESC ");
                                } else {
                                    $getlistcard = $LTT->get_list("SELECT * FROM `ds_sitecon` WHERE  `url_config` = '" . $url_site_name . "' ORDER BY `id_site` DESC ");
                                }
                                if ($getlistcard) {
                                    foreach ($getlistcard as $rowucard) { ?>
                                <tr class="odd">
                                    <td><?= $rowucard['id_site'] ?></td>
                                    <td><?= $rowucard['username'] ?></td>
                                    <td><?= $rowucard['site_con'] ?></td>
                                    <td><?= $rowucard['site_me'] ?></td>
                                    <td><?= $rowucard['date'] ?></td>
                                    <td><?= $rowucard['status'] ?></td>
                                    <td><?= $rowucard['ip'] ?></td>
                                    <td>
                                        <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>"
                                            method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                                            <input type="hidden" name="action" value="set_tat_bat_site">
                                            <?php if ($rowucard['status'] == "Band") { ?>
                                            <input type="hidden" name="type" value="mo_site">
                                            <input type="hidden" name="site_con" value="<?= $rowucard['site_con'] ?>">
                                            <input type="hidden" name="username" value="<?= $rowucard['username'] ?>">

                                            <button type="submit" class="btn btn-success btn-sm">Mở Khoá</button>
                                            <?php } else { ?>

                                            <input type="hidden" name="type" value="khoa_site">
                                            <input type="hidden" name="site_con" value="<?= $rowucard['site_con'] ?>">
                                            <input type="hidden" name="username" value="<?= $rowucard['username'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Khoá Site</button>
                                            <?php } ?>

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