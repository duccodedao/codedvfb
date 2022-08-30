<?php require('../../config/function.php');
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

    if (check_string($_POST['_token']) != x_csrf_token()) {
        $return['status'] = false;
        $return['error'] = true;
        $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Lỗi cookie, vui lòng load lại trang!</strong></div>';
        $return['message']   = 'Lỗi kết nối !';
        die(json_encode($return));
    } else {
        $key_active = check_string($_POST['key_active']);
        $status_site = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config` = '" . $url_site_name . "'");
        if ($status_site['token_auto_dvfb'] !== "") {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = 'Trang web này đã được kích hoạt !';
            die(json_encode($return));
        }
        if ($status_site['status'] !== "wait") {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = 'Trang web này đã được kích hoạt !';
            die(json_encode($return));
        }
        $status_site = $LTT->get_row(" SELECT * FROM `ds_sitecon` WHERE `site_con` = '" . $url_site_name . "'
");
        $name_admin_site = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '" . $key_active . "' AND `url_config` = '" . $status_site['site_me'] . "'
");
        $ip_khach = getip();
        $url = "https://ipinfo.io/$ip_khach/json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($data, true);


        $time_now = date("H:i:s - d/m/Y");


        $guitoi = $name_admin_site['email'];
        $subject = "THÔNG BÁO KÍCH HOẠT SITE";
        $bcc = $status_site['site_me'];
        $hoten = 'Client';
        $noi_dung = '<h2>Thông Báo</h2>
          <h3>Nội Dung: Bạn vừa kích hoạt site thành công, chúc bạn phát triển site thật thành công ' . $time_now . '</h3>
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
        <td><b  style="color:#5db7de;font-size:20px;">' . $name_admin_site['username'] . '</b>
        </tr>
         <tr>
         <td style="font-size:20px;">Mật Khẩu:</td>
        <td><b  style="color:#5db7de;font-size:20px;">*********</b>
        </tr>
        </tbody>
        </table>
        <font color="#e34d4d">Cảm ơn bạn đã sử dụng dịch vụ tại ' . $status_site['site_me'] . ' </font>
';





        $gui_tb = sendCSM($guitoi, $hoten, $subject, $noi_dung, $bcc);


        if ($status_site['token'] !== $key_active) {
            $return['status'] = false;
            $return['error'] = true;

            $return['message']   = 'Token kích hoạt không hợp lệ !';
            die(json_encode($return));
        } else {

            $update = $LTT->update("setting", [
                'token_auto_dvfb' => $key_active,
                'status' => 'active'
            ], " `url_config` = '" . $url_site_name . "'");
            if ($update) {

                $return['status'] = true;
                $return['error'] = false;

                $return['message']   = 'Kích hoạt trang web thành công, chúc bạn phát triển web 1 cách tốt nhất !';
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
