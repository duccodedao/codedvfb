<?php 
require('../../config/function.php');
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

include('../../class/class.smtp.php');
include('../../class/PHPMailerAutoload.php');
include('../../class/class.phpmailer.php');

 

$email=$_POST['email'];
    

  $subject = $_POST['subject'];
        $bcc = $url_site_name;
        $hoten ='Client';
        $noi_dung = $_POST['noidung'];
            $guitoi =$email;   
           
           
            $hoten ='Client';
            
            $gui_tb=sendCSM($guitoi, $hoten, $subject, $noi_dung, $bcc);
            
            /*
            $data = array( 
'email' => $checkusite['email'], 
'subject' => 'XỬ LÝ HỖ TRỢ', 
'noidung' => '<h2>Thông Báo</h2>
        
        <h3>Nội Dung: Chúng tôi đã nhận được đơn yêu cầu hỗ trợ của bạn, chúng tôi sẽ phản hồi trong thời gian sớm nhất.</h3><br>
    <font color="#e34d4d">Cảm ơn bạn đã tin dùng dịch vụ của chúng tôi !</font>
     ' 
); 
 $head = array( 
 "user-agent: Mozilla/5.0 (Linux; Android 11; Redmi Note 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Mobile Safari/537.36" 
 ); 
 $url="https://".strtolower($url_site_name)."/auth/tools/mail.php";
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $head); 

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
curl_setopt($ch, CURLOPT_ENCODING, true); 
   $login_data = json_decode(curl_exec($ch)); 
   curl_close($ch); 