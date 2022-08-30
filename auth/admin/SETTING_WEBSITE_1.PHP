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
    if ($action == "set_modal") {
      $stt_nap_the = check_string($_POST['nap_the']);
      $text_nap_the = check_string($_POST['text_nap_the']);

      $stt_like_post = check_string($_POST['like_post']);
      $text_like_post = check_string($_POST['text_like_post']);

      $stt_sub_sale = check_string($_POST['sub_sale']);
      $text_sub_sale = check_string($_POST['text_sub_sale']);

      $stt_cx_post = check_string($_POST['cx_post']);
      $text_cx_post = check_string($_POST['text_cx_post']);

      $stt_cmt = check_string($_POST['cmt']);
      $text_cmt = check_string($_POST['text_cmt']);

      $stt_like_page_sale = check_string($_POST['like_page_sale']);
      $text_like_page_sale = check_string($_POST['text_like_page_sale']);

      $stt_share = check_string($_POST['share']);
      $text_share = check_string($_POST['text_share']);

      $stt_mat_live = check_string($_POST['mat_live']);
      $text_mat_live = check_string($_POST['text_mat_live']);

      $stt_view_video = check_string($_POST['view_video']);
      $text_view_video = check_string($_POST['text_view_video']);

      $stt_like_cmt = check_string($_POST['like_cmt']);
      $text_like_cmt = check_string($_POST['text_like_cmt']);

      $stt_view_story = check_string($_POST['view_story']);
      $text_view_story = check_string($_POST['text_view_story']);

      $stt_mem_gr = check_string($_POST['mem_gr']);
      $text_mem_gr = check_string($_POST['text_mem_gr']);

      $stt_like_ins = check_string($_POST['like_ins']);
      $text_like_ins = check_string($_POST['text_like_ins']);

      $stt_cmt_ins = check_string($_POST['cmt_ins']);
      $text_cmt_ins = check_string($_POST['text_cmt_ins']);

      $stt_sub_ins = check_string($_POST['sub_ins']);
      $text_sub_ins = check_string($_POST['text_sub_ins']);

      $stt_like_tiktok = check_string($_POST['like_tiktok']);
      $text_like_tiktok = check_string($_POST['text_like_tiktok']);

      $stt_cmt_tiktok = check_string($_POST['cmt_tiktok']);
      $text_cmt_tiktok = check_string($_POST['text_cmt_tiktok']);

      $stt_sub_tiktok = check_string($_POST['sub_tiktok']);
      $text_sub_tiktok = check_string($_POST['text_sub_tiktok']);

      $stt_sub_youtube = check_string($_POST['sub_youtube']);
      $text_sub_youtube = check_string($_POST['text_sub_youtube']);

      $stt_like_youtube = check_string($_POST['like_youtube']);
      $text_like_youtube = check_string($_POST['text_like_youtube']);
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




        $tao_modal = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_like_post,
          'status'      => $stt_like_post,
        ], " `url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'like_post' ");



        $tao_modal_2 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_sub_sale,
          'status'      => $stt_sub_sale,
        ], "`url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'sub_sale'  ");


        $tao_modal_3 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_cx_post,
          'status'      => $stt_cx_post,
        ], "`url_config` = '" . $url_site_name . "'  AND  `loai_tb` = 'cx_post'");


        $tao_modal_4 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_cmt,
          'status'      => $stt_cmt,
        ], "`url_config` = '" . $url_site_name . "'  AND  `loai_tb` = 'cmt'");


        $tao_modal_5 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_like_page_sale,
          'status'      => $stt_like_page_sale,
        ], "`url_config` = '" . $url_site_name . "'   AND  `loai_tb` = 'like_page_sale'");


        $tao_modal_6 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_share,
          'status'      => $stt_share,
        ], "`url_config` = '" . $url_site_name . "'   AND  `loai_tb` = 'share'");




        $tao_modal_7 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_mat_live,
          'status'      => $stt_mat_live,
        ], "`url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'mat_live'");


        $tao_modal_8 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_view_video,
          'status'      => $stt_view_video,
        ], "`url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'view_video'");




        $tao_modal_9 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_like_cmt,
          'status'      => $stt_like_cmt,
        ], "`url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'like_cmt'");



        $tao_modal_10 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_view_story,
          'status'      => $stt_view_story,
        ], "`url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'view_story'");



        $tao_modal_11 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_mem_gr,
          'status'      => $stt_mem_gr,
        ], "`url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'mem_gr'");


        $tao_modal_12 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_like_ins,
          'status'      => $stt_like_ins,
        ], "`url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'like_ins'");


        $tao_modal_13 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_cmt_ins,
          'status'      => $stt_cmt_ins,
        ], "`url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'cmt_ins'");


        $tao_modal_14 = $LTT->update(
          "thong_bao_modal",
          [

            'text_thong_bao' => $text_sub_ins,
            'status'      => $stt_sub_ins,
          ],
          "`url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'sub_ins'"
        );



        $tao_modal_15 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_like_tiktok,
          'status'      => $stt_like_tiktok,
        ], "`url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'like_tiktok'");



        $tao_modal_16 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_cmt_tiktok,
          'status'      => $stt_cmt_tiktok,
        ], "`url_config` = '" . $url_site_name . "'  AND  `loai_tb` = 'cmt_tiktok'");

        $tao_modal_17 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_sub_tiktok,
          'status'      => $stt_sub_tiktok,
        ], "`url_config` = '" . $url_site_name . "'  AND  `loai_tb` = 'sub_tiktok'");




        $tao_modal_18 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_sub_youtube,
          'status'      => $stt_sub_youtube,
        ], "`url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'sub_youtube'");

        $tao_modal_19 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_like_youtube,
          'status'      => $stt_like_youtube,
        ], " `url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'like_youtube' ");

        $tao_modal_20 = $LTT->update("thong_bao_modal", [

          'text_thong_bao' => $text_nap_the,
          'status'      => $stt_nap_the,
        ], " `url_config` = '" . $url_site_name . "' AND  `loai_tb` = 'nap_the' ");


        if ($tao_modal || $tao_modal_1 || $tao_modal_2 || $tao_modal_3 || $tao_modal_4 || $tao_modal_5 || $tao_modal_6 || $tao_modal_7 || $tao_modal_8 || $tao_modal_9 || $tao_modal_10 || $tao_modal_11 || $tao_modal_12 || $tao_modal_13 || $tao_modal_14 || $tao_modal_15 || $tao_modal_16 || $tao_modal_17 || $tao_modal_18 || $tao_modal_19 || $tao_modal_20) {
          $return['status'] = true;
          $return['error'] = false;
          $return['message']   = "Thêm Thành Công !";
          die(json_encode($return));
        } else {
          $return['status'] = false;

          $return['message']   = "Lỗi Hệ THống !";
          die(json_encode($return));
        }
      }
    }


    if ($action == "set_them_model") {
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





        $tao_modal = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'like_post',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);

        $tao_modal2 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'sub_sale',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);

        $tao_modal3 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'cx_post',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);

        $tao_modal4 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'cmt',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);

        $tao_modal5 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'like_page_sale',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);

        $tao_modal6 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'share',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);



        $tao_modal7 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'mat_live',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);

        $tao_modal8 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'view_video',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);



        $tao_modal9 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'like_cmt',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);


        $tao_modal10 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'view_story',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);


        $tao_modal11 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'mem_gr',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);

        $tao_modal12 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'like_ins',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);

        $tao_modal13 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'cmt_ins',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);

        $tao_modal14 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'sub_ins',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);


        $tao_modal15 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'like_tiktok',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);


        $tao_modal16 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'cmt_tiktok',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);
        $tao_modal17 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'sub_tiktok',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);



        $tao_modal18 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'sub_youtube',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);
        $tao_modal19 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'like_youtube',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);
        $tao_modal20 = $LTT->insert("thong_bao_modal", [
          'loai_tb'      => 'nap_the',
          'text_thong_bao' => '',
          'status'      => 'OFF',
          'url_config'          => $url_site_name
        ]);

        if ($tao_modal || $tao_modal1 || $tao_modal2 || $tao_modal3 || $tao_modal4 || $tao_modal5 || $tao_modal6 || $tao_modal7 || $tao_modal8 || $tao_modal9 || $tao_modal10 || $tao_modal11 || $tao_modal12 || $tao_modal13 || $tao_modal14 || $tao_modal15 || $tao_modal16 || $tao_modal17 || $tao_modal18 || $tao_modal19 || $tao_modal20) {
          $return['status'] = true;
          $return['error'] = false;
          $return['message']   = "Thêm Thành Công !";
          die(json_encode($return));
        } else {
          $return['status'] = false;

          $return['message']   = "Lỗi Hệ THống !";
          die(json_encode($return));
        }
      }
    }
  }
