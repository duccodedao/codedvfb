<?php
header('Content-Type: application/json, text/javascript; charset="utf-8"');
$return = 'no';

require('../../../config/function.php');
require('mbbank.php');
// config data
{
    //     // config
    $serverdb = SERVERNAME; // server data base
    $udb = USERNAME;
    $pdb = PASSWORD;
    $ndb = DATABASE;

    $username = $LTT->check('account_mbbank');
    $password = $LTT->check('password_mbbank');
}

$conn = mysqli_connect($serverdb, $udb, $pdb, $ndb) or die('Error connection');
$MBBANK = new MBBANK($conn);

$getlistcard = $LTT->get_list("SELECT * FROM `mbbankauto` WHERE 1");

if ($getlistcard) {
    foreach ($getlistcard as $rows) {
        $lsgd = $MBBANK->LoadData($rows['account'], $rows['password'])->Checkhistory(1, $rows['accountno']);
        if (!empty($lsgd['result']['transactionHistoryList']) || $lsgd['result']['transactionHistoryList'] != null) {


            $transactionHistoryList = $lsgd['result']['transactionHistoryList'];

            for ($i = 0; $i < count($transactionHistoryList); $i++) {
                $tranId = $transactionHistoryList[$i]['tranId'];
                $tranIdok = substr($tranId, 0, 16);
                $creditAmount =  $transactionHistoryList[$i]['creditAmount'];
                $content =  $transactionHistoryList[$i]['content'];
                //$description =  $transactionHistoryList[$i]['description'];
                $contentok =  trim(str_replace('.', '', explode('TU:', explode($LTT->site('cuphap'), $content)[1])[0]));
                $description =  trim(str_replace('.', '', explode('TU:', explode($LTT->site('cuphap'), $description)[1])[0]));
                $io =  $transactionHistoryList[$i]['io'];
                if ($io == 1) {

                    $checuNHQ = $LTT->get_row("SELECT * FROM `users` WHERE `id` = '$contentok' AND `url_config` = '" . $rows['sitename'] . "'");

                    if ($checuNHQ) {
                        $checktranid = $LTT->get_row("SELECT * FROM `history_naptien` WHERE `type` = 'Bank' AND `tranid` = '$tranIdok' AND `url_config` = '" . $rows['sitename'] . "'");

                        if (!$checktranid) {
                            $create = $LTT->insert("history_naptien", [
                                'type'          => 'Bank',
                                'username'      => $checuNHQ['username'],
                                'loaithe'       => 'Mbbank Auto',
                                'menhgia'       => $creditAmount,
                                'sothe'         => 'Mbbank Auto',
                                'soseri'        => 'Mbbank auto',
                                'thucnhan'      => $creditAmount,
                                'trangthai'     => 1,
                                'date'          => gettime(),
                                'tranid'        => $tranIdok,
                                'url_config'          => $rows['sitename']
                            ]);

                            if ($create) {
                                /* update tiền user*/
                                $update1 = $LTT->cong("users", "money", $creditAmount, " `id` = '$contentok' AND `url_config` = '" . $rows['sitename'] . "'");
                                $update3 = $LTT->cong("users", "tongnap", $creditAmount, " `id` = '$contentok' AND `url_config` = '" . $rows['sitename'] . "'");

                                $ghilog = $LTT->insert("log_site", [
                                    'username' => $checuNHQ['username'],
                                    'note'          => ' Vừa nạp mbbank auto ' . $creditAmount . ' vào lúc ' . gettime() . '',
                                    'ip'            => getip(),
                                    'date'          => gettime(),
                                    'url_config'          => $rows['sitename']
                                ]);
                            }
                        }
                    }

                    $mbbank[] = [
                        'tranId' => $tranIdok,
                        'creditAmount' => $creditAmount,
                        'content' => $contentok,
                        'description' => $description,
                        'io' => $io
                    ];
                }
            }

            echo json_encode($mbbank);
        }
    }

    //print_r($lsgd);
}
