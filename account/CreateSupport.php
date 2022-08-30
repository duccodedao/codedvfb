<?php require('../config/function.php'); ?>

<?php require('../config/head.php');
if (empty($_SESSION['username'])) {
    header('Location: /auth/login');
    exit;
} ?>
<title>Tạo Hỗ Trợ</title>
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
<?php require('../config/nav.php'); ?>

<div class="layout-wrapper">
    <div class="header">
        <div class="menu-toggle-btn">
            <a href="#">
                <i class="bi bi-list"></i>
            </a>
        </div>
        <a href="/home" class="logo">
            <img width="130" src="<?= $LTT->site('logo'); ?>" alt="logo">
        </a>
        <div class="page-title">Gửi hỗ trợ</div>
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
            <br>
            <div class="col-md-12">
                <div class="card mb-4">

                    <div class="card-body">
                        <form submit-ajax="NTD" action="<?= BASE_URL('api/ho-tro'); ?>" method="post" api_token="<?= $LTT->getUsers('token'); ?>">

                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">Vấn đề cần hỗ trợ</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="loai_ho_tro">
                                        <option value="">-- Chọn vẫn đề cần hỗ trợ --</option>

                                        <option value="like_post" style="color:#3aa6f2;    font-weight: 600;"><b>Like Bài Viết (Facebook)</b></option>
                                        <option value="cx-post" style="color:#3aa6f2;    font-weight: 600;"><b>Cảm Xúc Bài Viết (Facebook)</b></option>
                                        <option value="sub_sale" style="color:#3aa6f2;    font-weight: 600;">Follow (Facebook)</option>

                                        <option value="cmt" style="color:#3aa6f2;    font-weight: 600;"><b>Comment (Facebook)</b></option>
                                        <option value="like_page_sale" style="color:#3aa6f2;    font-weight: 600;">Like Page (Facebook)</option>
                                        <option value="mem_gr" style="color:#3aa6f2;    font-weight: 600;">Thành Viên Nhóm (Facebook)</option>
                                        <option value="share" style="color:#3aa6f2;    font-weight: 600;">Share (Facebook)</option>
                                        <option value="mat_live" style="color:#3aa6f2;    font-weight: 600;">Mắt Like (Facebook)</option>
                                        <option value="view_video" style="color:#3aa6f2;    font-weight: 600;">View Video (Facebook)</option>
                                        <option value="like_cmt" style="color:#3aa6f2;    font-weight: 600;">Like Comment (Facebook)</option>
                                        <option value="view_story" style="color:#3aa6f2;    font-weight: 600;">View Story (Facebook)</option>
                                        <option value="like_ins" style="color:#fc883a;    font-weight: 600;">Like (Instagram)</option>
                                        <option value="cmt_ins" style="color:#fc883a;    font-weight: 600;">Comment (Instagram)</option>
                                        <option value="sub_ins" style="color:#fc883a;    font-weight: 600;">Follow (Instagram)</option>
                                        <option value="like_tiktok" style="color:#ff3838;    font-weight: 600;">Tim (TikTok)</option>
                                        <option value="cmt_tiktok" style="color:#ff3838;    font-weight: 600;">Comment (TikTok)</option>
                                        <option value="sub_tiktok" style="color:#ff3838;    font-weight: 600;">Follow (TikTok)</option>
                                        <option value="like_youtube" style="color:#fcd41e;    font-weight: 600;">Like (Youtube)</option>
                                        <option value="sub_youtube" style="color:#fcd41e;    font-weight: 600;">Sub (Youtube)</option>
                                        <option value="sub_youtube" style="color:#2a5bfa;    font-weight: 600;">Nạp Tiền</option>
                                        <option value="sub_youtube" style="color:#2a5bfa;    font-weight: 600;">Khác</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">Tiêu đề hỗ trợ </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="tieu_de_ho_tro" placeholder="Tiêu đề hỗ trợ">

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">ID đơn</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="id_ho_tro" placeholder="ID đơn nếu có">

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="form-label col-md-3">Mô tả chi tiết</label>
                                <div class="col-md-8">
                                    <textarea class="form-control " name="noi_dung_ho_tro" rows="5" placeholder="Mô tả vấn đề gặp phải"></textarea>

                                </div>
                            </div>


                            <br>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary"> Gửi Hỗ Trợ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-4">Lịch sử hỗ trợ</h6>
                            <form action="/Tao-Ho-Tro">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nhập id, type, transaction_code, content tìm kiếm ..." name="search" value="">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Tìm kiếm</button>
                                </div>
                            </form>
                            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr role="row" class="bg-primary">
                                            <th class="text-center text-white">ID</th>
                                            <th class="text-center text-white">Thời gian</th>
                                            <th class="text-center text-white">Loại Hỗ Trợ</th>
                                            <th class="text-center text-white">Tiêu Đề Hỗ Trợ</th>
                                            <th class="text-center text-white">ID Đơn Hỗ Trợ</th>
                                            <th class="text-center text-white">Nội Dung</th>
                                            <th class="text-center text-white">Nội Dung Xử Lý</th>
                                            <th class="text-center text-white">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $getlistbuff = $LTT->get_list("SELECT * FROM `list_hotro` WHERE  `username` = '$my_user'  AND  `url_config` = '" . $url_site_name . "'
 ORDER BY `id` DESC ");
                                        if ($getlistbuff) {
                                            foreach ($getlistbuff as $rowhbuff) { ?>
                                                <tr class="odd">
                                                    <td><?= $rowhbuff['id'] ?></td>
                                                    <td><?= $rowhbuff['date'] ?></td>
                                                    <td><?= $rowhbuff['loai_hotro'] ?></td>
                                                    <td><?= $rowhbuff['tieu_de_hotro'] ?></td>

                                                    <td><?= $rowhbuff['id_hotro'] ?>
                                                    </td>

                                                    <td><?= $rowhbuff['noi_dung_hotro'] ?>
                                                    </td>
                                                    <td><b><?= $rowhbuff['noi_dung_xuly'] ?></b></td>
                                                    <td<?php if ($rowhbuff['status'] == "wait") { ?> <b><button type="button" class="btn btn-warning btn-sm">Đang chờ</button></b>
                                                    <?php } else { ?>
                                                        <b><button type="button" class="btn btn-success btn-sm">Đã Xử Lý</button></b>

                                                    <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr class="odd">
                                                <td valign="top" colspan="100%">
                                                    <center>
                                                        <img src="/assets/images/nodata.svg" alt="" width="80" height="80" class="pt-3">
                                                        <p class="pt-3">Không có dữ liệu để hiển thị</p>
                                                    </center>
                                                </td>
                                            </tr><?php } ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?php require('../config/end.php'); ?>