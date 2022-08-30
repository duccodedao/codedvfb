<?php
require_once('../../config/function.php');
include('../../class/PHPMailer/src/Exception.php');
include('../../class/PHPMailer/src/PHPMailer.php');
include('../../class/PHPMailer/src/SMTP.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    include('../../pages/error405.php');
} else {
    if (empty(check_string($_POST['username'])) || empty(check_string($_POST['password']))) {
        $return['status'] = false;
        $return['error'] = true;
        $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Vui lòng nhập đầy đủ các trường còn thiếu!</strong></div>';
        $return['message']   = 'Vui lòng nhập đầy đủ các trường còn thiếu!';
        die(json_encode($return));
    } else {
            if (check_username(check_string($_POST['username'])) == false) {
                $return['status'] = false;
                $return['error'] = true;
                $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Định dạng tài khoản không hợp lệ!</strong></div>';
                $return['message']   = 'Vui lòng nhập định dạng tài khoản hợp lệ !';
                die(json_encode($return));
            } else {
                if (!$LTT->get_row(" SELECT * FROM `users` WHERE `username` = '" . check_string($_POST['username']) . "'   AND  `url_config` = '" . $url_site_name . "'")) {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Tên đăng nhập không tồn tại!</strong></div>';
                    $return['message']   = 'Tên đăng nhập không tồn tại!';
                    die(json_encode($return));
                } else {
                    $checkuseriui = $LTT->get_row(" SELECT * FROM `users` WHERE `username` = '" . check_string($_POST['username']) . "' AND `password` = '" . check_string(md5($_POST['password'])) . "'   AND  `url_config` = '" . $url_site_name . "'");
                    if (!$checkuseriui) {
                        $return['status'] = false;
                        $return['error'] = true;
                        $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong> Mật khẩu bạn nhập không chính xác!</strong></div>';
                        $return['message']   = 'Mật khẩu bạn nhập không chính xác!';
                        die(json_encode($return));
                    } else {
                        if ($LTT->get_row(" SELECT * FROM `users` WHERE `username` = '" . check_string($_POST['username']) . "' AND `banned` > '1'   AND  `url_config` = '" . $url_site_name . "'")) {
                            $return['status'] = false;
                            $return['error'] = true;
                            $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Bạn đã bị block vì vi phạm chính sách cộng đồng của chúng tôi!</strong></div>';
                            $return['message']   = 'Bạn đã bị block vì vi phạm chính sách cộng đồng của chúng tôi!';
                            die(json_encode($return));
                        } else {
                            $ip_cu = $checkuseriui['ip'];
                            $remember = check_string($_POST['remember']);
                            if ($remember == 'on') {
                            }
                            $LTT->update("users", [
                                'lastdate' => gettime()
                            ], " `username` = '" . check_string($_POST['username']) . "'   AND  `url_config` = '" . $url_site_name . "'");
                            $_SESSION['username'] = $_POST['username'];
                            if ($LTT->site('thong_bao_mail') == "ON") {
                                if ($ip_cu != getip()){
                                    $ip_khach = getip();
                                    $url = "https://ipinfo.io/$ip_khach/json";
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, $url);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    $data = curl_exec($ch);
                                    curl_close($ch);
                                    $json = json_decode($data, true);
                                    $time_now = date("H:i:s - d/m/Y");
                                    $subject = "THÔNG BÁO ĐĂNG NHẬP";
                                    $bcc = $url_site_name;
                                    $hoten = 'Client';
                                    $noi_dung = '<h2>Thông Báo</h2>
    Bạn vừa truy cập ' . $url_site_name . ' vào ' . $time_now . ' bằng địa chỉ IP mới!<br>
    Địa chỉ IP ' . $ip_khach . ', trình duyệt ' . $_SERVER['HTTP_USER_AGENT'] . '<br>
    Vị trí được xác định qua IP là ' . $json['city'] . ' / ' . $json['region'] . ' / ' . $json['country'] . '- vị trí có thể không chính xác!<br>
    Nếu bạn không nhận ra hoạt động này, hãy thay đổi mật khẩu của bạn ngay lập tức!
    Còn nếu đây là bạn thực hiện, bạn không cần phải làm gì cả, đây chỉ là một thông báo nhằm nâng cao bảo mật tài khoản của khách hàng !<br>
    <font color="#e34d4d">Cảm ơn bạn đã sử dụng dịch vụ tại ' . $url_site_name . ' </font>';
                                    $guitoi = "thattinh14122@gmail.com";
                                    $gui_tb = sendCSM($guitoi, $hoten, $subject, $noi_dung, $bcc);
                                }
                                apitele('
    ' . $LTT->site("ten_website") . ' 
    THÔNG BÁO ĐĂNG NHẬP
    Tài Khoản: ' . $_POST['username'] . '
    Thời Gian: ' . $timenow . '
    địa chỉ IP: ' . getip() . '
                ');}
                            $return['status'] = true;
                            $return['error'] = false;
                            $return['data'] = '<div class="alert alert-success text-center" role="alert"><strong>Đăng nhập thành công!</strong></div>';
                            $return['message']   = 'Đăng nhập thành công!';
                            die(json_encode($return));
                        }
                    }
                }
            }
        }
    }
