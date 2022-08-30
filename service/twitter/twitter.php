<?php require('../../config/function.php');
$text = getCurURL();
$dichvu1 = (explode('/', $text));
$dich_vu = $dichvu1['5'];
if ($dich_vu == "sub") {
    $dtb = "sub_twitter";
    $action = $dichvu1['5'];
    $title = "Tăng Follow Twitter";
} elseif ($dich_vu == "like") {
    $dtb = "like_twitter";
    $action = $dichvu1['5'];
    $title = "Like Twitter";
}

?><?php require('../../config/head.php');
    if (empty($_SESSION['username'])) {
        header('Location: /Login');
        exit;
    } else {
        $getrate = $LTT->get_list("SELECT * FROM `server_service` WHERE `code_service`='$dtb' AND `status_service`='1' AND `url_config`='" . $url_site_name . "' ");
    }

    ?>
<title><?= $title; ?></title>
<script type="b9e3e84309a92aaf852234bf-text/javascript">
    const profile = {
        "id": "<?= $LTT->getUsers('id'); ?>",
        "fullname": "<?= $LTT->getUsers('name'); ?>",
        "email": "<?= $LTT->getUsers('email'); ?>",
        "username": "<?= $LTT->getUsers('username'); ?>",
        "đ": "<?= $LTT->getUsers('money'); ?>",
        "level": "<?php if ($LTT->getUsers('level') == NULL) {
                        echo 'member';
                    } else {
                        echo $LTT->getUsers('level');
                    } ?>",
        "blocked": "<?php if ($LTT->getUsers('banned') == 0) {
                        echo 'false';
                    } else {
                        echo 'true';
                    } ?>",
        "detail_blocked": "<?php if ($LTT->getUsers('banned') == 0) {
                                echo 'Active';
                            } else {
                                echo 'Block';
                            } ?>",
        "api_token": "<?= $LTT->getUsers('token'); ?>",
        "created_at": "<?= $LTT->getUsers('date'); ?>",
        "updated_at": "<?= $LTT->getUsers('lastdate'); ?>",
        "website": [],
        "avatar": "<?= $LTT->site('logo_user'); ?><?= $LTT->getUsers('username'); ?>",
        "isAdmin": "<?php if ($LTT->getUsers('capbac') == 3) {
                        echo 'true';
                    } else {
                        echo 'false';
                    } ?>",
        "position": "<?= levelmem($LTT->getUsers('capbac')); ?>",
        "levelMember": "<?= levelmem($LTT->getUsers('capbac')); ?>",
        "codeRecharge": "<?= $LTT->getUsers('cuphap'); ?>",
        "loaded": "<?= $LTT->getUsers('tongnap'); ?>",
        "pepper": "<?= $LTT->getUsers('tongtru'); ?>",
        "statusAccount": "<?php if ($LTT->getUsers('banned') == 0) {
                                echo 'Active';
                            } else {
                                echo 'Block';
                            } ?>"
    };
    const setting = {
        "title": "Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | <?= $LTT->site('ten_website'); ?>",
        "domain": "<?= $LTT->site('ten_website'); ?>",
        "keyword": "like, sub, share, vip like, buff m\u1eaft, t\u0103ng follow, mua like, mua sub, sub r\u1ebb, hack like, hack sub, hack follow, t\u0103ng like, t\u0103ng follow, t\u0103ng share, t\u0103ng comment, ch\u00e9o like, ch\u00e9o sub, shop sub",
        "fullname_admin": "<?= $LTT->site('full_name_admin'); ?>",
        "fb_admin": "<?= $LTT->site('facebook'); ?>",
        "zalo_admin": "https:\/\/zalo.me\/<?= $LTT->site('phone_zalo'); ?>",
        "modal_system": "H\u1ec7 th\u1ed1ng ho\u00e0n to\u00e0n t\u1ef1 \u0111\u1ed9ng h\u00f3a 100%, t\u1ef1 \u0111\u1ed9ng n\u1ea1p ti\u1ec1n (n\u1ea1p \u00edt nh\u1ea5t 10k, n\u1ea1p sai n\u1ed9i dung tr\u1eeb 10% ph\u00ed). Ch\u00fac b\u1ea1n s\u1eed d\u1ee5ng d\u1ecbch v\u1ee5 vui v\u1ebb nh\u00e9."
    };
