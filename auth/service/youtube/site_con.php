<?php require('../../../config/function.php');


if (!isset($_GET['domain_site_con']) || !isset($_GET['domain_site_me'])) {
  $return['code']   = "401";
  die(json_encode($return));
} else {
  $code_dich_vu = $_GET['code_dich_vu'];
  $action    = $_GET['action'];
  $loai_camxuc      = $_GET['loai_camxuc'];
  $time_buy      = $_GET['time_buy'];
  $list_msg      = $_GET['list_msg'];
  $id      = $_GET['id'];
  $soluong         = $_GET['soluong'];
  $server_buy   = $_GET['server'];
  $domain_site_con   = $_GET['domain_site_con'];
  $domain_site_me   = $_GET['domain_site_me'];

  if ($url_site_name == $domain_site_me) {

    $check_ds_site = $LTT->get_row("SELECT * FROM `ds_sitecon` WHERE `site_con` = '$domain_site_con' AND `site_me` = '$domain_site_me' AND `status` = 'Active'");
    $username_site_con = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '" . $check_ds_site['token'] . "'  AND  `url_config` = '" . $domain_site_me . "'
");

    $check_site_me_config = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config` = '" . $domain_site_me . "'   ");
    if ($check_site_me_config['bao_tri'] == "OFF") {

      $return['code']   = "405";
      die(json_encode($return));
    }
    if ($username_site_con['capbac'] == 0) {
      $chiet_khau_auto = $check_site_me_config['ck_user'];
    } elseif ($username_site_con['capbac'] == 1) {
      $chiet_khau_auto = $check_site_me_config['ck_ctv'];
    } elseif ($username_site_con['capbac'] == 2) {
      $chiet_khau_auto = $check_site_me_config['ck_dl'];
    } elseif ($username_site_con['capbac'] == 3) {
      $chiet_khau_auto = $check_site_me_config['ck_npp'];
    } elseif ($username_site_con['capbac'] == 99) {
      $chiet_khau_auto = 0;
    }
    $gia_dich_vu = $LTT->get_row("SELECT * FROM `server_service` WHERE `code_service` = '$code_dich_vu' AND `status_service` = '1' AND `server_service` = '$server_buy'");
    $ratesv = $gia_dich_vu['rate_service'] + $gia_dich_vu['rate_service'] * $chiet_khau_auto / 100;
    if ($lam_tron == "ON") {

      $tongtien = ceil($ratesv) * $soluong;
    } else {
      $tongtien = $ratesv * $soluong;
    }

    if ($username_site_con['money'] < $tongtien) {

      $return['code']   = "400";
      die(json_encode($return));
    } else {

      //

      $get_site_me_3 = $LTT->get_row(" SELECT * FROM `ds_sitecon` WHERE `site_con` = '" . $domain_site_me . "'");

      if ($get_site_me_3) {
        $dm_site_me = $get_site_me_3['site_me'];
        $dm_site_con = $domain_site_me;
        $mien_site_me_thuong = strtolower($dm_site_me);
        $url_get = "https://$mien_site_me_thuong/auth/service/youtube/site_con.php?id=$id&soluong=$soluong&server=$server_buy&code_dich_vu=$code_dich_vu&action=$action&loai_camxuc=$loai_camxuc&time_buy=$time_buy&list_msg=$list_msg&domain_site_con=$dm_site_con&domain_site_me=$dm_site_me";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_get);
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
          $return['code']   = "400";
          die(json_encode($return));
        } elseif ($json_text['code'] == "405") {
          $return['code']   = "405";
          die(json_encode($return));
        } elseif ($json_text['code'] == "401") {
          $return['code']   = "401";
          die(json_encode($return));
        }
        if ($json_text['code'] == "1") {
        }
      }


      //
      $tru_tien_mua = $username_site_con['money'] - $tongtien; // trừ tiền
      $cong_tien_da_tieu = $username_site_con['tongtru'] + $tongtien; //tổng tiền đã tiêu
      $code_order = 'ID_' . rand(0, 999999);

      $type_buy = "Site Auto";
      if ($LTT->check('trang_thai_auto') == "ON") {
        $trang_thai_don = "Start";
      } elseif ($LTT->check('trang_thai_auto') == "OFF") {
        $trang_thai_don = "Pendding";
      }
      $create = $LTT->insert("history_buy", [
        'username'      => $username_site_con['username'],
        'type'          => $code_dich_vu,
        'hinh_thuc' => $type_buy,
        'soluong'       => $soluong,
        'tong_tien'     => $tongtien,
        'link_buy'     => $id,
        'server_buy'   => $server_buy,
        'list_msg'     => $list_msg,
        'status'        => $trang_thai_don,
        'time_buy' => $time_buy,
        'ma_gd'         => $code_order,
        'date'          => gettime(),
        'url_config'          => $domain_site_me
      ]);
      if ($create) {
        apitele('
' . $LTT->site("ten_website") . ' 
THÔNG BÁO MỚI
Đơn Mua Dịch Vụ: ' . strtoupper($code_dich_vu) . '
Tài Khoản: ' . $username_site_con['username'] . ' 
ID Buy: ' . $id . '
Số Lượng: ' . $soluong . '
Tổng Tiền: ' . number_format($tongtien) . 'đ
               ');
        $update = $LTT->update("users", [
          'money' => $tru_tien_mua,
          'tongtru' => $cong_tien_da_tieu
        ], " `username` = '" . $username_site_con['username'] . "'  AND  `url_config` = '" . $domain_site_me . "'");
        $ghilog = $LTT->insert("log_site", [
          'note'          => $username_site_con['username'] . ' Đã Tạo Giao Dịch ' . $action . ' Với Số Tiền ' . $tongtien . ', Time ' . gettime() . '',
          'ip'            => getip(),
          'date'          => gettime(),
          'url_config'          => $domain_site_me
        ]);

        $return['code']   = "1";
        die(json_encode($return));
      }
    }
  }
}
