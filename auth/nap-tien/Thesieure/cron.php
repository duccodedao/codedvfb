<?php
require('../../../config/function.php');
include_once __DIR__ . '/libs/simple_html_dom.php';
$access = true;
$dom = new simple_html_dom();


$getlistcard = $LTT->get_list("SELECT * FROM `thesieureauto` WHERE 1");

if ($getlistcard) {
    foreach ($getlistcard as $value) {
        // echo $value['cookie'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://thesieure.com/wallet/history/vnd',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: ' . $value['cookie'],
                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.136 Safari/537.36'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if (!empty($response)) {
            $Get_Table = str_get_html($response)->find('tbody', 0);
            header("Content-Type: application/json");
            // Xuất dữ liệu
            foreach ($Get_Table->find('tr') as $Data) {
                $PricesExchange =  str_replace('đ', '', str_replace('+', '', str_replace(',', '', $Data->find('td', 2)->plaintext)));
                $tranid = $Data->find('td', 0)->plaintext;
                $usernamex = trim(explode('|||', $Data->find('td', 6)->plaintext)[0], $LTT->site('cuphap'));
                $usernamex = str_replace(' ', '', $usernamex);
                $Json_Datas[] = array(
                    'trading_code' => $Data->find('td', 0)->plaintext,
                    'before_money_cost' => $Data->find('td', 1)->plaintext,
                    'amount' => $PricesExchange,
                    'io' => substr($Data->find('td', 2)->plaintext, 0, 1) . '1',
                    'after_money_cost' => $Data->find('td', 3)->plaintext,
                    'time_created' => $Data->find('td', 5)->plaintext,
                    'CODE' => $Data->find('td', 4)->plaintext,
                    'content' => explode('|||', $Data->find('td', 6)->plaintext)[0],
                    'usernamex' => $usernamex,
                );
            }
            foreach ($Json_Datas as $e) {
                print_r($e['content']."\n");
                $checktheu = $LTT->get_row("SELECT * FROM `users` WHERE `id` = '$usernamex' AND `url_config` = '" . $value['sitename'] . "'");
                if ($checktheu) {
                    if (substr($Data->find('td', 2)->plaintext, 0, 1) == '+') {
                        $checkthe = $LTT->get_row("SELECT * FROM `history_naptien` WHERE `type` = 'Bank' AND `tranid` = '$tranid' AND `url_config` = '" . $value['sitename'] . "'");

                        if (!$checkthe) {
                            $create = $LTT->insert("history_naptien", [
                                'type'          => 'Bank',
                                'username'      => $checktheu['username'],
                                'loaithe'       => 'tsrauto',
                                'menhgia'       => $PricesExchange,
                                'sothe'         => 'tsrauto',
                                'soseri'        => 'tsrauto',
                                'thucnhan'      => $PricesExchange,
                                'trangthai'     => 1,
                                'date'          => gettime(),
                                'tranid'        => $tranid,
                                'url_config'          => $value['sitename']
                            ]);

                            if ($create) {
                                /* update tiền user*/
                                $update1 = $LTT->cong("users", "money", $PricesExchange, " `id` = '$usernamex' AND `url_config` = '" . $value['sitename'] . "'");
                                $update3 = $LTT->cong("users", "tongnap", $PricesExchange, " `id` = '$usernamex' AND `url_config` = '" . $value['sitename'] . "'");

                                $ghilog = $LTT->insert("log_site", [
                                    'username' => $checktheu['username'],
                                    'note'          => ' Vừa nạp tsr auto ' . $PricesExchange . ' vào lúc ' . gettime() . '',
                                    'ip'            => getip(),
                                    'date'          => gettime(),
                                    'url_config'          => $value['sitename']
                                ]);
                            }
                        }
                    }
                } else {
                    echo '';
                }
            }
            // echo (json_encode($Json_Datas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }
}
