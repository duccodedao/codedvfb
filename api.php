<?php
require_once('config/function.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'class/PHPMailer/src/Exception.php';
require 'class/PHPMailer/src/PHPMailer.php';
require 'class/PHPMailer/src/SMTP.php';


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
    Bạn vừa truy cập ' . $url_site_name . ' vào ' . $time_now . ' bằng địa chỉ IP chưa từng đăng nhập trên hệ thống!<br>
    Địa chỉ IP ' . $ip_khach . ', trình duyệt ' . $_SERVER['HTTP_USER_AGENT'] . '<br>
    Vị trí được xác định qua IP là ' . $json['city'] . ' / ' . $json['region'] . ' / ' . $json['country'] . '- vị trí có thể không chính xác!<br>
    Nếu bạn không nhận ra hoạt động này, hãy thay đổi mật khẩu của bạn ngay lập tức!
    Còn nếu đây là bạn thực hiện, bạn không cần phải làm gì cả, đây chỉ là một thông báo nhằm nâng cao bảo mật tài khoản của khách hàng !<br>
    <font color="#e34d4d">Cảm ơn bạn đã sử dụng dịch vụ tại ' . $url_site_name . ' </font>';
$guitoi = "taihhbg200@gmail.com";
$gui_tb = sendCSM($guitoi, $hoten, $subject, $noi_dung, $bcc);
print_r($gui_tb);