</script>
<?php require('../../config/nav.php'); ?>

<div class="layout-wrapper">
    <div class="header">
        <div class="menu-toggle-btn">
            <a href="#">
                <i class="bi bi-list"></i>
            </a>
        </div>
        <a href="/" class="logo">
            <img width="130" src="<?= $LTT->site('logo'); ?>" alt="logo">
        </a>
        <div class="page-title"><?= $title; ?></div>
        <form class="search-form">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm...">
                <a href="#" class="btn btn-outline-light close-header-search-bar">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </form>
        <div class="header-bar ms-auto">
            <ul class="navbar-nav justify-content-end gap-3">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-notify" data-count="2" data-sidebar-target="#notifications">
                        <i class="bi bi-bell icon-lg"></i>
                    </a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="dropdown" class="btn btn-white py-1 px-2 dropdown-toggle custom-shadow">
                        <span class="avatar avatar-sm me-2">
                            <img src="https://ui-avatars.com/api/?background=random&amp;name=<?= $LTT->getUsers('name'); ?>" class="rounded-circle" alt="avatar">
                        </span>
                        <span class="d-none d-md-inline"><?= $LTT->getUsers('name'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/Profile">Tài khoản của tôi</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/Logout">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="header-mobile-buttons">
            <a href="#" class="search-bar-btn">
                <i class="bi bi-search"></i>
            </a>
            <a href="#" class="actions-btn">
                <i class="bi bi-three-dots"></i>
            </a>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid gap-2">
                                <a href="<?= $text; ?>" class="btn btn-primary"><img src="/assets/images/order.svg" alt="" width="25" height="25">
                                    Thêm đơn</a>
                            </div>
                            <div class="col-6 d-grid gap-2">
                                <a href="<?= $text; ?>/list" class="btn btn-outline-primary"><img src="/assets/images/list-order.svg" alt="" width="25" height="25">
                                    Danh sách đơn</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form submit-ajax="NTD" action="<?= BASE_URL('api/twitter/buy'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">
                            <input type="hidden" name="action" value="<?= $action; ?>">
                            <input type="hidden" name="code_dich_vu" value="<?= $dtb; ?>">
                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">Link video </label>
                                <div class="col-md-9">
                                    <input type="url" class="form-control" name="id" placeholder="Nhập link video cần tăng" onchange="bill();">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">Máy chủ </label>

                                <div class="col-md-9">
                                    <?php foreach ($getrate as $showrate) { ?>
                                        <div class="mb-2">
                                            <div class="mb-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" id="<?= $showrate['server_service'] ?>" type="radio" detail="<?= $showrate['server_name'] ?>" name="server" onchange="bill();" value="<?= $showrate['server_service'] ?>">
                                                    <label class="form-check-label" for="<?= $showrate['server_service'] ?>">SV<?= $showrate['server_service'] ?>
                                                        &nbsp;(<?= $showrate['title_service'] ?>)&nbsp;<span class="badge bg-success text-white "><?= $showrate['rate_service'] + ($showrate['rate_service'] * $chietkhau / 100) ?> đ / lượt</span>&nbsp;<b class="text-warning">(Hoạt đông)</b></label>
                                                </div>
                                            </div>
                                        </div> <?php } ?>
                                    <div id="detailServer"></div>
                                </div>

                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">Số lượng </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control mb-3" name="soluong" onchange="bill();" value="100" placeholder="Nhập số lượng cần tăng">
                                    <div class="alert text-white bg-info text-center" role="alert">
                                        <strong>Tổng tiền = (Số lượng) x (Giá 1 lượt)</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">Ghi chú </label>
                                <div class="col-md-9">
                                    <div class="alert bg-danger text-white" role="alert">
                                        <h4>Vui lòng đọc tránh mất tiền</h4>
                                        - <b>Mua bằng link bài viết công khai có có dạng
                                            https://twitter.com/hvl2k3/status/1495261314767519746</b>.<br>
                                        - <b>Mua bằng Username ở chế động khai có dạng https://twitter.com/username, VD:
                                            https://twitter.com/hvl2k3 thì username là hvl2k3</b>.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-sm-12 text-center">
                                    <div class="alert text-white bg-success " role="alert">
                                        <h3 class="font-bold">Tổng thanh toán: <span class="bold green"><span id="total_payment" class="text-danger">0</span> coin</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" id="buy" order="Bạn có muốn thanh toán đơn hàng?, chúng tôi sẽ không hoàn tiền với đơn đã thanh toán."><img src="/assets/images/buy.svg" alt="" width="30" height="30"> Thanh
                                    toán</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="alert bg-danger text-white" role="alert">
                    <h4>Lưu ý</h4>
                    - <b>Nghiêm cấm buff các đơn có nội dung vi phạm pháp luật, chính trị, đồ trụy... Nếu cố tình buff bạn
                        sẽ
                        bị trừ hết tiền và ban khỏi hệ thống vĩnh viễn, và phải chịu hoàn toàn trách nhiệm trước pháp
                        luật</b>.
                    <br />
                    - <b>Nếu đơn đang chạy trên hệ thống mà bạn vẫn mua ở các hệ thống bên khác, nếu có tình trạng hụt,
                        thiếu
                        số lượng giữa 2 bên thì sẽ không được xử lí</b>. <br />
                    - <b>Đơn cài sai thông tin hoặc lỗi trong quá trình tăng hệ thống sẽ không hoàn lại tiền</b>. <br />
                    - <b>Nếu gặp lỗi hãy nhắn tin hỗ trợ phía bên phải góc màn hình hoặc vào mục liên hệ hỗ trợ để được hỗ
                        trợ
                        tốt nhất</b>.
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    function detailServer(text) {
        $('#detailServer').show().html(`<div class="alert bg-danger text-white" role="alert">
                <h4>Thông tin máy chủ</h4>
                - <b>${text}</b></div>`);
    }
</script>

<script src="https://code.jquery.com/jquery.min.js"></script>
<script>
    swal('Vui lòng đọc kĩ các chú ý dịch vụ trước khi lên đơn!');
    let prices = JSON.parse(setting.ytb_like);

    function bill() {
        let server = $('input[name=server]:checked');
        let detail = server.attr('detail');
        server = server.val();
        if (!server) return;
        detailServer(detail);
        let soluong = $('[name=soluong]').val();
        <?php foreach ($getrate as $runrate) { ?>
            if (server == '<?= $runrate['server_service'] ?>') {
                var price = <?= $runrate['rate_service'] ?>;
                var price2 = <?= $runrate['rate_service'] + ($runrate['rate_service'] * $chietkhau / 100) ?>;
            }
        <?php } ?>
        let total_payment = Math.round(soluong * price2);
        $('#total_payment').html(Intl.NumberFormat().format(total_payment));
    }
    $(document).ready(function() {
        bill();
    });
</script>
</body>


<script src="https://code.jquery.com/jquery.min.js"></script>

<?php
if ($LTT->modal($dtb, 'status') == "ON") { ?>
    <div class="modal fade" id="modalSystem" tabindex="-1" role="dialog" aria-labelledby="modalSystemLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSystemLabel">Thông báo hệ thống</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p><?= $LTT->modal($dtb, 'text_thong_bao'); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<script>
    $(window).on('load', function() {
        $('#staticBackdrop').modal('show');
    });
</script>
<?php require('../../config/end.php'); ?>