<?php require('../../config/function.php');
header('Content-Type: application/json; charset=utf-8');
$action = check_string($_GET['action']);
$code_order = check_string($_GET['code_order']);


if ($action == "mem-group") {
    $link_post = "api/service/facebook/member-group/list";
} elseif ($action == "like-post") {
    $link_post = "api/service/facebook/like-post-speed/list";
} elseif ($action == "like-post-sale") {
    $link_post = "api/service/facebook/like-post-sale/list";
} elseif ($action == "sub-sale") {
    $link_post = "api/service/facebook/sub-sale/list";
} elseif ($action == "sub-speed") {
    $link_post = 'api/service/facebook/sub-speed/list';
} elseif ($action == "sub-vip") {
    $link_post = 'api/service/facebook/sub-vip/list';
} elseif ($action == "sub-quality") {
    $link_post = 'api/service/facebook/sub-quality/list';
} elseif ($action == "cmt") {
    $link_post = "api/service/facebook/comment-speed/list";
} elseif ($action == "cmt-sale") {
    $link_post = "api/service/facebook/comment-sale/list";
} elseif ($action == "like-page-sale") {
    $link_post = "api/service/facebook/like-page-sale/list";
} elseif ($action == "like-page-speed") {
    $link_post = "api/service/facebook/like-page-speed/list";
} elseif ($action == "like-page-quality") {
    $link_post = "api/service/facebook/like-page-quality/list";
} elseif ($action == "share") {
    $link_post = "api/service/facebook/share-profile/list";
} elseif ($action == "share-sale") {
    $link_post = "api/service/facebook/share-sale/list";
} elseif ($action == "mat-live") {
    $link_post = "api/service/facebook/eye-live/list";
} elseif ($action == "view-video") {
    $link_post = "api/service/facebook/view-video/list";
} elseif ($action == "like-cmt") {
    $link_post = "api/service/facebook/like-comment/list";
} elseif ($action == "view-story") {
    $link_post = "api/service/facebook/view-story/list";
}

echo $don = check_oders("FbSubVip_5E1K32N7GWBM", $token_auto_dvfb, $link_post);

print_r($don);
$buff = $json->data->buff;

$LTT->update("history_buy", ['buff' => $buff], "`ma_gd` = 'FbLikePostSale_3Z89JY7AAMSL'");
