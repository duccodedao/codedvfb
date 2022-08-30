<!DOCTYPE html>
<?php require_once("../config/function.php");?>
<html lang="en" class="dark-style layout-navbar-fixed layout-menu-100vh layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="/sneat/assets/" data-template="vertical-menu-template-starter">

<?php
require_once("../config/head.php");?>
<?php
if (empty($_SESSION['username'])){
    header("Location: /Login");
} ?>
<title>Nâng cấp bậc</title>

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
            <?php require_once("../config/nav.php");?>
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Nâng cấp bậc</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border shadow-none">
                                <div class="card-body">
                                    <h3 class="fw-bold text-center text-uppercase mt-3">Cộng tác viên</h3>
                                    <div class="my-4 py-2 text-center">
                                        <img src="https://subgiare.vn/sneat/assets/img/icons/unicons/bookmark.png" alt="Starter Image"
                                            height="80">
                                    </div>

                                    <div class="text-center mb-4">
                                        <div class="mb-2 d-flex justify-content-center">
                                            <h1 class="fw-bold h1 mb-0"><?= number_format($LTT->site('rate_ctv')) ?></h1>
                                            <sub class="h5 pricing-duration mt-auto mb-2">coin</sub>
                                        </div>
                                    </div>

                                    <ul class="ps-3 pt-4 pb-2 list-unstyled">
                                        <li class="mb-2">
                                            <span
                                                class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i
                                                    class="bx bx-check bx-xs"></i></span>
                                            Cấp bậc này sẽ được giảm giá các dịch vụ và có thể tạo website
                                            riêng.
                                        </li>
                                        <li class="mb-2">
                                            <span
                                                class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i
                                                    class="bx bx-check bx-xs"></i></span>
                                            Có ưu đãi dịch vụ.
                                        </li>
                                    </ul>

                                    <a href="/Bank"
                                        class="btn btn-label-primary d-grid w-100">Nạp ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border shadow-none">
                                <div class="card-body">
                                    <h3 class="fw-bold text-center text-uppercase mt-3">Đại lý</h3>
                                    <div class="my-4 py-2 text-center">
                                        <img src="https://subgiare.vn/sneat/assets/img/icons/unicons/briefcase-round.png"
                                            alt="Starter Image" height="80">
                                    </div>

                                    <div class="text-center mb-4">
                                        <div class="mb-2 d-flex justify-content-center">
                                            <h1 class="fw-bold h1 mb-0"><?= number_format($LTT->site('rate_daily')) ?></h1>
                                            <sub class="h5 pricing-duration mt-auto mb-2">coin</sub>
                                        </div>
                                    </div>

                                    <ul class="ps-3 pt-4 pb-2 list-unstyled">
                                        <li class="mb-2">
                                            <span
                                                class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i
                                                    class="bx bx-check bx-xs"></i></span>
                                            Cấp bậc này sẽ được giảm giá dịch vụ, tạo
                                            website riêng, hỗ trợ riêng, ...
                                        </li>
                                        <li class="mb-2">
                                            <span
                                                class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i
                                                    class="bx bx-check bx-xs"></i></span>
                                            Có ưu đãi dịch vụ.
                                        </li>
                                    </ul>

                                    <a href="/Bank"
                                        class="btn btn-label-primary d-grid w-100">Nạp ngay</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border shadow-none">
                                <div class="card-body">
                                    <h3 class="fw-bold text-center text-uppercase mt-3">Nhà phân phối</h3>
                                    <div class="my-4 py-2 text-center">
                                        <img src="https://subgiare.vn/sneat/assets/img/icons/unicons/wallet-round.png" alt="Starter Image"
                                            height="80">
                                    </div>

                                    <div class="text-center mb-4">
                                        <div class="mb-2 d-flex justify-content-center">
                                            <h1 class="fw-bold h1 mb-0"><?= number_format($LTT->site('rate_admin')) ?></h1>
                                            <sub class="h5 pricing-duration mt-auto mb-2">coin</sub>
                                        </div>
                                    </div>

                                    <ul class="ps-3 pt-4 pb-2 list-unstyled">
                                        <li class="mb-2">
                                            <span
                                                class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i
                                                    class="bx bx-check bx-xs"></i></span>
                                            Cấp bậc này sẽ được giảm giá dịch vụ riêng, tạo
                                            website riêng, hỗ trợ riêng, ...
                                        </li>
                                        <li class="mb-2">
                                            <span
                                                class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i
                                                    class="bx bx-check bx-xs"></i></span>
                                            Có ưu đãi dịch vụ.
                                        </li>
                                    </ul>

                                    <a href="/Bank"
                                        class="btn btn-label-primary d-grid w-100">Nạp ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once("../config/scr.php");?>
                <?php require_once("../config/end.php");?>


</body>

</html>