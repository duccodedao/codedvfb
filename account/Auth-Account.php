<?php require_once('../config/function.php');
if ($LTT->site('bao_tri') == "OFF") {
    header('Location: /bao_tri');
    exit;
}
if ($LTT->check_ip(getip()) == "block") {
    header('Location: /BAND-IP');
    exit;
}
if (isset($_SESSION['username'])) {
    header('Location: /home');
    exit;
}
$status_site = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config`='" . $url_site_name . "'");
if ($status_site['token_auto_dvfb'] == "" || $status_site['status'] == "wait") {
    require('../pages/active.php');
} else {
    require("../pages/login.php");
}
