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

    $NetworkCode        = check_string($_POST['NetworkCode']);
    $PricesExchange     = check_string($_POST['PricesExchange']);
    $SeriCard           = check_string($_POST['SeriCard']);
    $NumberCard         = check_string($_POST['NumberCard']);

    $api_token = api_token();
    $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token' ");

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

    if (empty($NetworkCode)) {
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Bạn chưa chọn loại thẻ";
        die(json_encode($return));
    } else {
        if (empty($PricesExchange)) {
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "Bạn chưa chọn mệnh giá";
            die(json_encode($return));
        } else {
            if (empty($SeriCard)) {
                $return['status'] = false;
                $return['error'] = true;
                $return['message']   = "Vui lòng nhập số seri";
                die(json_encode($return));
            } else {
                if (empty($NumberCard)) {
                    $return['status'] = false;
                    $return['error'] = true;
                    $return['message']   = "Vui lòng nhập mã số thẻ";
                    die(json_encode($return));
                } else {
                    $tranid = rand(100000000, 999999999);




                    if ($LTT->site('site_napthe') == 'trumgachthe') {
                        $data = array(
                            'telco' => $NetworkCode,
                            'code' => $NumberCard,
                            'serial' => $SeriCard,
                            'amount' => $PricesExchange,
                            'request_id' => $tranid,
                            'partner_id' => $LTT->site('partner_id'),
                            'sign' => md5($LTT->site('partner_key') . $NumberCard . $SeriCard),
                            'command' => 'charging'
                        );
                        $head =  array(
                            'Content-Type: application/json'
                        );

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "https://trumgachthe.net/chargingws/v2");
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_ENCODING, true);
                        $login_data = curl_exec($ch);
                        curl_close($ch);
                        $result_trumgachthe = json_decode($login_data, true);
                        if ($result_trumgachthe['status'] == 99) {
                            $create = $LTT->insert("history_naptien", [
                                'type'          => 'napthe',
                                'username'      => $checkusite['username'],
                                'loaithe'       => $NetworkCode,
                                'menhgia'       => $PricesExchange,
                                'sothe'         => $NumberCard,
                                'soseri'        => $SeriCard,
                                'thucnhan'      => 0,
                                'trangthai'     => 0,
                                'date'          => gettime(),
                                'tranid'        => $tranid,
                                'url_config'          => $url_site_name
                            ]);

                            if ($create) {
                                $ghilog = $LTT->insert("log_site", [
                                    'username' => $checkusite['username'],
                                    'note'          => ' Vừa nạp thẻ ' . $NetworkCode . ' với mệnh giá ' . $tongtien . ' vào lúc ' . gettime() . '',
                                    'ip'            => getip(),
                                    'date'          => gettime(),
                                    'url_config'          => $url_site_name
                                ]);
                                $return['status']    = true;
                                $return['error']     = false;
                                $return['tranid']    = $tranid;
                                $return['message']   = "Nạp thẻ thành công";
                                die(json_encode($return));
                            } else {
                                $return['status'] = false;
                                $return['error'] = true;
                                $return['message']   = "Lỗi hệ thống";
                                die(json_encode($return));
                            }
                        } else {
                            $return['status'] = false;
                            $return['error'] = true;
                            $return['message']   = $result_trumgachthe['message'];
                            die(json_encode($return));
                        }
                    }

                    if ($LTT->site('site_napthe') == 'gachthe1s') {
                        $data = [
                            'telco' => $NetworkCode,
                            'code' => $NumberCard,
                            'serial' => $SeriCard,
                            'amount' => $PricesExchange,
                            'request_id' => $tranid,
                            'partner_id' => $LTT->site('partner_id'),
                            'sign' => md5($LTT->site('partner_key') . $NumberCard . $SeriCard),
                            'command' => 'charging'
                        ];
                        $head =  array(
                            'Content-Type: application/json'
                        );

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "https://gachthe1s.com/chargingws/v2");
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                        curl_setopt($ch, CURLOPT_ENCODING, true);
                        $login_data = curl_exec($ch);
                        curl_close($ch);
                        $result_gachthe1s = json_decode($login_data, true);
                        if ($result_gachthe1s['status'] == 99) {
                            $create = $LTT->insert("history_naptien", [
                                'type'          => 'napthe',
                                'username'      => $checkusite['username'],
                                'loaithe'       => $NetworkCode,
                                'menhgia'       => $PricesExchange,
                                'sothe'         => $NumberCard,
                                'soseri'        => $SeriCard,
                                'thucnhan'      => 0,
                                'trangthai'     => 0,
                                'date'          => gettime(),
                                'tranid'        => $tranid,
                                'url_config'          => $url_site_name
                            ]);

                            if ($create) {
                                $ghilog = $LTT->insert("log_site", [
                                    'username' => $checkusite['username'],
                                    'note'          => ' Vừa nạp thẻ ' . $NetworkCode . ' với mệnh giá ' . $tongtien . ' vào lúc ' . gettime() . '',
                                    'ip'            => getip(),
                                    'date'          => gettime(),
                                    'url_config'          => $url_site_name
                                ]);
                                $return['status']    = true;
                                $return['error']     = false;
                                $return['tranid']    = $tranid;
                                $return['message']   = "Nạp thẻ thành công";
                                die(json_encode($return));
                            } else {
                                $return['status'] = false;
                                $return['error'] = true;
                                $return['message']   = "Lỗi hệ thống";
                                die(json_encode($return));
                            }
                        } else {
                            $return['status'] = false;
                            $return['error'] = true;
                            $return['message']   = $result_gachthe1s['message'];
                            die(json_encode($return));
                        }
                    }
                    if ($LTT->site('site_napthe') == 'thesieure') {
                        $resultthesieure = thesieure($NetworkCode, $PricesExchange, $NumberCard, $SeriCard, $tranid, $LTT->site('partner_id'), $LTT->site('partner_key'));
                        if ($resultthesieure['status'] == 99) {
                            $create = $LTT->insert("history_naptien", [
                                'type'          => 'napthe',
                                'username'      => $checkusite['username'],
                                'loaithe'       => $NetworkCode,
                                'menhgia'       => $PricesExchange,
                                'sothe'         => $NumberCard,
                                'soseri'        => $SeriCard,
                                'thucnhan'      => 0,
                                'trangthai'     => 0,
                                'date'          => gettime(),
                                'tranid'        => $tranid,
                                'url_config'          => $url_site_name
                            ]);

                            if ($create) {
                                $ghilog = $LTT->insert("log_site", [
                                    'username' => $checkusite['username'],
                                    'note'          => ' Vừa nạp thẻ ' . $NetworkCode . ' với mệnh giá ' . $tongtien . ' vào lúc ' . gettime() . '',
                                    'ip'            => getip(),
                                    'date'          => gettime(),
                                    'url_config'          => $url_site_name
                                ]);
                                $return['status']    = true;
                                $return['error']     = false;
                                $return['tranid']    = $tranid;
                                $return['message']   = "Nạp thẻ thành công";
                                die(json_encode($return));
                            } else {
                                $return['status'] = false;
                                $return['error'] = true;
                                $return['message']   = "Lỗi hệ thống";
                                die(json_encode($return));
                            }
                        } else {
                            $return['status'] = false;
                            $return['error'] = true;
                            $return['message']   = $resultthesieure['message'];
                            die(json_encode($return));
                        }
                    }
                    if ($LTT->site('site_napthe') == 'thesieuviet') {

                        if ($NetworkCode == 'VNMOBI' || $NetworkCode == 'vietnamobile' || $NetworkCode == 'VIETNAMOBILE') {
                            $loaithe = 'Vietnamobile';
                        }
                        if ($NetworkCode == 'VIETTEL' || $NetworkCode == 'Viettel ') {
                            $loaithe = 'Viettel';
                        }
                        if ($NetworkCode == 'MOBIFONE' || $NetworkCode == 'Mobifone') {
                            $loaithe = 'MobiFone';
                        }
                        if ($NetworkCode == 'VINAPHONE' || $NetworkCode == 'Vinaphone') {
                            $loaithe = 'VinaPhone';
                        }
                        if ($NetworkCode == 'ZING' || $NetworkCode == 'Zing') {
                            $loaithe = 'Zing';
                        }
                        $key_nap =  $LTT->site('partner_key');
                        $dataPost = array(
                            'ApiKey'    => $key_nap,
                            'Pin'       => $NumberCard,
                            'Seri'      => $SeriCard,
                            'CardType'  => $loaithe,
                            'CardValue' => $PricesExchange,
                            'requestid' => $tranid
                        );
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://sieucardvip.com/api/card',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode($dataPost),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $json_code = json_decode($response, true);
                        $result = $json_code['Code'];
                        if ($result == 1) {
                            $create = $LTT->insert("history_naptien", [
                                'type'          => 'napthe',
                                'username'      => $checkusite['username'],
                                'loaithe'       => $NetworkCode,
                                'menhgia'       => $PricesExchange,
                                'sothe'         => $NumberCard,
                                'soseri'        => $SeriCard,
                                'thucnhan'      => 0,
                                'trangthai'     => 0,
                                'date'          => gettime(),
                                'tranid'        => $tranid,
                                'url_config'          => $url_site_name
                            ]);

                            if ($create) {
                                $ghilog = $LTT->insert("log_site", [
                                    'username' => $checkusite['username'],
                                    'note'          => 'Vừa nạp thẻ ' . $NetworkCode . ' với mệnh giá ' . $tongtien . ' vào lúc ' . gettime() . '',
                                    'ip'            => getip(),
                                    'date'          => gettime(),
                                    'url_config'          => $url_site_name
                                ]);
                                $return['status']    = true;
                                $return['error']     = false;
                                $return['tranid']    = $tranid;
                                $return['message']   = "Nạp thẻ thành công";
                                die(json_encode($return));
                            } else {
                                $return['status'] = false;
                                $return['error'] = true;
                                $return['message']   = "Lỗi hệ thống";
                                die(json_encode($return));
                            }
                        } else {
                            $return['status'] = false;
                            $return['error'] = true;
                            $return['message']   = $json_code['Message'];
                            die(json_encode($return));
                        }
                    }
                }
            }
        }
    }



    // $return['status'] = true;
    //                 $return['error'] = false;
    //                 $return['message']   = "Nạp thẻ thành công";
    //                 die(json_encode($return));


}
