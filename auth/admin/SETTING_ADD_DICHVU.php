 <?php require('../../config/function.php');

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
    $action            = check_string($_POST['action']);
    if ($action == "set_auto_dv") {
      $api_token = api_token();
      $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $url_site_name . "' ");

      $check_site = $LTT->get_row(" SELECT * FROM `ds_sitecon` WHERE `site_con` = '$url_site_name'   ");
      $check_site_config = $LTT->get_row(" SELECT * FROM `setting` WHERE `url_config` = '" . $check_site['site_me'] . "'   ");
      $check_user_site_me = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '" . $check_site['site_me'] . "' ");


      if ($check_user_site_me['capbac'] == 0) {
        $chiet_khau_auto = $check_site_config['ck_user'];
      } elseif ($check_user_site_me['capbac'] == 1) {
        $chiet_khau_auto = $check_site_config['ck_ctv'];
      } elseif ($check_user_site_me['capbac'] == 2) {
        $chiet_khau_auto = $check_site_config['ck_dl'];
      } elseif ($check_user_site_me['capbac'] == 3) {
        $chiet_khau_auto = $check_site_config['ck_npp'];
      } elseif ($check_user_site_me['capbac'] == 99) {
        $chiet_khau_auto = 0;
      }

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
        $return['message']   = "Bạn không phải là admin !";
        die(json_encode($return));
      }
      $get_site2 = $LTT->get_row(" SELECT * FROM `ds_sitecon` WHERE `site_con` = '" . $url_site_name . "'");

      $gia = $LTT->query("SELECT * FROM `server_service` WHERE `status_service` = '1' AND  `url_config` = '" . $get_site2['site_me'] . "' ");
      while($h = mysqli_fetch_array($gia)){
          $chiet_khau = $h['rate_service'] + $h['rate_service'] * $chiet_khau_auto / 100;
          $data = array(
            'code_service'      => $h['code_service'],
            'server_service'          => $h['server_service'],
            'rate_service'      => $chiet_khau,
            'title_service'         => $h['title_service'],
            'status_service'        => 1,
            'server_name' => $h['server_name'],
            'url_config'          => $url_site_name,
          );
          $insert = $LTT->insert("server_service",$data);
        }
      $return['status'] = true;
      $return['error'] = false;
      $return['message']   = "Thêm dịch vụ thành công !";
      die(json_encode($return));
    }
    if ($action == "set_xoa_dv") {

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
        $return['message']   = "Bạn không phải là admin !";
        die(json_encode($return));
      }
      $get_dv2 = $LTT->get_row(" SELECT * FROM `server_service` WHERE `url_config` = '" . $url_site_name . "'");
      if (!$get_dv2) {
        $return['status'] = false;
        $return['error'] = false;
        $return['message']   = "Không Tồn Tại Dịch Vụ !";
        die(json_encode($return));
      } else {
        $xoa_dv = $LTT->remove("server_service", "`status_service` = '1'  AND  `url_config` = '" . $url_site_name . "' ");
        if ($xoa_dv) {
          $return['status'] = true;
          $return['error'] = false;
          $return['message']   = "Xoá Dịch Vụ Thành Công !";
          die(json_encode($return));
        }
      }
    }
  }
