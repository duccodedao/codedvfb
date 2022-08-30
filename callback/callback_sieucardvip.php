<?php
require('../config/function.php');


$status = $_GET['Success'];



if (isset($_GET['Success'])) {
    $code = $_GET['Pin'];
    $serial = $_GET['Seri'];
    $thucnhan = $_GET['CardValue'];
    $tranid = $_GET['requestid'];
    $value = $_GET['CardValue'];






    $chietkhau_the = $LTT->site('ck_thecao');
    $tien_nhan = $value - $value * $chietkhau_the / 100;
    $callback_sign = md5($LTT->site('partner_key') . $_GET['Pin'] . $_GET['Seri']);

    if ($_GET['Hash'] == $callback_sign) {

        $checkthe = $LTT->get_row("SELECT * FROM `history_naptien` WHERE `sothe` = '$code' AND `soseri` = '$serial' AND `tranid` = '$tranid'  AND  `url_config` = '" . $url_site_name . "'");
        $getusernap = $checkthe['username'];
        if (!$checkthe) {
            exit('Request ID không tồn tại');
        } else {
            if ($callback_sign != md5($LTT->site('partner_key') . $code . $serial)) {
                exit('Key xác minh không đúng');
            } else {
                if ($_GET['Success'] == "False") {

                    /* update trạng thái thẻ*/
                    $update2 = $LTT->update("history_naptien", ['trangthai' => 2], " `tranid` = '$tranid'  AND  `url_config` = '" . $url_site_name . "'");
                } else {

                    /* update trạng thái thẻ*/
                    $update2 = $LTT->update("history_naptien", ['trangthai' => 1], " `tranid` = '$tranid'  AND  `url_config` = '" . $url_site_name . "'");
                    $update2 = $LTT->update("history_naptien", ['thucnhan'  => $tien_nhan], " `tranid` = '$tranid'  AND  `url_config` = '" . $url_site_name . "'");
                    /* update tiền user*/
                    $update1 = $LTT->cong("users", "money", $tien_nhan, " `username` = '$getusernap'  AND  `url_config` = '" . $url_site_name . "'");
                    $update3 = $LTT->cong("users", "tongnap", $tien_nhan, " `username` = '$getusernap'  AND  `url_config` = '" . $url_site_name . "'");
                }
            }
        }
    }

    $myfile = fopen("log_sieucardvip.txt", "w") or die("Unable to open file!");
    $txt = $_GET['Success'] . "|" . $_GET['requestid'] . "|" . $_GET['CardValue'] . "\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}
