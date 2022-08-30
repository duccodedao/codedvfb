<?php require_once("../../config/function.php");?>
<html lang="en" class="dark-style layout-navbar-fixed layout-menu-100vh layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="/sneat/assets/" data-template="vertical-menu-template-starter">

<?php
require_once("../../config/head.php");
$text = getCurURL();
$dichvu1 = (explode('/', $text));
$dich_vu = $dichvu1['5'];
if ($dich_vu == "like-post") {
    $dtb = "like_post";
    $action = $dichvu1['5'];
    $title = "Like Bài Viết";
    $link_get = "api/service/facebook/like-post-speed/list";
} elseif ($dich_vu == "cx-post") {
    $dtb = "cx_post";
    $action = $dichvu1['5'];
    $title = "Cảm Xúc Bài Viết";
} elseif ($dich_vu == "sub-sale") {
    $dtb = "sub_sale";
    $action = $dichvu1['5'];
    $title = "Follow";
    $link_get = "api/service/facebook/sub-sale/list";
} elseif ($dich_vu == "vip-like") {
    $dtb = "vip_like";
    $action = "vip-like";
    $title = "Vip like profile";
    $link_get = "api/service/facebook/vip-like-profile/list";
} elseif ($dich_vu == "sub-speed") {
    $dtb = "sub_speed";
    $action = $dichvu1['5'];
    $title = "Follow Nhanh";
    $link_get = "api/service/facebook/sub-speed/list";
} elseif ($dich_vu == "sub-vip") {
    $dtb = "sub_vip";
    $action = $dichvu1['5'];
    $title = "Follow Vip";
    $link_get = "api/service/facebook/sub-vip/list";
} elseif ($dich_vu == "sub-quality") {
    $dtb = "sub_quality";
    $action = $dichvu1['5'];
    $title = "Follow Quality";
    $link_get = "api/service/facebook/sub-quality/list";
} elseif ($dich_vu == "mem-group") {
    $dtb = "mem_gr";
    $action = $dichvu1['5'];
    $title = "Thành Viên Nhóm";
    $link_get = "api/service/facebook/member-group/list";
} elseif ($dich_vu == "cmt") {
    $dtb = "cmt";
    $action = $dichvu1['5'];
    $title = "Bình Luận";
    $link_get = "api/service/facebook/comment-speed/list";
} elseif ($dich_vu == "like-page-sale") {
    $dtb = "like_page_sale";
    $action = $dichvu1['5'];
    $title = "Like Page";
    $link_get = "api/service/facebook/like-page-sale/list";
} elseif ($dich_vu == "like-page-speed") {
    $dtb = "like_page_speed";
    $action = $dichvu1['5'];
    $title = "Like Page Nhanh";
    $link_get = "api/service/facebook/like-page-speed/list";
} elseif ($dich_vu == "like-page-quality") {
    $dtb = "like_page_quality";
    $action = $dichvu1['5'];
    $title = "Like Page Quality";
    $link_get = "api/service/facebook/like-page-quality/list";
} elseif ($dich_vu == "share") {
    $dtb = "share";
    $action = $dichvu1['5'];
    $title = "Share Facebook";
    $link_get = "api/service/facebook/share-profile/list";
} elseif ($dich_vu == "share-sale") {
    $dtb = "share_sale";
    $action = $dichvu1['5'];
    $title = "Share Facebook Giảm Giá";
    $link_get = "api/service/facebook/share-profile/list";
} elseif ($dich_vu == "mat-live") {
    $dtb = "mat_live";
    $action = $dichvu1['5'];
    $title = "Mắt Live Facebook";
    $link_get = "api/service/facebook/eye-live/list";
} elseif ($dich_vu == "view-video") {
    $dtb = "view_video";
    $action = $dichvu1['5'];
    $title = "View Video";
    $link_get = "api/service/facebook/view-video/list";
} elseif ($dich_vu == "like-cmt") {
    $dtb = "like_cmt";
    $action = $dichvu1['5'];
    $title = "Cảm Xúc Comment";
    $link_get = "api/service/facebook/like-comment/list";
} elseif ($dich_vu == "view-story") {
    $dtb = "view_story";
    $action = $dichvu1['5'];
    $title = "View Story";
    $link_get = "api/service/facebook/view-story/list";
} elseif ($dich_vu == "like-post-sale") {
    $dtb = "like_post_sale";
    $action = $dichvu1['5'];
    $title = "Like bài viết sale";

    $link_get = "api/service/facebook/like-post-sale/list";
} elseif ($dich_vu == "cmt-sale") {
    $dtb = "cmt_sale";
    $action = $dichvu1['5'];
    $title = "Comment Giảm Giá";
    $link_get = "api/service/facebook/comment-sale/list";
}
?>
<?php
if (empty($_SESSION['username'])) {
    header('Location: /Login');
    exit;
} else {
    $getrate = $LTT->get_list("SELECT * FROM `server_service` WHERE `code_service`='$dtb' AND `status_service`='1' AND `url_config`='" . $url_site_name . "' ");
} ?>


