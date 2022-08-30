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
                                        <a href="/dich-vu/<?= $dichvu1['4']; ?>/<?= $dich_vu; ?>"
                                                class="btn btn-outline-primary"><img src="https://subgiare.vn/assets/images/svg/order.svg"
                                                    alt="" width="25" height="25">
                                                Thêm đơn</a>
                                        </div>
                                        <div class="col-6 d-grid gap-2">
                                        <a href="/dich-vu/<?= $dichvu1['4']; ?>/<?= $dich_vu; ?>/list"
                                                class="btn btn-primary"><img src="https://subgiare.vn/assets/images/svg/list-order.svg"
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
                                        <?php if (strpos($dich_vu, "post") !== false){echo '<th class="text-center text-white">Link/ID bài viết</th>';}else if (strpos($dich_vu, "cmt") !== false ){echo '<th class="text-center text-white">Link/ID bài viết</th>'; }else{echo '<th class="text-center text-white">ID Facebook</th>';}?>
                                        <th class="text-center text-white">Máy chủ</th>
                                        <?php if (strpos($dich_vu, "post") !== false){echo '<th class="text-center text-white">Cảm xúc</th>';}?>
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
                                            <tbody>
                                                <?php $getlistbuff = $LTT->get_list("SELECT * FROM `history_buy` WHERE `type` = '$dtb' AND `username` = '$my_user' AND `url_config` = '" . $url_site_name . "' ORDER BY `id` DESC LIMIT 10");
                                            if ($getlistbuff) {
                                                $i = 1;
                                                foreach ($getlistbuff as $rowhbuff) { ?>
                                                <tr class="odd">
                                                    <td><?= $i++?></td>
                                                    <td><?= $rowhbuff['date'] ?></td>
                                                    <td><?= $rowhbuff['ma_gd'] ?></td>
                                                    <td><a href="https://www.facebook.com/<?=$rowhbuff['link_buy']?>"
                                                            target="_blank"><?= $rowhbuff['link_buy'] ?></a></td>
                                                    <td>
                                                        <center><span class="badge bg-primary text-white"><b>Server
                                                                    <?= $rowhbuff['server_buy'] ?></b></span></center>
                                                    </td>
                                                    <?php 
                                                    $api_token = $LTT -> site("token_auto_dvfb");
                                                    $check_gd = check_oders($rowhbuff['ma_gd'], $api_token, $link_get);
                                                    if (strpos($dich_vu, "post") !== false){?><td>
                                                        <b><?=strtoupper($check_gd['data'][0]['reaction'])?></b>
                                                    </td><?php }
                                                    ?>
                                                    <td>
                                                        <b class="text-danger"><?= number_format($check_gd['data'][0]['amount']) ?></b>
                                                        <sup style="color: white;"><?php if (strpos($dich_vu, "post") !== false){ echo "rec"; }else{ echo "sub";}?></sup>
                                                    </td>
                                                    <td>
                                                        <b class="text-danger"><?= number_format($check_gd['data'][0]['start']) ?></b>
                                                        <sup style="color: white;"><?php if (strpos($dich_vu, "post") !== false){ echo "rec"; }else{ echo "sub";}?></sup>
                                                    </td>
                                                    <td>
                                                        <b class="text-danger">
                                                            <?php
                                                                if ($action == "sub-vip") {
                                                                    if ($rowhbuff['status'] == "Pendding") {
                                                                        echo $rowhbuff['number_end'];
                                                                    } else if ($rowhbuff['status'] == "Success") {
                                                                        echo $rowhbuff['number_end'];
                                                                    } else if ($rowhbuff['status'] == "Start") {
                                                                        if ($rowhbuff['number_star'] == "Error") {
                                                                            echo "Lỗi";
                                                                        } else {
                                                                            echo $check_gd['data'][0]['buff'];
                                                                            if ($check_gd['data'][0]['status']=="Success"){
                                                                                $update_sub = $LTT->update("history_buy", ['status' => 'Success', 'number_end' => $check_gd['data'][0]['amount']], " `type` = '$dtb' AND `ma_gd` = '" . $rowhbuff['ma_gd'] . "' AND `username` = '$my_user' AND `url_config` = '" . $url_site_name . "' ");
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo 0;
                                                                    }
                                                                    
                                                                } else if ($action == "sub-speed") {
                                                                    if ($rowhbuff['status'] == "Pendding") {
                                                                        echo $rowhbuff['number_end'];
                                                                    } else if ($rowhbuff['status'] == "Success") {
                                                                        echo $rowhbuff['number_end'];
                                                                    } else if ($rowhbuff['status'] == "Start") {
                                                                        if ($rowhbuff['number_star'] == "Error") {
                                                                            echo "Lỗi";
                                                                        } else {
                                                                            echo $check_gd['data'][0]['buff'];
                                                                            if ($check_gd['data'][0]['status']=="Success"){
                                                                                $update_sub = $LTT->update("history_buy", ['status' => 'Success', 'number_end' => $check_gd['data'][0]['amount']], " `type` = '$dtb' AND `ma_gd` = '" . $rowhbuff['ma_gd'] . "' AND `username` = '$my_user' AND `url_config` = '" . $url_site_name . "' ");
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo 0;
                                                                    }
                                                                } else if ($action == "sub-quality") {
                                                                    if ($rowhbuff['status'] == "Pendding") {
                                                                        echo $rowhbuff['number_end'];
                                                                    } else if ($rowhbuff['status'] == "Success") {
                                                                        echo $rowhbuff['number_end'];
                                                                    } else if ($rowhbuff['status'] == "Start") {
                                                                        if ($rowhbuff['number_star'] == "Error") {
                                                                            echo "Lỗi";
                                                                        } else {
                                                                            echo $check_gd['data'][0]['buff'];
                                                                            if ($check_gd['data'][0]['status']=="Success"){
                                                                                $update_sub = $LTT->update("history_buy", ['status' => 'Success', 'number_end' => $check_gd['data'][0]['amount']], " `type` = '$dtb' AND `ma_gd` = '" . $rowhbuff['ma_gd'] . "' AND `username` = '$my_user' AND `url_config` = '" . $url_site_name . "' ");
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo 0;
                                                                    }
                                                                } elseif ($action == "like-post") {
                                                                    if ($rowhbuff['status'] == "Pendding") {
                                                                        echo $rowhbuff['number_end'];
                                                                    } else if ($rowhbuff['status'] == "Success") {
                                                                        echo $rowhbuff['number_end'];
                                                                    } else if ($rowhbuff['status'] == "Start") {
                                                                        if ($rowhbuff['number_star'] == "Error") {
                                                                            echo "Lỗi";
                                                                        } else {
                                                                            echo $check_gd['data'][0]['buff'];
                                                                            if ($check_gd['data'][0]['status']=="Success"){
                                                                                $update_sub = $LTT->update("history_buy", ['status' => 'Success', 'number_end' => $check_gd['data'][0]['amount']], " `type` = '$dtb' AND `ma_gd` = '" . $rowhbuff['ma_gd'] . "' AND `username` = '$my_user' AND `url_config` = '" . $url_site_name . "' ");
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo 0;
                                                                    }
                                                                } elseif ($action == "like-post-sale") {
                                                                    if ($rowhbuff['status'] == "Pendding") {
                                                                        echo $rowhbuff['number_end'];
                                                                    } else if ($rowhbuff['status'] == "Success") {
                                                                        echo $rowhbuff['number_end'];
                                                                    } else if ($rowhbuff['status'] == "Start") {
                                                                        if ($rowhbuff['number_star'] == "Error") {
                                                                            echo "Lỗi";
                                                                        } else {
                                                                            echo $check_gd['data'][0]['buff'];
                                                                            if ($check_gd['data'][0]['status']=="Success"){
                                                                                $update_sub = $LTT->update("history_buy", ['status' => 'Success', 'number_end' => $check_gd['data'][0]['amount']], " `type` = '$dtb' AND `ma_gd` = '" . $rowhbuff['ma_gd'] . "' AND `username` = '$my_user' AND `url_config` = '" . $url_site_name . "' ");
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo 0;
                                                                    }
                                                                } else {
                                                                    echo $rowhbuff['number_end'];
                                                                } ?>
                                                        </b><sup style="color: white;"><?php if (strpos($dich_vu, "post") !== false){ echo "rec"; }else{ echo "sub";}?></sup>
                                                    </td>

                                                    <?php if ($dich_vu == "mat-live") { ?>
                                                    <td>
                                                        <b>
                                                            <?= $rowhbuff['time_buy'] ?>
                                                            <sup>phút</sup>
                                                        </b>
                                                    </td>
                                                    <?php } ?>
                                                    <?php if ($dich_vu == "cmt") { ?>
                                                    <td>
                                                        <b><?= $rowhbuff['list_msg'] ?></b>
                                                    </td>
                                                    <?php } ?>
                                                    <?php if ($dich_vu == "cmt-sale") { ?>
                                                    <td>
                                                        <b><?= $rowhbuff['list_msg'] ?></b>
                                                    </td>
                                                    <?php } ?>
                                                    <td>
                                                        <b
                                                            class="text-danger"><?= $rowhbuff['tong_tien'] ?></b><sup>đ</sup>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control note" rows="2"
                                                            readonly=""><?=$rowhbuff['ghichu']?></textarea>
                                                    </td>
                                                    <td>
                                                        <center><?= statusorder($rowhbuff['status']) ?></center>
                                                    </td>
                                                </tr>
                                                <?php }
                                            } ?>
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