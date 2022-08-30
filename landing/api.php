<?php require('../config/function.php'); ?>

<?php require('../config/head.php');
if (empty($_SESSION['username'])) {
    header('Location: /auth/login');
    exit;
} ?>
<title>API Dịch Vụ</title>
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
        <div class="page-title">API Dịch Vụ</div>
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
            <div class="card sticky-top  mb-md-0">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column gap-2" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                                <i class="bi bi-person me-2"></i> Thêm API
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="security-tab" data-bs-toggle="tab" href="#security" role="tab" aria-controls="password" aria-selected="false">
                                <i class="bi bi-lock me-2"></i> Mẫu Post
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12"><br><br>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-body">
                                <form submit-ajax="NTD" method="post" action="<?= BASE_URL('api/them-api'); ?>" api_token="<?= $LTT->getUsers('token'); ?>">
                                    <input type="hidden" name="action" value="them_api">
                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label class="form-label" for="">Tên Gợi Nhớ</label>
                                            <input type="text" class="form-control" name="ten_api" placeholder="Nhập tên cho API">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label class="form-label" for="">Link CallBack</label>
                                            <input class="form-control" name="link_callback" type="text" placeholder="Nhập link callback nếu có">
                                        </div>
                                        <div class="form-group col-md-12 mb-3">
                                            <label class="form-label" for="">Api Token</label>
                                            <input type="text" class="form-control" name="token_api" placeholder="Nhập token">
                                        </div>
                                        <div class="form-group col-md-12">

                                            <center><button type="submit" class="btn btn-primary">Thêm Kết Nối</button></center>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                    <div class="card mb-4">
                        <div class="card-body">

                            <h6 class="card-subtitle">URL: <code class="highlighter-rouge"><?= $LTT->site('base_url'); ?>api/{loai-dich-vu}/now</code></h6>




                            <hr>

                            <div class="row">
                                <div class="col-md-6">

                                    <label>Body :</label>

                                    <div class="row">
                                        <div class="col-4" style="font-weight: bold;">

                                            loai-dich-vu
                                        </div>
                                        <div class="col-8">
                                            facebook<br>
                                        </div>
                                        <div class="col-4" style="font-weight: bold;">
                                            <br> api_token <br>
                                        </div>
                                        <div class="col-8">
                                            <br> Api Token Của Bạn
                                        </div>
                                        <div class="col-4" style="font-weight: bold;">
                                            <br>
                                            action
                                        </div>
                                        <div class="col-8">
                                            <br>
                                            like-post
                                        </div>


                                        <div class="col-4" style="font-weight: bold;">
                                            <br>
                                            id
                                        </div>
                                        <div class="col-8">
                                            <br>
                                            ID Bài Viết Hoặc Tài Khoản Facebook
                                        </div>


                                        <div class="col-4" style="font-weight: bold;">
                                            <br>
                                            soluong
                                        </div>
                                        <div class="col-8">
                                            <br>
                                            Số lượng cần mua
                                        </div>

                                        <div class="col-4" style="font-weight: bold;">
                                            <br>
                                            server
                                        </div>
                                        <div class="col-8">
                                            <br>
                                            Server cần tạo đơn
                                        </div>

                                        <div class="col-4" style="font-weight: bold;">
                                            <br>
                                            Các thông số khác
                                        </div>
                                        <div class="col-8">
                                            <br>
                                            F12 để xem thêm
                                        </div>

                                    </div>

                                </div>
                                <br>
                                <div class="col-md-6"><br>
                                    <label>Result:</label>
                                    <div class="resultapi" style="background: #23241f;">

                                        <br>
                                        <span style="color:#ffffff;margin-left:30px; ">{</span><br><br>
                                        <span style="margin-left:50px; color:#ffffff;">"status"</span><span style="color:#ffffff;">:</span> <span class="text-warning">"false/true"</span><span style="color:#ffffff;">,</span><br>
                                        <span style="margin-left:50px;  color:#ffffff; ">"error"</span><span style="color:#ffffff;">:</span> <span class="text-warning">"false/true"</span><span style="color:#ffffff;">,</span><br>
                                        <span style="margin-left:50px;  color:#ffffff;">"message"</span><span style="color:#ffffff;">:</span> <span class="text-warning">"Thông báo Trả Về"</span><span style="color:#ffffff;"></span><br><br>
                                        <span style="color:#ffffff;margin-left:270px; ">}</span>
                                    </div>


                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-4">Nhật kí tạo</h6>
                        <form action="/Api-DichVu">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nhập id, content tìm kiếm ..." name="search" value="">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr role="row" class="bg-primary">
                                        <th class="text-center text-white">ID</th>
                                        <th class="text-center text-white">Thời gian</th>
                                        <th class="text-white">Tên API</th>
                                        <th class="text-white">Token</th>
                                        <th class="text-white">Link Callback</th>
                                        <th class="text-white">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $getlistapi = $LTT->get_list("SELECT * FROM `list_api` WHERE  `username` = '$my_user' AND  `url_config` = '" . $url_site_name . "'  ORDER BY `id` DESC ");
                                    if ($getlistapi) {
                                        foreach ($getlistapi as $row_API) { ?>
                                            <tr class="odd">
                                                <td><?= $row_API['id'] ?></td>
                                                <td><?= $row_API['date'] ?></td>
                                                <td><?= $row_API['name_api'] ?></td>
                                                <td><?= $row_API['token'] ?></td>
                                                <td><?= $row_API['link_callback'] ?></td>

                                                <td<?php if ($row_API['status'] == "wait") { ?> <b><button type="button" class="btn btn-warning btn-sm">Đang Chờ</button></b>
                                                <?php } elseif ($row_API['status'] == "active") { ?>
                                                    <b><button type="button" class="btn btn-success btn-sm">Đã Duyệt</button></b>

                                                <?php } elseif ($row_API['status'] == "block") { ?>
                                                    <b><button type="button" class="btn btn-danger btn-sm">Đã Khoá</button></b>
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
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <?php require('../config/end.php'); ?>