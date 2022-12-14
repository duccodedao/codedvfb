<!DOCTYPE html>
<?php require_once("../../config/function.php");?>
<html lang="en" class="dark-style layout-navbar-fixed layout-menu-100vh layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="/sneat/assets/" data-template="vertical-menu-template-starter">

<?php
require_once("../../config/head.php");
$dtb = "vip_like";
$action = "vip-like";
$title = "Vip like profile"; ?><?php 
if (empty($_SESSION['username'])) {
    header('Location: /Login');
    exit;
} else {
    $getrate = $LTT->get_list("SELECT * FROM `server_service` WHERE `code_service`='$dtb' AND `status_service`='1' AND `url_config`='" . $url_site_name . "' ");
} ?>

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
                    <h4 class="fw-bold py-3 mb-4">Vip like profile Facebook</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4 card-tab">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6 d-grid gap-2">
                                            <a href="/dich-vu/facebook/vip-like"
                                                class="btn btn-primary"><img src="https://subgiare.vn/assets/images/svg/order.svg" alt=""
                                                    width="25" height="25">
                                                Th??m ????n</a>
                                        </div>
                                        <div class="col-6 d-grid gap-2">
                                            <a href="/dich-vu/facebook/vip-like/list"
                                                class="btn btn-outline-primary"><img
                                                    src="https://subgiare.vn/assets/images/svg/list-order.svg" alt="" width="25"
                                                    height="25">
                                                Danh s??ch ????n</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8 mb-3">

                                        <form submit-ajax="NTD" action="<?= BASE_URL('api/facebook/buy'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                            <input type="hidden" name="action" value="<?= $action; ?>">
                            <input type="hidden" name="code_dich_vu" value="<?= $dtb; ?>">
                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">ID Facebook </label>
                                <div class="col-md-9">
                                    <input class="form-control" name="id" placeholder="Nh???p id ho???c nh???p link page h??? th???ng t??? get id" onchange="getUID('id');" onchange="bill();">

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">M??y ch??? </label>

                                <div class="col-md-9">
                                    <?php foreach ($getrate as $showrate) { ?>
                                        <div class="mb-2">
                                            <div class="mb-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" id="<?= $showrate['server_service'] ?>" type="radio" detail="<?= $showrate['server_name'] ?>" name="server" onchange="bill();" value="<?= $showrate['server_service'] ?>">
                                                    <label class="form-check-label" for="<?= $showrate['server_service'] ?>">SV<?= $showrate['server_service'] ?>
                                                        &nbsp;(<?= $showrate['title_service'] ?>)&nbsp;<span class="badge bg-success text-white "><?= $showrate['rate_service'] + ($showrate['rate_service'] * $chietkhau / 100) ?> ?? / l?????t</span>&nbsp;<b class="text-warning">(Ho???t ????ng)</b></label>
                                                </div>
                                            </div>
                                        </div> <?php } ?>
                                    <div id="detailServer"></div>
                                </div>

                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">S??? ng??y </label>
                                <div class="col-md-9">
                                    <div class="form-control-wrap">
                                        <select class="form-select" data-search="on" name="so_ngay" onchange="bill();">
                                            <option value="30">30 ng??y</option>
                                            <option value="60">60 ng??y</option>
                                            <option value="90">90 ng??y</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">S??? l?????ng </label>
                                <div class="col-md-9">
                                    <div class="form-control-wrap mb-3">
                                        <select class="form-select" data-search="on" name="soluong" onchange="bill();">
                                            <option value="100">100 like</option>
                                            <option value="150">150 like</option>
                                            <option value="200">200 like</option>
                                            <option value="300">300 like</option>
                                            <option value="500">500 like</option>
                                            <option value="600">600 like</option>
                                            <option value="700">700 like</option>
                                            <option value="800">800 like</option>
                                            <option value="900">900 like</option>
                                            <option value="1000">1000 like</option>
                                            <option value="1500">1500 like</option>
                                            <option value="2000">2000 like</option>
                                        </select>
                                    </div>
                                    <div class="alert text-white bg-info text-center" role="alert">
                                        <strong>T???ng ti???n = (S??? l?????ng) x (Gi?? 1 like) x (S??? ng??y)</strong>
                                    </div>
                                </div>
                            </div>




                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">Ghi ch?? </label>
                                <div class="col-md-9">
                                    <textarea class="form-control mb-3" name="ghichu" rows="3" placeholder="Nh???p ghi ch?? n???u c???n"></textarea>
                                    <div class="alert bg-danger text-white" role="alert">
                                        <h4>Vui l??ng ?????c tr??nh m???t ti???n</h4>
                                        - <b>Mua b???ng ID Facebook ???? c??c b??i vi???t c??ng khai</b>. <br>
                                        - <b>Vip like profile ch??? h??? tr??? cho trang c?? nh??n v?? page</b>. <br>
                                        - <b>G????n nh?? 99% se?? kh??ng t??ng like cho post a??nh ??a??i di????n ho????c a??nh bi??a</b>.
                                        <br>
                                        - <b>Ch?? ?? viplike ch???y theo c?? ch??? v?? d??? b???n mua g??i 100 like khi stt ???? h??n 100 like
                                            l?? h??? th???ng d???ng kh??ng ch???y th??m n???a</b>. <br>
                                        - <b>Like ho???t ?????ng t??? 7h - 23h.</b>.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-sm-12 text-center">
                                    <div class="alert text-white bg-info " role="alert">
                                    <h3 class="font-bold text-dark" style="margin-top: 15px;">T???ng thanh to??n: <span class="bold green"><span id="total_payment" class="text-danger">0</span> coin</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" id="buy" order="B???n c?? mu???n thanh to??n ????n h??ng?, ch??ng t??i s??? kh??ng ho??n ti???n v???i ????n ???? thanh to??n."><img src="/assets1/images/buy.svg" alt="" width="30" height="30"> Thanh
                                    to??n</button>
                            </div>
                        </form>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="alert bg-danger text-white" role="alert">
                                                <h4 class="text-white">L??u ??</h4>
                                                - <b>Nghi??m c???m buff c??c ????n c?? n???i dung vi ph???m ph??p lu???t, ch??nh tr???,
                                                    ????? tr???y... N???u c??? t??nh buff b???n
                                                    s???
                                                    b??? tr??? h???t ti???n v?? ban kh???i h??? th???ng v??nh vi???n, v?? ph???i ch???u ho??n
                                                    to??n tr??ch nhi???m tr?????c ph??p
                                                    lu???t</b>.
                                                <br />
                                                - <b>N???u ????n ??ang ch???y tr??n h??? th???ng m?? b???n v???n mua ??? c??c h??? th???ng b??n
                                                    kh??c, n???u c?? t??nh tr???ng h???t,
                                                    thi???u
                                                    s??? l?????ng gi???a 2 b??n th?? s??? kh??ng ???????c x??? l??</b>. <br />
                                                - <b>????n c??i sai th??ng tin ho???c l???i trong qu?? tr??nh t??ng h??? th???ng s???
                                                    kh??ng ho??n l???i ti???n</b>. <br />
                                                - <b>N???u g???p l???i h??y nh???n tin h??? tr??? ph??a b??n ph???i g??c m??n h??nh ho???c v??o
                                                    m???c li??n h??? h??? tr??? ????? ???????c h???
                                                    tr???
                                                    t???t nh???t</b>.
                                            </div>
                                            <?php
                                            if ($LTT->modal("vip_like", 'status') == "ON") { ?>
                                            <div class="modal fade" id="modalSystem" tabindex="-1" role="dialog"
                                                aria-labelledby="modalSystemLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="pt-3 text-center">
                                                                <h3>Th??ng b??o N???p Ti???n</h3>
                                                            </div>
                                                            <br>
                                                            <p class="text-center">
                                                                <?= $LTT->modal("vip_like", 'text_thong_bao'); ?></p>
                                                            <br>
                                                            <div class="d-grid gap-2">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">????ng
                                                                    th??ng b??o</button>
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