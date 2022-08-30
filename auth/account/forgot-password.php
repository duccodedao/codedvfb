<?php
require('../../config/function.php');
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

include('../../class/PHPMailer/src/Exception.php');
include('../../class/PHPMailer/src/PHPMailer.php');
include('../../class/PHPMailer/src/SMTP.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    include('../../pages/error405.php');
} else {
    $api_token = check_string($_POST['_token']);
    $action = check_string($_POST['action']);
    $email = check_string($_POST['email']);
    $username_khach = $LTT->get_row(" SELECT * FROM `users` WHERE `email` = '$email'  AND  `url_config` = '" . $url_site_name . "' ");
    if (!$username_khach) {
        $return['status'] = false;
        $return['error'] = true;
        $return['href'] = '/Login';
        $return['message']   = "Địa chỉ email không tồn tại !";
        die(json_encode($return));
    }
    if ($action == "get_otp") {
        if (empty($email)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập email !";
            die(json_encode($return));
        } else {
            if ($site_gmail == "" || $site_pass == "") {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = 'Website chưa set mục này vui lòng báo admin !';
                die(json_encode($return));
            } else {
                $link_kp = $base_url . "change-password/?email=$email";
                $otp = rand(100000, 999999);
                $subject = 'XÁC NHẬN KHÔI PHỤC MẬT KHẨU';
                $bcc = $url_site_name;
                $hoten = 'Client';
                $noi_dung = '<h2>Thông Báo</h2>
        
        <h3>Nội Dung: Có ai đó vừa yêu cầu khôi phục lại mật khẩu bằng Email này, nếu là bạn vui lòng nhập mã xác minh phía dưới để xác minh tài khoản</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">Mã OTP:</td>
        <td><b style="color:red;font-size:20px;">' . $otp . '</b>
        
        </td>
        
        </tr>
        <tr>
         <td style="font-size:20px;">Link Khôi Phục:</td>
        <td><b href="' . $link_kp . '" style="color:#5db7de;font-size:20px;">' . $link_kp . '</b>
        </tr>
        </tbody>
        </table>';
                $guitoi = $email;


                $hoten = 'Client';

                $gui_tb = sendCSM($guitoi, $hoten, $subject, $noi_dung, $bcc);
                if ($gui_tb) {
                    $LTT->update("users", [
                        'otp_code' => $otp,
                        'lastdate' => gettime()
                    ], " `email` = '" . $email . "'   AND  `url_config` = '" . $url_site_name . "'");
                    $return['status'] = true;
                    $return['error'] = false;
                    $return['href'] = "/Change-Password?email=".$email;
                    $return['message']   = "Thành công. vui lòng kiểm tra email";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = 'Lỗi hệ thống !';
                    die(json_encode($return));
                }
            }
        }
    }
    if ($action == "change_pass") {
        $otp = check_string($_POST['otp']);
        $password = check_string($_POST['password']);
        $repassword = check_string($_POST['repassword']);
        if (empty($password) || empty($repassword)){
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = 'Vui lòng nhập đủ thông tin';
            die(json_encode($return));
        }
        if ($password != $repassword) {
            $return['status'] = false;
            $return['error'] = true;

            $return['message']   = 'Mật khẩu bạn nhập không giống nhau !';
            die(json_encode($return));
        }
        if ($otp !== $username_khach['otp_code']) {
            $return['status'] = false;
            $return['error'] = true;

            $return['message']   = 'Mã OTP Không Chính Xác !';
            die(json_encode($return));
        } else {
            $doi_mk = $LTT->update("users", [
                'otp_code' => '',
                'password' => md5($password),
                'lastdate' => gettime()
            ], " `email` = '" . $email . "' AND  `url_config` = '" . $url_site_name . "'");
            if ($doi_mk) {
                $ghilog = $LTT->insert("log_site", [
                    'username' => $username_khach['username'],
                    'note'          => 'Khôi phục mật khẩu',
                    'ip'            => getip(),
                    'date'          => gettime(),
                    'url_config'          => $url_site_name
                ]);

                $return['status'] = true;
                $return['error'] = false;
                $return['href'] = "/home";
                $return['message']   = 'Đổi mật khẩu thành công !';
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['error'] = true;

                $return['message']   = 'Đã xảy ra lỗi !';
                die(json_encode($return));
            }
        }
    }
}
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>