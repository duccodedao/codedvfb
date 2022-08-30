<!DOCTYPE html>
<?php require_once("../../config/function.php");?>
<html lang="en" class="dark-style layout-navbar-fixed layout-menu-100vh layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="/sneat/assets/" data-template="vertical-menu-template-starter">

<?php
require_once("../../config/head.php");
$text = getCurURL();
$dtb = "view_video";
$action = "view-video";
$title = "View Video"; 
if (empty($_SESSION['username'])) {
    header('Location: /Login');
    exit;
} else {
    $getrate = $LTT->get_list("SELECT * FROM `server_service` WHERE `code_service`='$dtb' AND `status_service`='1' AND `url_config`='" . $url_site_name . "' ");
}

?>
<title><?= $title; ?></title>

<style>
.table th {
    text-transform: none !important;
    font-size: 14px !important;
}

.table> :not(caption)>*>* {
    padding: 5px 10px !important;
}

.badge {
    text-transform: none !important;
    padding: 0.5rem 0.5rem !important;
}

.table td {
    font-size: 14px !important;
}

#swal2-title,
#swal2-html-container {
    font-weight: 600 !important;
}
</style>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php require_once("../../config/nav.php"); ?>
            <div class="content-wrapper">

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Tăng view video Facebook</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4 card-tab">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6 d-grid gap-2">
                                            <a href="<?= $text; ?>" class="btn btn-primary"><img
                                                    src="https://subgiare.vn/assets/images/svg/order.svg" alt=""
                                                    width="25" height="25">
                                                Thêm đơn</a>
                                        </div>
                                        <div class="col-6 d-grid gap-2">
                                            <a href="<?= $text; ?>/list" class="btn btn-outline-primary"><img
                                                    src="https://subgiare.vn/assets/images/svg/list-order.svg" alt=""
                                                    width="25" height="25">
                                                Danh sách đơn</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-8 mb-3">

                                            <form submit-ajax="LTT" action="<?= BASE_URL('api/facebook/buy'); ?>"
                                                method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                                                <input type="hidden" name="action" value="<?= $action; ?>">
                                                <input type="hidden" name="code_dich_vu" value="<?= $dtb; ?>">
                                                <div class="form-group row mb-3">
                                                    <label for="" class="form-label col-md-3">Link video</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" name="id"
                                                            placeholder="Nhập link video" onchange="bill();">

                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for="" class="form-label col-md-3">Máy chủ </label>

                                                    <div class="col-md-9">
                                                        <?php foreach ($getrate as $showrate) { ?>
                                                        <div class="mb-2">
                                                            <div class="mb-1">
                                                                <div class="form-check">
                                                                    <input class="form-check-input"
                                                                        id="<?= $showrate['server_service'] ?>"
                                                                        type="radio"
                                                                        detail="<?= $showrate['server_name'] ?>"
                                                                        name="server" onchange="bill();"
                                                                        value="<?= $showrate['server_service'] ?>">
                                                                    <label class="form-check-label"
                                                                        for="<?= $showrate['server_service'] ?>">SV<?= $showrate['server_service'] ?>
                                                                        &nbsp;(<?= $showrate['title_service'] ?>)&nbsp;<span
                                                                            class="badge bg-success text-white "><?= $showrate['rate_service'] + ($showrate['rate_service'] * $chietkhau / 100) ?>
                                                                            đ / lượt</span>&nbsp;<b
                                                                            class="text-warning">(Hoạt đông)</b></label>
                                                                </div>
                                                            </div>
                                                        </div> <?php } ?>
                                                        <div id="detailServer"></div>
                                                    </div>

                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for="" class="form-label col-md-3">Số lượng </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control mb-3" name="soluong"
                                                            onchange="bill();" value="500"
                                                            placeholder="Nhập số lượng cần tăng">
                                                        <div class="alert text-white bg-info text-center" role="alert">
                                                            <strong>Tổng tiền = (Số lượng) x (Giá 1 lượt)</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for="" class="form-label col-md-3">Thời gian </label>
                                                    <div class="col-md-9">
                                                        <div class="mb-2">
                                                            <div class="mb-1">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" id="time3"
                                                                        type="radio" name="speed" onchange="bill();"
                                                                        value="3">
                                                                    <label class="form-check-label" for="time3">Xem
                                                                        video trong 3
                                                                        giây</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-1">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" id="time10"
                                                                        type="radio" name="speed" onchange="bill();"
                                                                        value="10">
                                                                    <label class="form-check-label" for="time10">Xem
                                                                        video trong 10
                                                                        giây</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-1">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" id="time15"
                                                                        type="radio" name="speed" onchange="bill();"
                                                                        value="15" checked="">
                                                                    <label class="form-check-label" for="time15">Xem
                                                                        video trong 15
                                                                        giây</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row mb-3">
                                                    <label for="" class="form-label col-md-3">Ghi chú </label>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control mb-3" name="ghichu" rows="3"
                                                            placeholder="Nhập ghi chú nếu cần"></textarea>
                                                        <div class="alert bg-danger text-white" role="alert">
                                                            <h4>Vui lòng đọc tránh mất tiền</h4>
                                                            - <b>Mua bằng ID Page đã mở chế độ công khai, có nút
                                                                like</b>.<br>
                                                            - <b>Không hỗ trợ tăng cho pro5, cố tính tăng sẽ không hỗ
                                                                trợ</b>.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <div class="col-sm-12 text-center">
                                                    <div class="alert text-white bg-info " role="alert">
                                                            <h3 class="font-bold text-dark" style="margin-top: 15px;">Tổng thanh toán: <span
                                                                    class="bold green"><span id="total_payment"
                                                                        class="text-danger">0</span> coin</span></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary" id="buy"
                                                        order="Bạn có muốn thanh toán đơn hàng?, chúng tôi sẽ không hoàn tiền với đơn đã thanh toán."><img
                                                            src="/assets1/images/buy.svg" alt="" width="30" height="30">
                                                        Thanh
                                                        toán</button>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="alert bg-danger text-white" role="alert">
                                                <h4 class="text-white">Lưu ý</h4>
                                                - <b>Nghiêm cấm buff các đơn có nội dung vi phạm pháp luật, chính
                                                    trị, đồ trụy... Nếu cố tình buff bạn
                                                    sẽ
                                                    bị trừ hết tiền và ban khỏi hệ thống vĩnh viễn, và phải chịu
                                                    hoàn toàn trách nhiệm trước pháp
                                                    luật</b>.
                                                <br />
                                                - <b>Nếu đơn đang chạy trên hệ thống mà bạn vẫn mua ở các hệ thống
                                                    bên khác, nếu có tình trạng hụt,
                                                    thiếu
                                                    số lượng giữa 2 bên thì sẽ không được xử lí</b>. <br />
                                                - <b>Đơn cài sai thông tin hoặc lỗi trong quá trình tăng hệ thống sẽ
                                                    không hoàn lại tiền</b>. <br />
                                                - <b>Nếu gặp lỗi hãy nhắn tin hỗ trợ phía bên phải góc màn hình hoặc
                                                    vào mục liên hệ hỗ trợ để được hỗ
                                                    trợ
                                                    tốt nhất</b>.
                                            </div>
                                            <?php
                                            if ($LTT->modal("view_video", 'status') == "ON") { ?>
                                            <div class="modal fade" id="modalSystem" tabindex="-1" role="dialog"
                                                aria-labelledby="modalSystemLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="pt-3 text-center">
                                                                <h3>Thông báo Nạp Tiền</h3>
                                                            </div>
                                                            <br>
                                                            <p class="text-center">
                                                                <?= $LTT->modal("view_video", 'text_thong_bao'); ?></p>
                                                            <br>
                                                            <div class="d-grid gap-2">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Đóng
                                                                    thông báo</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php require_once("../../config/scr.php");?>
                <?php require_once("../../config/end.php");?>
</body>

</html>