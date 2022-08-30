<?php
require_once('../../config/function.php');
include('../../class/PHPMailer/src/Exception.php');
include('../../class/PHPMailer/src/PHPMailer.php');
include('../../class/PHPMailer/src/SMTP.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    /****
       Up to you which header to send, some prefer 403 even if 
       the files does exist for security
     ****/
    /**** header( 'HTTP/1.0 403 Not Found', TRUE, 403 ); ****/
    /**** include('403.html'); ****/
    include('../../pages/error405.php');
    // $return['status'] = false;
    // $return['error'] = 'error';
    // $return['msg']   = 'Method GET not allowed!';
    // die(json_encode($return));
    /**** choose the appropriate page to redirect users ****/
} else {
    if (empty($_POST['email']) || empty($_POST['otp'])) {
        $return['status'] = false;
        $return['error'] = true;
        $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Vui lòng nhập đầy đủ các trường còn thiếu!</strong></div>';
        $return['message']   = $_POST['email'];
        die(json_encode($return));
    } else {
        $email = $_POST['email'];
        $otp   = $_POST['otp'];
        if (check_string($_POST['_token']) != x_csrf_token()) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = 'Loi Cookie ! Neu Ban Dung IPHONE Vui Long Su Dung Trinh Duyet CHORME !';
            die(json_encode($return));
        } else {
            if (strlen($otp) != 6){
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = 'Vui lòng nhập mã OTP gồm 6 chữ số !';
                die(json_encode($return));
            } else {
                $get_row = $LTT->get_row(" SELECT * FROM `users` WHERE `email` = '" . check_string($_POST['email']) . "' AND  `url_config` = '" . $url_site_name . "' ");
                $otp2 = $get_row['otp_code'];
                if ($otp != $otp2){
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Mã OTP không chính xác";
                    die(json_encode($return));
                } else {
                    $LTT -> query("UPDATE `users` SET `otp_code` = NULL, `status_account` = NULL, `lastdate` = '".gettime()."' WHERE `email` = '".$email."' AND  `url_config` = '" . $url_site_name . "'");
                    $_SESSION["username"] = $get_row['username'];
                    $return['status'] = true;
                    $return['error'] = false;
                    $return['data'] = '<div class="alert alert-success text-center" role="alert"><strong>Xác thực OTP thành công, chuyển hướng sau 1s!</strong></div>';
                    $return['message']   = 'Xác thực thành công';
                    die(json_encode($return));
                }
            }
        }
    }
}