<title>List <?= $title; ?></title>
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
                    <h4 class="fw-bold py-3 mb-4">Đơn tăng like bài viết sale Facebook</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4 card-tab">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6 d-grid gap-2">
                                            <a href="https://subgiare.vn/service/facebook/like-post-sale/order"
                                                class="btn btn-outline-primary"><img src="/assets/images/svg/order.svg"
                                                    alt="" width="25" height="25">
                                                Thêm đơn</a>
                                        </div>
                                        <div class="col-6 d-grid gap-2">
                                            <a href="https://subgiare.vn/service/facebook/like-post-sale/list"
                                                class="btn btn-primary"><img src="/assets/images/svg/list-order.svg"
                                                    alt="" width="25" height="25">
                                                Danh sách đơn</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="https://subgiare.vn/service/facebook/like-post-sale/list">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                placeholder="Nhập id, code_order, link_post tìm kiếm ..." name="search"
                                                value="">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i>
                                                Tìm kiếm</button>
                                        </div>
                                    </form>
                                    <div class="table-responsive">

                                        <table class="table table-bordered text-nowrap">
                                            <thead>
                                            <tr role="row" class="bg-primary">
                                        <th class="text-center text-white">ID</th>
                                        <th class="text-center text-white">Thời gian</th>
                                        <th class="text-center text-white">Mã đơn</th>
                                        <?php if (strpos ($dich_vuvu, "post") !== false) {
                                            echo '<th class="text-center text-white">Linh/ID bài viết</th>';
                                            }else{
                                        echo '<th class="text-center text-white">ID Facebook</th>';}?>
                                        <th class="text-center text-white">Máy chủ</th>
                                        <th class="text-center text-white">Số lượng</th>
                                        <th class="text-center text-white">Bắt đầu</th>
                                        <th class="text-center text-white">Đã chạy</th>
                                        <?php if ($dich_vu == "mat-live") { ?>
                                        <th class="text-center text-white">Thời Gian</th>
                                        <?php } ?>
                                        <?php if ($dich_vu == "cmt") { ?>
                                        <th class="text-center text-white">Nội dung</th>
                                        <?php } ?>
                                        <?php if ($dich_vu == "cmt-sale") { ?>
                                        <th class="text-center text-white">Nội dung</th>
                                        <?php } ?>
                                        <th class="text-center text-white">Tổng thanh toán</th>
                                        <th class="text-center text-white">Ghi chú</th>
                                        <th class="text-center text-white">Trạng thái</th>


                                    </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all" class="">
                                                <tr>
                                                    <td class="text-center">410605</td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Hủy đơn" onclick="cancelOrder('https://subgiare.vn/api/service/facebook/like-post-sale/cancel','FbLikePostSale_CPGDE7S6AJ5P','410605',true);"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                    <td class="text-center">
                                                        2022-06-28 14:15:50
                                                    </td>
                                                    <td class="text-center">FbLikePostSale_CPGDE7S6AJ5P</td>
                                                    <td class="text-center">
                                                        <p><a href="https://www.facebook.com/taile.official.2006/posts/546559036905538"
                                                                target="_blank"
                                                                rel="noopener noreferrer">https://www.facebook.com/taile.official.2006/posts/546559036905538</a>
                                                        </p>
                                                    </td>
                                                    <td class="text-center"><span class="badge bg-primary">Server
                                                            9</span>
                                                    </td>
                                                    <td class="text-center">like</td>
                                                    <td class="text-center"><b class="text-danger">1,000</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">0</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">0</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">3.5</b>
                                                        <sup>coin</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">3,500</b>
                                                        <sup>coin</sup>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control note" rows="3"
                                                            readonly></textarea>
                                                    </td>
                                                    <td class="text-center"><span
                                                            class="badge bg-info bg-sm bg-dim">Đang hoạt động</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">351890</td>
                                                    <td class="text-center">
                                                    </td>
                                                    <td class="text-center">
                                                        2022-06-11 15:13:57
                                                    </td>
                                                    <td class="text-center">FbLikePostSale_BCUDY6RSBGBI</td>
                                                    <td class="text-center">
                                                        <p><a href="https://www.facebook.com/taile.official.2006/posts/546559036905538"
                                                                target="_blank"
                                                                rel="noopener noreferrer">https://www.facebook.com/taile.official.2006/posts/546559036905538</a>
                                                        </p>
                                                    </td>
                                                    <td class="text-center"><span class="badge bg-primary">Server
                                                            1</span>
                                                    </td>
                                                    <td class="text-center">like</td>
                                                    <td class="text-center"><b class="text-danger">100</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">0</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">100</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">10.5</b>
                                                        <sup>coin</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">1,050</b>
                                                        <sup>coin</sup>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control note" rows="3"
                                                            readonly></textarea>
                                                    </td>
                                                    <td class="text-center"><span
                                                            class="badge bg-success bg-sm bg-dim">Đã hoàn thành</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">351791</td>
                                                    <td class="text-center">
                                                    </td>
                                                    <td class="text-center">
                                                        2022-06-11 14:56:26
                                                    </td>
                                                    <td class="text-center">FbLikePostSale_JO4HK220B6D3</td>
                                                    <td class="text-center">
                                                        <p><a href="https://www.facebook.com/taile.official.2006/posts/546559036905538"
                                                                target="_blank"
                                                                rel="noopener noreferrer">https://www.facebook.com/taile.official.2006/posts/546559036905538</a>
                                                        </p>
                                                    </td>
                                                    <td class="text-center"><span class="badge bg-primary">Server
                                                            1</span>
                                                    </td>
                                                    <td class="text-center">like</td>
                                                    <td class="text-center"><b class="text-danger">100</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">0</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">100</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">10.5</b>
                                                        <sup>coin</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">1,050</b>
                                                        <sup>coin</sup>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control note" rows="3"
                                                            readonly></textarea>
                                                    </td>
                                                    <td class="text-center"><span
                                                            class="badge bg-success bg-sm bg-dim">Đã hoàn thành</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">351692</td>
                                                    <td class="text-center">
                                                    </td>
                                                    <td class="text-center">
                                                        2022-06-11 14:28:05
                                                    </td>
                                                    <td class="text-center">FbLikePostSale_QVQ6WUVCXQYS</td>
                                                    <td class="text-center">
                                                        <p><a href="https://www.facebook.com/taile.official.2006/posts/546559036905538"
                                                                target="_blank"
                                                                rel="noopener noreferrer">https://www.facebook.com/taile.official.2006/posts/546559036905538</a>
                                                        </p>
                                                    </td>
                                                    <td class="text-center"><span class="badge bg-primary">Server
                                                            9</span>
                                                    </td>
                                                    <td class="text-center">like</td>
                                                    <td class="text-center"><b class="text-danger">100</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">42,874</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">99</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">3.5</b>
                                                        <sup>coin</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">350</b>
                                                        <sup>coin</sup>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control note" rows="3"
                                                            readonly></textarea>
                                                    </td>
                                                    <td class="text-center"><span class="badge bg-dark bg-sm bg-dim">Đã
                                                            hoàn tiền</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">351026</td>
                                                    <td class="text-center">
                                                    </td>
                                                    <td class="text-center">
                                                        2022-06-11 11:08:22
                                                    </td>
                                                    <td class="text-center">FbLikePostSale_LZ7WEMN4Y1JW</td>
                                                    <td class="text-center">
                                                        <p><a href="https://www.facebook.com/taile.official.2006/posts/546559036905538"
                                                                target="_blank"
                                                                rel="noopener noreferrer">https://www.facebook.com/taile.official.2006/posts/546559036905538</a>
                                                        </p>
                                                    </td>
                                                    <td class="text-center"><span class="badge bg-primary">Server
                                                            9</span>
                                                    </td>
                                                    <td class="text-center">like</td>
                                                    <td class="text-center"><b class="text-danger">100</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">42,774</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">100</b>
                                                        <sup>like</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">3.5</b>
                                                        <sup>coin</sup>
                                                    </td>
                                                    <td class="text-center"><b class="text-danger">350</b>
                                                        <sup>coin</sup>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control note" rows="3"
                                                            readonly></textarea>
                                                    </td>
                                                    <td class="text-center"><span
                                                            class="badge bg-success bg-sm bg-dim">Đã hoàn thành</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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