<?php require('../../config/function.php');
// require_once('../../config/scr.php');
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
    /**** choose the appropriate page to redirect users graphhcaptcha($rescaptcha) ****/
} else {

    if (empty(check_string($_POST['name'])) || empty(check_string($_POST['email'])) || empty(check_string($_POST['username'])) || empty(check_string($_POST['password']))) {
        $return['status'] = false;
        $return['error'] = true;
        $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Vui lòng nhập đầy đủ các trường còn thiếu!</strong></div>';
        $return['message']   = 'Vui lòng nhập đầy đủ các trường còn thiếu!';
        die(json_encode($return));
    } else {
        if (check_string($_POST['_token']) != x_csrf_token()) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = 'Loi Cookie ! Neu Ban Dung IPHONE Vui Long Su Dung Trinh Duyet CHORME !';
            die(json_encode($return));
        } else {

            if (check_username(check_string($_POST['username'])) == false) {
                $return['status'] = false;
                $return['error'] = true;
                $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Vui lòng nhập định dạng tài khoản hợp lệ!</strong></div>';
                $return['message']   = 'Vui lòng nhập định dạng tài khoản hợp lệ !';
                die(json_encode($return));
            } else {
                if (strlen(check_string($_POST['username'])) < 6 || strlen(check_string($_POST['username'])) > 32) {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Vui lòng nhập tài khoản từ 6 đến 32 ký tự !</strong></div>';
                    $return['message']   = 'Vui lòng nhập tài khoản từ 6 đến 32 ký tự !';
                    die(json_encode($return));
                } else {
                    if ($LTT->get_row(" SELECT * FROM `users` WHERE `username` = '" . check_string($_POST['username']) . "' AND  `url_config` = '" . $url_site_name . "' ")) {
                        $return['status'] = false;
                        $return['error'] = true;
                        $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Tên đăng nhập đã tồn tại trên hệ thống!</strong></div>';
                        $return['message']   = 'Tên đăng nhập đã tồn tại trên hệ thống !';
                        die(json_encode($return));
                    } else {
                        if (check_email(check_string($_POST['email'])) == false) {
                            $return['status'] = false;
                            $return['error'] = true;
                            $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Vui lòng nhập định dạng email hợp lệ!</strong></div>';
                            $return['message']   = 'Vui lòng nhập định dạng email hợp lệ !';
                            die(json_encode($return));
                        } else {
                            if ($LTT->get_row(" SELECT * FROM `users` WHERE `email` = '" . check_string($_POST['email']) . "' AND  `url_config` = '" . $url_site_name . "' ")) {
                                $return['status'] = false;
                                $return['error'] = true;
                                $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Email đã tồn tại trên hệ thống !</strong></div>';
                                $return['message']   = 'Email đã tồn tại trên hệ thống !';
                                die(json_encode($return));
                            } else {
                                if ($LTT->num_rows(" SELECT * FROM `users` WHERE `ip` = '" . getip() . "' AND  `url_config` = '" . $url_site_name . "'") >= 3) {
                                    $return['status'] = false;
                                    $return['error'] = true;
                                    $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Bạn đã bị giới hạn tạo tài khoản, vui lòng liên hệ admin để khôi phục lại!</strong></div>';
                                    $return['message']   = 'Bạn đã bị giới hạn tạo tài khoản, vui lòng liên hệ admin để khôi phục lại!';
                                    die(json_encode($return));
                                } else {

                                    if ($LTT->get_row(" SELECT * FROM `users` WHERE `cuphap` = '" . $LTT->site('cuphap') . rand(0, 9999) . "' AND  `url_config` = '" . $url_site_name . "'")) {
                                        $cuphapnap = $LTT->site('cuphap') . " " . $_POST['username'];
                                    } else {
                                        $cuphapnap = $LTT->site('cuphap') . " " . $_POST['username'];
                                    }
                                    if ($LTT -> site("auth_otp") != "ON"){
                                        $code = '';
                                        $st = '';
                                    } else {
                                        $code = random_int(106327, 984473);
                                        $st = 'wait';
                                    }
                                    $create = $LTT->insert("users", [
                                        'username'      => xoa_dau(check_string($_POST['username'])),
                                        'name'          => check_string($_POST['name']),
                                        'email'         => check_string($_POST['email']),
                                        'password'      => md5(check_string($_POST['password'])),
                                        'token'         => "eyJhbGciO" . (random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPghjklzxcvbnmQWERTYUIOPghjklzxcvbnmQWERTYUIOPghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM', 100) . time()) . typepass2(random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890', 100) . time()),
                                        'capbac'        => 0,
                                        'money'         => 0,
                                        'tongnap'       => 0,
                                        'tongtru'       => 0,
                                        'banned'        => 0,
                                        'ip'            => getip(),
                                        'cuphap'        => $cuphapnap,
                                        'date'          => gettime(),
                                        'otp_code'      => $code,
                                        'status_account'=> $st,
                                        'url_config' => $url_site_name
                                    ]);

                                    if ($create) {
                                        if ($LTT->site('thong_bao_mail') == "ON") {
                                            $ip_khach = getip();
                                            $url = "https://ipinfo.io/$ip_khach/json";
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, $url);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            $data = curl_exec($ch);
                                            curl_close($ch);
                                            $json = json_decode($data, true); 
                                            $time_now = date("H:i:s - d/m/Y");
                                            $subject = "THÔNG BÁO TÀI KHOẢN";
                                            $bcc = $url_site_name;
                                            $hoten = $_POST['name'];
                                            if ($LTT->site("auth_otp") == "ON"){
                                                $noi_dung = '<h2>Thông Báo</h2>
          <h3>Nội Dung: Bạn vừa đăng kí tài khoản ở hệ thông chúng tôi lúc ' . $time_now . '. Email này có mục đích xác thực tài khoản của bạn</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">IP:</td>
        <td><b style="color:red;font-size:20px;">' . $ip_khach . '</b>
        </td>
        
        </tr>
        <tr>
        <td style="font-size:20px;">Tài Khoản:</td>
        <td><b  style="color:#5db7de;font-size:20px;">' . $_POST['username'] . '</b>
        </tr>
        <tr>
        <td style="font-size:20px;">Vui Lòng Nhập Mã OTP Để Xác Thực Tài Khoản:</td>
        <td><b  style="color:#5db7de;font-size:20px;">'.$code.'</b>
        </tr>
        <tr>
        <td style="font-size:20px;">URL ENTER OTP: </td>
        <td><b  style="color:#5db7de;font-size:20px;">'.BASE_URL("Auth-OTP?email=").$_POST['email'].'&code='.$code.'</b>
        </tr>
        </tbody>
        </table>
        <font color="#e34d4d">Cảm ơn bạn đã sử dụng dịch vụ tại ' . $url_site_name . ' </font>
';
}else{
                                            $noi_dung = '<h2>Thông Báo</h2>
          <h3>Nội Dung: Bạn vừa đăng kí tài khoản ở hệ thông chúng tôi lúc ' . $time_now . '</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">IP:</td>
        <td><b style="color:red;font-size:20px;">' . $ip_khach . '</b>
        
        </td>
        
        </tr>
        <tr>
         <td style="font-size:20px;">Địa Chỉ:</td>
        <td><b  style="color:#5db7de;font-size:20px;">' . $json['city'] . ' - ' . $json['region'] . ' - ' . $json['country'] . '</b>
        </tr>
        <tr>
         <td style="font-size:20px;">Tài Khoản:</td>
        <td><b  style="color:#5db7de;font-size:20px;">' . $_POST['username'] . '</b>
        </tr>
         <tr>
         <td style="font-size:20px;">Mật Khẩu:</td>
        <td><b  style="color:#5db7de;font-size:20px;">*********</b>
        </tr>
        </tbody>
        </table>
        <font color="#e34d4d">Cảm ơn bạn đã sử dụng dịch vụ tại ' . $url_site_name . ' </font>
    ';}
    $guitoi = $_POST['email'];
    $gui_tb = sendCSM($guitoi, $hoten, $subject, $noi_dung, $bcc);
}
$ghilog = $LTT->insert("log_site", [
    'username' => $_POST['username'],
    'note'          => 'Đăng kí tài khoản',
    'ip'            => getip(),
    'date'          => gettime(),
    'url_config' => $url_site_name
]);

$_SESSION['username'] = xoa_dau(check_string($_POST['username']));
$return['status'] = true;
$return['error'] = false;
$return['data'] = '<div class="alert alert-success text-center" role="alert"><strong>Đăng ký thành công, chuyển hướng sau 1s!</strong></div>';
$return['message']   = 'Đăng ký thành công';
die(json_encode($return));
} else {
$return['status'] = false;
$return['error'] = true;
$return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Đã xảy ra lỗi khi đăng ký, vui lòng liên hệ admin!</strong></div>';
$return['message']   = 'Đã xảy ra lỗi khi đăng ký, vui lòng liên hệ admin';
die(json_encode($return));
}
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}