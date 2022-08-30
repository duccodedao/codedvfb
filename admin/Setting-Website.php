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
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">CẤU HÌNH THÔNG TIN WEBSITE</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form submit-ajax="NTD" action="<?= BASE_URL('api/admin/setting/website'); ?>" method="post"
                        api_token="<?= $LTT->getUsers('token'); ?>">
                        <input type="hidden" name="action" value="set_all">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ON/OFF Website</label>
                            <div class="col-sm-9">
                                <select class="form-control show-tick" name="bao_tri" required>
                                    <option value="<?= $LTT->site('bao_tri'); ?>"><?= $LTT->site('bao_tri'); ?>
                                    </option>
                                    <option value="ON">ON</option>
                                    <option value="OFF">OFF</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tên website</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="tenwebsite" value="<?= $LTT->site('ten_website'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Link website</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('base_url'); ?>" name="baseurl"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('mail_config'); ?>" name="mail_config"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mật Khẩu Email (Ứng Dụng)</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('pass_mail_config'); ?>"
                                        name="pass_mail_config" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mô tả website</label>
                            <div class="col-sm-9">
                                <div class="input-group my-colorpicker2 colorpicker-element" data-colorpicker-id="1">
                                    <input type="text" class="form-control" name="gioi_thieu_web"
                                        value="<?= $LTT->site('gioi_thieu_web'); ?>" data-original-title="" title=""
                                        aria-describedby="popover609875">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Từ khóa tìm kiếm</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="tu_khoa" value="<?= $LTT->site('tu_khoa'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Logo website</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="logo" value="<?= $LTT->site('logo'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Logo Mini</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="logo_mini" value="<?= $LTT->site('logo_mini'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Favicon website</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="favicon" value="<?= $LTT->site('favicon'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ảnh giới thiệu website</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="anhbia" value="<?= $LTT->site('anhbia'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hotline</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="hotline" value="<?= $LTT->site('phone_zalo'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Facebook</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="facebook" value="<?= $LTT->site('facebook'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Trạng Thái Xác Thực OTP Đăng Kí</label>
                            <div class="col-sm-9">
                                <select class="form-control show-tick" name="otp" required>
                                    <option value="<?= $LTT->site('auth_otp'); ?>">
                                        <?= $LTT->site('auth_otp'); ?>
                                    </option>
                                    <option value="ON">ON</option>
                                    <option value="OFF">OFF</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Token Bot Telegram</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="bot_tele" value="<?= $LTT->site('bot_tele'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ID Chat Telegram</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="id_chat_tele" value="<?= $LTT->site('id_chat_tele'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ID Page</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="id_page_chat" value="<?= $LTT->site('id_page_chat'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mức Nạp CTV</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('rate_ctv'); ?>" name="ratectv"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mức Nạp Đại Lý</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="ratedaily" value="<?= $LTT->site('rate_daily'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mức Nạp NPP</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" name="ratenpp" value="<?= $LTT->site('rate_admin'); ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Chiết Khấu Thành Viên</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('ck_user'); ?>" name="ck_user"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Chiết Khấu CTV</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('ck_ctv'); ?>" name="ck_ctv"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Chiết Khấu Đại Lý</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('ck_dl'); ?>" name="ck_dl"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Chiết Khấu NPP</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('ck_npp'); ?>" name="ck_npp"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Chiết Khấu Thẻ</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('ck_thecao'); ?>" name="ck_thecao"
                                        class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ON/OFF Làm Tròn Giá Tiền</label>
                            <div class="col-sm-9">
                                <select class="form-control show-tick" name="trang_thai_lam_tron" required>
                                    <option value="<?= $LTT->site('trang_thai_lam_tron'); ?>">
                                        <?= $LTT->site('trang_thai_lam_tron'); ?>
                                    </option>
                                    <option value="ON">ON</option>
                                    <option value="OFF">OFF</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Link IMG_1</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('img_1'); ?>" name="img_1"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Link IMG_2</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('img_2'); ?>" name="img_2"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Link IMG_3</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <input type="text" value="<?= $LTT->site('img_3'); ?>" name="img_3"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">JavaSciprt</label>
                            <div class="col-sm-9">
                                <div class="form-line">
                                    <textarea class="form-control" name="script_live_chat"
                                        rows="6"><?= $LTT->site('script_live_chat'); ?></textarea>
                                </div>
                                <i>Chứa sciprt Live Chat, Google Analytics hoặc các sciprt khác.</i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <span>Cập Nhật</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
require('foot.php');

?>