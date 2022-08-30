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
                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                    <input type="hidden" name="action" value="set_add_bank">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <center><label class="form-label" for="">Tên chủ tài khoản</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="tentaikhoan" placeholder=" Nhập tên chủ tài khoản"></input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <center><label class="form-label" for="">Số tài khoản</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="sotaikhoan" placeholder=" Nhập số tài khoản"></input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <center><label class="form-label" for="">Nạp tối thiểu</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="naptoithieu" placeholder=" Nhập số tiền nạp tối thiểu"></input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <center><label class="form-label" for="">Logo ngân hàng</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="logobank" placeholder=" Nhập link logo ngân hàng"></input>
                            </div>
                        </div>
                        <div class="col-md-4 mr-auto ml-auto pt-3">
                            <button type="submit" class="btn btn-primary btn-block">Thêm ngay <em class="fa fa-paper-plane"></em></button>
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
            </div>
            <div class="card-body">

                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                    <input type="hidden" name="action" value="set_napthe">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Site nạp thẻ</label>
                                <select class="form-control" name="sitenapthe">
                                   

                                    <option value="thesieuviet">SIEUCARDVIP.COM</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Cú pháp nạp tiền:</label>
                                <input type="text" class="form-control" value="<?= $LTT->site('cuphap'); ?>" name="cuphapnap" placeholder="Nhập cú pháp nạp tiền">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Partner KEY:</label>
                                <input type="text" class="form-control" name="PartnerKEY" value="<?= $LTT->site('partner_key'); ?>" require>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">TÊN WEBSITE</label>
                                <input type="text" class="form-control" name="PartnerID" value="<?= $LTT->site('partner_id'); ?>" require>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="">Link CallBack:</label>
                                <input type="text" class="form-control" value="https://<?= $_SERVER['SERVER_NAME'] ?>/callback/callback_sieucardvip.php" require>
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
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title mb-3">Auto nạp bank qua <a href="https://botsms.net/"> botsms.net</a></h6>
            </div>
            <div class="card-body">

                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                    <input type="hidden" name="action" value="set_auto_bank">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Nạp Khuyễn Mại %:</label>
                                <input type="text" class="form-control" name="nap_km_bank" value="<?= $LTT->site('nap_km_bank'); ?>" require>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Mã Bảo Mật:</label>
                                <input type="text" class="form-control" name="api_automm" value="<?= $LTT->site('api_automm'); ?>" require>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="">Link CallBack:</label>
                                <input type="text" class="form-control" name="callback_momo" value="https://<?= $_SERVER['SERVER_NAME'] ?>/callback/callback_bank.php" require>
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
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title mb-3">Danh sách bank</h6>
                <div class="table-responsive scrollbar">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-bordered table-striped fs--1 mb-3 dataTables-NTD dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead class="bg-200 text-900">
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 58.8438px;">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Tên chủ tài khoản: activate to sort column ascending" style="width: 162.031px;">Tên chủ tài khoản</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Số tài khoản: activate to sort column ascending" style="width: 193.031px;">Số tài khoản</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Ảnh demo: activate to sort column ascending" style="width: 96.0781px;">Ảnh demo</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 148.969px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getlistcard = $LTT->get_list("SELECT * FROM `bank` WHERE `status` = '1'  AND  `url_config` = '" . $url_site_name . "' ORDER BY `id` DESC ");
                                if ($getlistcard) {
                                    foreach ($getlistcard as $rowucard) { ?>
                                        <tr class="odd">
                                            <td><?= $rowucard['id'] ?></td>
                                            <td><?= $rowucard['namectk'] ?></td>
                                            <td><?= $rowucard['namestk'] ?></td>
                                            <td><img src="<?= $rowucard['img'] ?>" height="45px"></td>
                                            <td>
                                                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                                                    <input type="hidden" name="action" value="set_xoa_bank">
                                                    <input type="hidden" name="idbank" value="<?= $rowucard['id'] ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
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