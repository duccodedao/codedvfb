<?php
require('head.php');
require('nav.php');
?>

<?php if ($LTT->getUsers('capbac') !== '99') {
    header('Location: /404');
    exit;
} ?>
<!-- Content Wrapper. Contains page content -->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <h6 class="card-title mb-3">Đăng nhập momo</h6>
            </div>
            <div class="card-body">
                <form submit-ajax="NTD" action="<?= BASE_URL('api/Admin-Momo-Ajax'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                    <input type="hidden" name="action" value="loginmomo">
                    <o id="act"></o>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <center><label class="form-label" for="">Số điện thoại</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="phonemomo" value="" placeholder=" Nhập tên số điện thoại momo"></input>
                            </div>
                        </div>
                        <div class="col-md-12 password hidden">
                            <div class="form-group">
                                <center><label class="form-label" for="">Mật khẩu</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="passmomo" value="" placeholder=" Nhập mật khẩu momo"></input>
                            </div>
                        </div>
                        <div class="col-md-12 codeotp hidden">
                            <div class="form-group">
                                <center><label class="form-label" for="">Mã xác thực</label></center>
                                <input type="text" rows="5" cols="50" class="form-control" name="codeotp" value="" placeholder=" Nhập mã xác thực"></input>
                            </div>
                        </div>

                        <div class="col-md-4 mr-auto ml-auto pt-3">
                            <o id="buttonInput"></o>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("div.hidden").hide();
        $("#act").html('<input type="hidden" name="act" value="sendotp">');
        $("#buttonInput").html('<button callback="callback" type="submit" class="btn btn-primary btn-block">Đăng nhập <em class="fa fa-paper-plane"></em></button>');
    });

    function callback(res) {
        if (res.status === true && res.step === 'veryotp') {
            $("div.codeotp").show();
            $("#act").html('<input type="hidden" name="act" value="veryotp">');
            $("#buttonInput").html('<button callback="callback" type="submit" class="btn btn-primary btn-block">Xác thực <em class="fa fa-paper-plane"></em></button>');
        }
        if (res.status === true && res.step === 'login') {
            $("div.codeotp").remove();
            $("div.password").show();
            $("#act").html('<input type="hidden" name="act" value="login">');
            $("#buttonInput").html('<button callback="callback" type="submit" class="btn btn-primary btn-block">Đăng nhập <em class="fa fa-paper-plane"></em></button>');
        }

        if (res.status === true && res.step === 'SUCCESS') {
            location.reload();
        }

        swal(
            res.message,
            res.status === true ? "success" : "error"
        );
    }
</script>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title mb-3">Danh sách account momo</h6>
                <div class="table-responsive scrollbar">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-bordered table-striped fs--1 mb-3 dataTables-NTD dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead class="bg-200 text-900">
                                <tr role="row" history>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 58.8438px;">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Người buff: activate to sort column ascending" style="width: 162.031px;">Số điện thoại</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="type order: activate to sort column ascending" style="width: 193.031px;">Số dư </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Trạng thái: activate to sort column ascending" style="width: 211.047px;">Tên</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Trạng thái: activate to sort column ascending" style="width: 211.047px;">Site</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 211.047px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($url_site_name == $URL_ADMIN) {
                                    $getlistcard = $LTT->get_list("SELECT * FROM `cron_momo`  ORDER BY `id` DESC ");
                                } else {
                                    $getlistcard = $LTT->get_list("SELECT * FROM `cron_momo` WHERE  `sitename` = '" . $url_site_name . "' ORDER BY `id` DESC ");
                                }
                                if ($getlistcard) {
                                    foreach ($getlistcard as $rowucard) { ?>
                                        <tr class="odd">
                                            <td><?= $rowucard['id'] ?></td>
                                            <td><?= $rowucard['phone'] ?></td>
                                            <td><?= number_format($rowucard['BALANCE']) ?></td>
                                            <td><?= $rowucard['Name'] ?></td>
                                            <td><?= $rowucard['sitename'] ?></td>
                                            <td>
                                                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                                                    <input type="hidden" name="action" value="delete_momo">
                                                    <input type="hidden" name="id" value="<?= $rowucard['id'] ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
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