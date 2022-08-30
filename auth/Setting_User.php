<?php require('../config/function.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    /****
       Up to you which header to send, some prefer 403 even if 
       the files does exist for security
     ****/
    /**** header( 'HTTP/1.0 403 Not Found', TRUE, 403 ); ****/
    /**** include('403.html'); ****/
    include('../pages/error405.php');
    // $return['status'] = false;
    // $return['error'] = 'error';
    // $return['msg']   = 'Method GET not allowed!';
    // die(json_encode($return));
    /**** choose the appropriate page to redirect users ****/
} else {

    if ($_POST['action'] == "change-token") {
        $x_csrf_token = x_csrf_token();
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token' ");

        $token_site = $LTT->get_row(" SELECT * FROM `ds_sitecon` WHERE `token` = '$api_token' ");

        if (empty($api_token)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu API Token";
            die(json_encode($return));
        } elseif (!$checkusite) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "API Token không hợp lệ";
            die(json_encode($return));
        } else {

            $token_new = "eyJhbGciO" . (random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPghjklzxcvbnmQWERTYUIOPghjklzxcvbnmQWERTYUIOPghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM', 100) . time()) . typepass2(random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890', 100) . time());

            if ($update2 = $LTT->update("users", ['token' => $token_new], " `username` = '" . $checkusite['username'] . "' AND  `url_config` = '" . $url_site_name . "' ")) {

                $check_site = $LTT->get_row(" SELECT * FROM `ds_sitecon` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "'");
                $update_token_new =
                    $LTT->update("ds_sitecon", ['token' => $token_new], "  `username` = '" . $my_user . "' ");
                $return['status'] = true;
                $return['message']   = "Thay đổi thành công";
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['message']   = "Cập nhật api token mới thất bại";
                die(json_encode($return));
            }
        }
    } elseif ($_POST['action'] == "change-pass") {




        $x_csrf_token = x_csrf_token();
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token' ");

        if (empty($api_token)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu API Token";
            die(json_encode($return));
        }

        if (!$checkusite) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "API Token không hợp lệ";
            die(json_encode($return));
        }

        $old_password        = check_string($_POST['old_password']);
        $new_password     = check_string($_POST['new_password']);
        $confirm_new_password           = check_string($_POST['confirm_new_password']);

        if (empty($old_password)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập mật khẩu cũ";
            die(json_encode($return));
        }

        if (empty($new_password)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập mật khẩu mới";
            die(json_encode($return));
        }

        if (empty($confirm_new_password)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng xác nhận mật khẩu mới";
            die(json_encode($return));
        }


        if (md5($old_password) != $checkusite['password']) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Mật khẩu cũ bạn nhập không chính xác";
            die(json_encode($return));
        }

        if (md5($confirm_new_password) != md5($new_password)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Mật khẩu xác nhận không trùng khớp";
            die(json_encode($return));
        }

        if ($update2 = $LTT->update("users", ['password' => md5($new_password)], " `username` = '" . $checkusite['username'] . "' ")) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Cập nhật thành công";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Đã có lỗi xảy ra";
            die(json_encode($return));
        }
    } elseif ($_POST['action'] == "upgrade") {


        $x_csrf_token = x_csrf_token();
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token' ");

        if (empty($api_token)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu API Token";
            die(json_encode($return));
        }

        if (!$checkusite) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "API Token không hợp lệ";
            die(json_encode($return));
        }
        $type = check_string($_POST['type']);

        if ($type == 'collaborators') {
            if ($checkusite['tongnap'] < $LTT->site('rate_ctv')) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Bạn chưa đủ điều kiện để nâng lên cấp bậc cộng tác viên";
                die(json_encode($return));
            } else {
                $update1 = $LTT->update("users", ['capbac' => 1], " `username` = '" . $checkusite['username'] . "' ");

                if ($update1) {
                    $return['status'] = true;
                    $return['error'] = false;
                    $return['message']   = "Nâng cấp thành công cấp bậc cộng tác viên";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Chức năng đang bảo trì, liên hệ admin";
                    die(json_encode($return));
                }
            }
        }

        if ($type == 'agency') {
            if ($checkusite['tongnap'] < $LTT->site('rate_daily')) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Bạn chưa đủ điều kiện để nâng lên cấp bậc đại lý";
                die(json_encode($return));
            } else {
                $update2 = $LTT->update("users", ['capbac' => 2], " `username` = '" . $checkusite['username'] . "' ");

                if ($update2) {
                    $return['status'] = true;
                    $return['error'] = false;
                    $return['message']   = "Nâng cấp thành công cấp bậc đại lý";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Chức năng đang bảo trì, liên hệ admin";
                    die(json_encode($return));
                }
            }
        }

        if ($type == 'agencyy') {
            if ($checkusite['tongnap'] < $LTT->site('rate_admin')) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Bạn chưa đủ điều kiện để nâng lên cấp bậc nhà phân phối";
                die(json_encode($return));
            } else {
                $update1 = $LTT->update("users", ['capbac' => 4], " `username` = '" . $checkusite['username'] . "' ");

                if ($update1) {
                    $return['status'] = true;
                    $return['error'] = false;
                    $return['message']   = "Nâng cấp thành công cấp bậc nhà phân phối";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Chức năng đang bảo trì, liên hệ admin";
                    die(json_encode($return));
                }
            }
        }
        if ($type == 'thanhvien') {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Nâng cấp thành công cấp bậc thành viên";
            die(json_encode($return));
        }
        if ($type !== 'collaborators' || $type !== 'agency') {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Website không hỗ trợ chức năng này";
            die(json_encode($return));
        }
    } else {
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Hệ thống đã xảy ra lỗi !";
        die(json_encode($return));
    }
}