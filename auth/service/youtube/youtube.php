<?php require('../../../config/function.php');

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

    //LẤY DATA POST
    $code_dich_vu = check_string($_POST['code_dich_vu']);
    $action    = check_string($_POST['action']);
    $loai_camxuc      = check_string($_POST['loai_camxuc']);
    $time_buy      = check_string($_POST['time_buy']);
    $list_msg      = check_string($_POST['list_msg']);
    $id      = check_string($_POST['id']);
    $soluong         = check_string($_POST['soluong']);
    $server_buy   = check_string($_POST['server']);
    $ghichu   = check_string($_POST['ghichu']);
    //KIỂM TRA DATA

    $api_token = api_token();
    if (empty($api_token)) {
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "API Token không hợp lệ";
        die(json_encode($return));
    }

    if ($action == "like") {
        $link_post = "api/service/youtube/like/order";
    } elseif ($action == "sub") {
        $link_post = "api/service/youtube/sub/order";
    }





    if (empty($server_buy)) {
        $return['status'] = false;
        $return['error'] = true;
        $return['message'] = 'Vui lòng chọn server !';
        die(json_encode($return));
    }

    if (empty($id)) {
        $return['status'] = false;
        $return['error'] = true;
        $return['message'] = 'Vui lòng nhập ID !';
        die(json_encode($return));
    }
    if (empty($soluong)) {
        $return['status'] = false;
        $return['error'] = true;
        $return['message'] = 'Vui lòng nhập số lượng muốn mua !';
        die(json_encode($return));
    }
    if ($soluong < 100) {
        $return['status'] = false;
        $return['error'] = true;
        $return['message'] = 'Số lượng order phải lớn hơn 100 !';
        die(json_encode($return));
    }
    if (check_number($soluong) != 1) {
        $return['status'] = false;
        $return['error'] = true;
        $return['message'] = 'Số lượng order phải là một số.';
        die(json_encode($return));
    }


    if ($url_site_name == $LTT->check('url_admin')) {
        $username_khach = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "'
");
        if (!$username_khach) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "API Token không hợp lệ";
            die(json_encode($return));
        }
        $gia_dich_vu = $LTT->get_row("SELECT * FROM `server_service` WHERE `code_service` = '$code_dich_vu' AND `status_service` = '1' AND `server_service` = '$server_buy'");
        $package = $gia_dich_vu['server_name'];
        $ratesv = $gia_dich_vu['rate_service'] + $gia_dich_vu['rate_service'] * $chietkhau / 100;
        if ($lam_tron == "ON") {

            $tongtien = ceil($ratesv) * $soluong;
        } else {
            $tongtien = $ratesv * $soluong;
        }

        if ($username_khach['money'] < $tongtien) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message'] = 'Số tiền của bạn không đủ để thực hiện giao dịch này';
            die(json_encode($return));
        }
        $type_buy = 'Login Website';

        //CURL _ NGUỒN DỊCH VỤ

        if ($LTT->check('trang_thai_auto') == "ON") {
            $post_data = [
                'link_story' => $id,
                'idgroup' => $id,
                'idpage' => $id,
                'idfb' => $id,
                'idcomment' => $id,
                'idpost' => $id,
                'link_post' => $id,
                'link_video' => $id,
                'speed' => $speed,
                'time' => $speed,
                'comment' => $list_msg,
                'server_order' => 'sv' . $server_buy,
                'reaction' => $loai_camxuc,
                'amount' => $soluong,
                'minutes' =>   $time_buy,
                'note' => $ghichu
            ];
            $head =
                array(
                    'api-token: ' . $token_auto_dvfb,
                    'Content-Type: application/json'


                );

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://thuycute.hoangvanlinh.vn/' . $link_post,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($post_data),
                CURLOPT_HTTPHEADER => $head,
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response, true);
            $result_text = $result['status'];

            if ($result_text == false) {
                $return['status'] = false;
                $return['message']   = $result['message'];
                die(json_encode($return));
            }
            $number_star = $result['data']['start'];
            // TRẢ KẾT QUẢ THÀNH CÔNG VÀ TIỀN HÀNH LƯU DATA
            if ($result_text == true) {
                // TẠO CÁC THAM SỐ TIỀN HÀNH TRỪ TIỀN 
                $tru_tien_mua = $username_khach['money'] - $tongtien; // trừ tiền
                $cong_tien_da_tieu = $username_khach['tongtru'] + $tongtien; //tổng tiền đã tiêu
                $code_order = $result['data']['code_order'];

                // LƯU DỮ LIỆU LỊCH SỬ MUA
                $create = $LTT->insert("history_buy", [
                    'username'      => $username_khach['username'],
                    'type'          => $code_dich_vu,
                    'hinh_thuc' => $type_buy,
                    'soluong'       => $soluong,
                    'tong_tien'     => $tongtien,
                    'link_buy'     => $id,
                    'server_buy'   => $server_buy,
                    'list_msg'     => $list_msg,
                    'status'        => 'Start',
                    'ghichu' => $ghichu,
                    'ma_gd'         => $code_order,
                    'date'          => gettime(),
                    'url_config'          => $url_site_name
                ]);

                if ($create) {

                    // GỬI THÔNG BÁO ĐƠN VỀ TELEGRAM
                    apitele('
' . $LTT->site("ten_website") . ' 
THÔNG BÁO MỚI
Đơn Mua Dịch Vụ: ' . strtoupper($code_dich_vu) . '
Tài Khoản: ' . $username_khach['username'] . ' 
ID Buy: ' . $id . '
Số Lượng: ' . $soluong . '
Tổng Tiền: ' . number_format($tongtien) . 'đ
               ');

                    //TIẾN HÀNH TRỪ TIỀN
                    $update = $LTT->update("users", [
                        'money' => $tru_tien_mua,
                        'tongtru' => $cong_tien_da_tieu
                    ], " `username` = '" . $username_khach['username'] . "'  AND  `url_config` = '" . $url_site_name . "'");
                    // LƯU LỊCH SỬ GIAO DỊCH CỦA THÀNH VIÊN  
                    if ($update) {
                        $ghilog = $LTT->insert("log_site", [
                            'username' => $username_khach['username'],
                            'note'          => ' Đã Tạo Giao Dịch ' . $action . ' Với Số Tiền ' . $tongtien . '',
                            'ip'            => getip(),
                            'date'          => gettime(),
                            'url_config'          => $url_site_name
                        ]);

                        $return['status'] = true;
                        $return['code_order'] = $code_order;
                        $return['message']   = "Thêm đơn thành công !";
                        die(json_encode($return));
                    } else {
                        $return['status'] = false;
                        $return['message']   = "Lỗi hệ thống";
                        die(json_encode($return));
                    }
                } else {
                    $return['status'] = false;
                    $return['message']   = "Lỗi hệ thống";
                    die(json_encode($return));
                }
            }
            // THÔNG BÁO XẢY LỖI TRONG CODE
            else {
                $return['status'] = false;
                $return['message']   = "Hệ thống đã xảy ra lỗi !";
                die(json_encode($return));
            }
        } elseif ($LTT->check('trang_thai_auto') == "OFF") {

            // TẠO CÁC THAM SỐ TIỀN HÀNH TRỪ TIỀN 
            $tru_tien_mua = $username_khach['money'] - $tongtien; // trừ tiền
            $cong_tien_da_tieu = $username_khach['tongtru'] + $tongtien; //tổng tiền đã tiêu
            $code_order = $result['data']['code_order'];

            // LƯU DỮ LIỆU LỊCH SỬ MUA
            $create = $LTT->insert("history_buy", [
                'username'      => $username_khach['username'],
                'type'          => $code_dich_vu,
                'hinh_thuc' => $type_buy,
                'soluong'       => $soluong,
                'tong_tien'     => $tongtien,
                'link_buy'     => $id,
                'server_buy'   => $server_buy,
                'list_msg'     => $list_msg,
                'status'        => 'Pendding',
                'ghichu' => $ghichu,
                'ma_gd'         => $code_order,
                'date'          => gettime(),
                'url_config'          => $url_site_name
            ]);

            if ($create) {

                // GỬI THÔNG BÁO ĐƠN VỀ TELEGRAM
                apitele('
' . $LTT->site("ten_website") . ' 
THÔNG BÁO MỚI
Đơn Mua Dịch Vụ: ' . strtoupper($code_dich_vu) . '
Tài Khoản: ' . $username_khach['username'] . ' 
ID Buy: ' . $id . '
Số Lượng: ' . $soluong . '
Tổng Tiền: ' . number_format($tongtien) . 'đ
               ');

                //TIẾN HÀNH TRỪ TIỀN
                $update = $LTT->update("users", [
                    'money' => $tru_tien_mua,
                    'tongtru' => $cong_tien_da_tieu
                ], " `username` = '" . $username_khach['username'] . "'   AND  `url_config` = '" . $url_site_name . "'");
                // LƯU LỊCH SỬ GIAO DỊCH CỦA THÀNH VIÊN  
                if ($update) {
                    $ghilog = $LTT->insert("log_site", [
                        'username' => $username_khach['username'],
                        'note'          => ' Đã Tạo Giao Dịch ' . $action . ' Với Số Tiền ' . $tongtien . '',
                        'ip'            => getip(),
                        'date'          => gettime(),
                        'url_config'          => $url_site_name
                    ]);

                    $return['status'] = true;
                    $return['code_order'] = $code_order;
                    $return['message']   = "Thêm đơn thành công !";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['message']   = "Lỗi hệ thống";
                    die(json_encode($return));
                }
            } else {
                $return['status'] = false;
                $return['message']   = "Lỗi hệ thống";
                die(json_encode($return));
            }
        } else {
            $return['status'] = false;
            $return['message']   = "Lỗi hệ thống vui lòng báo Admin !";
            die(json_encode($return));
        }
    } else {

        $get_site = $LTT->get_row(" SELECT * FROM `ds_sitecon` WHERE `site_con` = '$url_site_name'");
        $get_dv_site_me = $LTT->get_row(" SELECT * FROM `server_service` WHERE `url_config` = '" . $get_site['site_me'] . "'");
        if (!$get_dv_site_me) {


            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Hệ thống chưa cập nhật vui lòng liên hệ admin !";
            die(json_encode($return));
        }
        $get_status_site_me = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config` = '" . $get_site['site_me'] . "'");
        if ($get_status_site_me['bao_tri'] == "OFF") {


            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Hệ thống đang bảo trì vui lòng liên hệ admin !";
            die(json_encode($return));
        }


        $username_khach = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "'
");

        $get_status_site_con = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config` = '" . $url_site_name . "'");
        $username_admin = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '" . $get_status_site_con['token_auto_dvfb'] . "'  AND  `url_config` = '" . $get_site['site_me'] . "'
");

        if ($get_status_site_con['token_auto_dvfb'] !== $get_site['token']) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "API_Token_Site Chưa Được Cập Nhật !";
            die(json_encode($return));
        }

        if (!$username_khach) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "API Token không hợp lệ";
            die(json_encode($return));
        }
        //LẤY GIÁ DỊCH VỤ
        $gia_dich_vu = $LTT->get_row("SELECT * FROM `server_service` WHERE `code_service` = '$code_dich_vu' AND `status_service` = '1' AND `server_service` = '$server_buy' AND  `url_config` = '" . $url_site_name . "'");
        $package = $gia_dich_vu['server_name'];
        $gia_dich_vu_site_me = $LTT->get_row("SELECT * FROM `server_service` WHERE `code_service` = '$code_dich_vu' AND `status_service` = '1' AND `server_service` = '$server_buy' AND  `url_config` = '" . $get_site['site_me'] . "'");
        $check_site_me_config = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config` = '" . $get_site['site_me'] . "'   ");

        if ($username_admin['capbac'] == 0) {
            $chiet_khau_auto = $check_site_me_config['ck_user'];
        } elseif ($username_admin['capbac'] == 1) {
            $chiet_khau_auto = $check_site_me_config['ck_ctv'];
        } elseif ($username_admin['capbac'] == 2) {
            $chiet_khau_auto = $check_site_me_config['ck_dl'];
        } elseif ($username_admin['capbac'] == 3) {
            $chiet_khau_auto = $check_site_me_config['ck_npp'];
        } elseif ($username_admin['capbac'] == 99) {
            $chiet_khau_auto = 0;
        }
        $ratesv = $gia_dich_vu['rate_service'] + $gia_dich_vu['rate_service'] * $chietkhau / 100;
        $ratesv_site_me = $gia_dich_vu_site_me['rate_service'] + $gia_dich_vu_site_me['rate_service'] * $chiet_khau_auto / 100;


        if ($action == "mat-live") {
            if ($lam_tron == "ON") {
                $tongtien_site_me = ceil($ratesv_site_me) * $soluong * $time_buy;

                $tongtien = ceil($ratesv) * $soluong * $time_buy;
            } else {
                $tongtien = $ratesv * $soluong * $time_buy;
                $tongtien_site_me = $ratesv_site_me * $soluong * $time_buy;
            }
        } else {
            if ($lam_tron == "ON") {
                $tongtien_site_me = ceil($ratesv_site_me) * $soluong;
                $tongtien = ceil($ratesv) * $soluong;
            } else {
                $tongtien = $ratesv * $soluong;
                $tongtien_site_me = $ratesv_site_me * $soluong;
            }
        }

        if ($username_admin['money'] < $tongtien) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Tài nguyên đã hết vui lòng báo Admin !";
            die(json_encode($return));
        }

        if ($username_khach['money'] < $tongtien) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message'] = 'Số tiền của bạn không đủ để thực hiện giao dịch này';
            die(json_encode($return));
        }
        $type_buy = 'Site Auto';
        $get_site_mee = $LTT->get_row(" SELECT * FROM `ds_sitecon` WHERE `site_con` = '" . $get_site['site_me'] . "'");

        if ($get_site_mee) {
            $mien_site_me = $get_site_mee['site_me'];
            $mien_site_con = $get_site['site_me'];
            $mien_site_me_thuong = strtolower($get_site_mee['site_me']);
            $url_post = "https://$mien_site_me_thuong/auth/service/youtube/site_con.php?id=$id&soluong=$soluong&server=$server_buy&code_dich_vu=$code_dich_vu&action=$action&loai_camxuc=$loai_camxuc&time_buy=$time_buy&list_msg=$list_msg&domain_site_con=$mien_site_con&domain_site_me=$mien_site_me";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_ENCODING, true);
            $buy_text = curl_exec($ch);
            curl_close($ch);
            $json_text = json_decode($buy_text, true);
            if ($json_text['code'] == "400") {
                $return['status'] = false;
                $return['message']   = "Tài Nguyên Website Đã Hết Vui Lòng Báo ADMIN";
                die(json_encode($return));
            } elseif ($json_text['code'] == "401") {
                $return['status'] = false;
                $return['message']   = "Đã xảy ra lỗi !";
                die(json_encode($return));
            } elseif ($json_text['code'] == "405") {
                $return['status'] = false;
                $return['message']   = "Hệ đang bảo trì vui lòng báo admin !";
                die(json_encode($return));
            }

            if ($json_text['code'] == "1") {
            }
        }
        //CURL _ NGUỒN DỊCH VỤ

        if ($LTT->check('trang_thai_auto') == "ON") {
            $post_data = [
                'link_story' => $id,
                'idgroup' => $id,
                'idpage' => $id,
                'idfb' => $id,
                'idcomment' => $id,
                'idpost' => $id,
                'link_post' => $id,
                'link_video' => $id,
                'speed' => $speed,
                'time' => $speed,
                'comment' => $list_msg,
                'server_order' => 'sv' . $server_buy,
                'reaction' => $loai_camxuc,
                'amount' => $soluong,
                'minutes' =>   $time_buy,
                'note' => $ghichu
            ];
            $head =
                array(
                    'api-token: ' . $token_auto_dvfb,
                    'Content-Type: application/json'


                );

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://thuycute.hoangvanlinh.vn/' . $link_post,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($post_data),
                CURLOPT_HTTPHEADER => $head,
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response, true);
            $result_text = $result['status'];

            if ($result_text == false) {
                $return['status'] = false;
                $return['message']   = $result['message'];
                die(json_encode($return));
            }
            $number_star = $result['data']['start'];
            // KẾT THÚC CURL VÀ XỬ LÝ DỮ LIỆU

            $result_text = $result['status'];
            $number_star = $result['data']['start'];

            // TRẢ KẾT QUẢ KHÔNG ĐỦ TIỀN 400
            if ($result_text == false) {
                $return['status'] = false;
                $return['message']   = $result['message'];
                die(json_encode($return));
            }
            // TRẢ KẾT QUẢ THÀNH CÔNG VÀ TIỀN HÀNH LƯU DATA
            elseif ($result_text == true) {
                // TẠO CÁC THAM SỐ TIỀN HÀNH TRỪ TIỀN 
                $tru_tien_mua = $username_khach['money'] - $tongtien; // trừ tiền thành viên
                $tru_tien_mua_admin = $username_admin['money'] - $tongtien_site_me; // trừ tiền chủ site
                $cong_tien_da_tieu = $username_khach['tongtru'] + $tongtien; //tổng tiền đã tiêu thành viên
                $cong_tien_da_tieu_admin = $username_admin['tongtru'] + $tongtien_site_me; //tổng tiền đã tiêu thành viên
                $code_order = $result['data']['code_order'];

                // LƯU DỮ LIỆU LỊCH SỬ MUA
                $create = $LTT->insert("history_buy", [
                    'username'      => $username_khach['username'],
                    'type'          => $code_dich_vu,
                    'hinh_thuc' => $type_buy,
                    'soluong'       => $soluong,
                    'tong_tien'     => $tongtien,
                    'link_buy'     => $id,
                    'server_buy'   => $server_buy,
                    'list_msg'     => $list_msg,
                    'status'        => 'Start',
                    'time_buy' => $time_buy, 'ghichu' => $ghichu,
                    'number_star' => $number_star,
                    'ma_gd'         => $code_order,
                    'date'          => gettime(),
                    'url_config'          => $url_site_name
                ]);
                $create_ls_site = $LTT->insert("history_buy", [
                    'username'      => $get_site['username'],
                    'type'          => $code_dich_vu,
                    'hinh_thuc' => $type_buy,
                    'soluong'       => $soluong,
                    'tong_tien'     => $tongtien_site_me,
                    'link_buy'     => $id, 'ghichu' => $ghichu,
                    'number_star' => $number_star,
                    'server_buy'   => $server_buy,
                    'list_msg'     => $list_msg,
                    'status'        => 'Start',
                    'time_buy' => $time_buy,
                    'ma_gd'         => $code_order,
                    'date'          => gettime(),
                    'url_config'          => $get_site['site_me']
                ]);
                if ($create) {

                    // GỬI THÔNG BÁO ĐƠN VỀ TELEGRAM
                    apitele('
' . $LTT->site("ten_website") . ' 
THÔNG BÁO MỚI
Đơn Mua Dịch Vụ: ' . strtoupper($code_dich_vu) . '
Tài Khoản: ' . $username_khach['username'] . ' 
ID Buy: ' . $id . '
Số Lượng: ' . $soluong . '
Tổng Tiền: ' . number_format($tongtien) . 'đ
               ');
                    apitelegram('
' . $get_status_site_me["ten_website"] . ' 
THÔNG BÁO MỚI
Đơn Mua Dịch Vụ: ' . strtoupper($code_dich_vu) . '
Tài Khoản: ' . $username_khach['username'] . ' 
ID Buy: ' . $id . '
Số Lượng: ' . $soluong . '
Tổng Tiền: ' . number_format($tongtien_site_me) . 'đ
               ', $get_status_site_me['bot_tele'], $get_status_site_me['id_chat_tele']);
                    //TIẾN HÀNH TRỪ TIỀN
                    $update = $LTT->update("users", [
                        'money' => $tru_tien_mua,
                        'tongtru' => $cong_tien_da_tieu
                    ], " `username` = '" . $username_khach['username'] . "'  AND  `url_config` = '" . $url_site_name . "'");
                    $update_site = $LTT->update("users", [
                        'money' => $tru_tien_mua_admin,
                        'tongtru' => $cong_tien_da_tieu_admin
                    ], " `username` = '" . $get_site['username'] . "'  AND  `url_config` = '" . $get_site['site_me'] . "'");
                    // LƯU LỊCH SỬ GIAO DỊCH CỦA THÀNH VIÊN  
                    if ($update) {
                        $ghilog = $LTT->insert("log_site", [
                            'username' => $username_khach['username'],
                            'note'          => 'Đã Tạo Giao Dịch ' . $action . ' Với Số Tiền ' . $tongtien . '',
                            'ip'            => getip(),
                            'date'          => gettime(),
                            'url_config'          => $url_site_name
                        ]);
                        $ghilog_site = $LTT->insert("log_site", [
                            'username' => $get_site['username'],
                            'note'          => ' Đã Tạo Giao Dịch ' . $action . ' Với Số Tiền ' . $tongtien_site_me . '',
                            'ip'            => getip(),
                            'date'          => gettime(),
                            'url_config'          => $get_site['site_me']
                        ]);







                        $return['status'] = true;
                        $return['code_order'] = $code_order;
                        $return['message']   = "Thêm đơn thành công !";
                        die(json_encode($return));
                    } else {
                        $return['status'] = false;
                        $return['message']   = "Lỗi hệ thống";
                        die(json_encode($return));
                    }
                } else {
                    $return['status'] = false;
                    $return['message']   = "Lỗi hệ thống";
                    die(json_encode($return));
                }
            }
            // THÔNG BÁO XẢY LỖI TRONG CODE
            else {
                $return['status'] = false;
                $return['message']   = "Hệ thống đã xảy ra lỗi !";
                die(json_encode($return));
            }
        } elseif ($LTT->check('trang_thai_auto') == "OFF") {

            // TẠO CÁC THAM SỐ TIỀN HÀNH TRỪ TIỀN 
            $tru_tien_mua = $username_khach['money'] - $tongtien; // trừ tiền thành viên
            $tru_tien_mua_admin = $username_admin['money'] - $tongtien_site_me; // trừ tiền chủ site
            $cong_tien_da_tieu = $username_khach['tongtru'] + $tongtien; //tổng tiền đã tiêu thành viên
            $cong_tien_da_tieu_admin = $username_admin['tongtru'] + $tongtien_site_me; //tổng tiền đã tiêu thành viên
            $code_order = $result['data']['code_order'];

            // LƯU DỮ LIỆU LỊCH SỬ MUA
            $create = $LTT->insert("history_buy", [
                'username'      => $username_khach['username'],
                'type'          => $code_dich_vu,
                'hinh_thuc' => 'Login Website',
                'soluong'       => $soluong,
                'tong_tien'     => $tongtien,
                'link_buy'     => $id,
                'server_buy'   => $server_buy,
                'list_msg'     => $list_msg,
                'status'        => 'Pendding', 'ghichu' => $ghichu,
                'time_buy' => $time_buy,
                'number_star' => $number_star,
                'ma_gd'         => $code_order,
                'date'          => gettime(),
                'url_config'          => $url_site_name
            ]);
            $create23 = $LTT->insert("history_buy", [
                'username'      => $get_site['username'],
                'type'          => $code_dich_vu,
                'hinh_thuc' => $type_buy,
                'soluong'       => $soluong,
                'tong_tien'     => $tongtien_site_me,
                'link_buy'     => $id, 'ghichu' => $ghichu,
                'server_buy'   => $server_buy,
                'list_msg'     => $list_msg,
                'status'        => 'Pendding',
                'time_buy' => $time_buy,
                'number_star' => $number_star,
                'ma_gd'         => $code_order,
                'date'          => gettime(),
                'url_config'          =>  $get_site['site_me']
            ]);

            if ($create) {

                // GỬI THÔNG BÁO ĐƠN VỀ TELEGRAM
                apitele('
' . $LTT->site("ten_website") . ' 
THÔNG BÁO MỚI
Đơn Mua Dịch Vụ: ' . strtoupper($code_dich_vu) . '
Tài Khoản: ' . $username_khach['username'] . ' 
ID Buy: ' . $id . '
Số Lượng: ' . $soluong . '
Tổng Tiền: ' . number_format($tongtien) . 'đ
               ');
                apitelegram('
' . $get_status_site_me["ten_website"] . ' 
THÔNG BÁO MỚI
Đơn Mua Dịch Vụ: ' . strtoupper($code_dich_vu) . '
Tài Khoản: ' . $username_khach['username'] . ' 
ID Buy: ' . $id . '
Số Lượng: ' . $soluong . '
Tổng Tiền: ' . number_format($tongtien_site_me) . 'đ
               ', $get_status_site_me['bot_tele'], $get_status_site_me['id_chat_tele']);
                //TIẾN HÀNH TRỪ TIỀN
                $update = $LTT->update("users", [
                    'money' => $tru_tien_mua,
                    'tongtru' => $cong_tien_da_tieu
                ], " `username` = '" . $username_khach['username'] . "'   AND  `url_config` = '" . $url_site_name . "'");
                $update_site23 = $LTT->update("users", [
                    'money' => $tru_tien_mua_admin,
                    'tongtru' => $cong_tien_da_tieu_admin
                ], " `username` = '" . $get_site['username'] . "'   AND  `url_config` = '" . $get_site['site_me'] . "'");
                // LƯU LỊCH SỬ GIAO DỊCH CỦA THÀNH VIÊN  
                if ($update) {
                    $ghilog = $LTT->insert("log_site", [
                        'username' =>  $username_khach['username'],
                        'note'          => ' Đã Tạo Giao Dịch ' . $action . ' Với Số Tiền ' . $tongtien . '',
                        'ip'            => getip(),
                        'date'          => gettime(),
                        'url_config'          => $url_site_name
                    ]);
                    $ghilog23 = $LTT->insert("log_site", [
                        'username' =>  $get_site['username'],
                        'note'          => ' Đã Tạo Giao Dịch ' . $action . ' Với Số Tiền ' . $tongtien_site_me . '',
                        'ip'            => getip(),
                        'date'          => gettime(),
                        'url_config'          => $get_site['site_me']
                    ]);
                    $return['status'] = true;
                    $return['code_order'] = $code_order;
                    $return['message']   = "Thêm đơn thành công !";
                    die(json_encode($return));
                } else {
                    $return['status'] = false;
                    $return['message']   = "Lỗi hệ thống";
                    die(json_encode($return));
                }
            } else {
                $return['status'] = false;
                $return['message']   = "Lỗi hệ thống";
                die(json_encode($return));
            }
        } else {
            $return['status'] = false;
            $return['message']   = "Lỗi hệ thống vui lòng báo Admin !";
            die(json_encode($return));
        }
    }
}
