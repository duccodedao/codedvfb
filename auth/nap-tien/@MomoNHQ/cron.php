<?php

require('../../../config/function.php');
require('momo.php');
header("content-type: application/json;charset=utf-8");
$serverdb = SERVERNAME; // server data base
$udb = USERNAME; // user database
$pdb = PASSWORD; // pass database
$ndb = DATABASE; // name database

$NHQ_connect = mysqli_connect($serverdb, $udb, $pdb, $ndb);

if ($NHQ_connect->connect_error) {
    $return['status'] = false;
    $return['error'] = true;
    $return['message']   = $NHQ_connect->connect_error;
    die(json_encode($return));
}

$NHQ_connect->query("set names 'utf8' ");
$momo = new ChatMomo($NHQ_connect);
$requai = '';


$getlistcard = $LTT->get_list("SELECT * FROM `cron_momo` WHERE 1");

if ($getlistcard) {
    foreach ($getlistcard as $rows) {
        //$gethistt = $momo->LoadData($rows['phone'], $rows['sitename'])->RefreshTokenLogin();
        //$gethistt = $momo->LoadData($rows['phone'], $rows['sitename'])->LoginUser($rows['password']);
        //die(print_r($gethistt));
        $gethistt = $momo->LoadData($rows['phone'], $rows['sitename'])->Checklist();
        print_r($gethistt);
        if ($gethistt['momoMsgHistory'] != null) {
            foreach ($gethistt['momoMsgHistory'] as $listhis) {
                $tranId = $listhis['tranId'];
                $partnerID = $listhis['partnerID'];
                $comment = str_replace(' ', '', trim(ltrim($listhis['comment'], $LTT->site('cuphap'))));
                $amount = $listhis['amount'];
                $partnerName = $listhis['partnerName'];
                // echo $comment.'<br>'
                $checuNHQ = $LTT->get_row("SELECT * FROM `users` WHERE `id` = '$comment' AND `url_config` = '" . $rows['sitename'] . "'");

                if ($checuNHQ) {
                    $checktranid = $LTT->get_row("SELECT * FROM `history_naptien` WHERE `type` = 'Bank' AND `tranid` = '$tranId' AND `url_config` = '" . $rows['sitename'] . "'");

                    if (!$checktranid) {
                        // echo 'đang cộng';
                        $create = $LTT->insert("history_naptien", [
                            'type'          => 'Bank',
                            'username'      => $checuNHQ['username'],
                            'loaithe'       => 'momoauto',
                            'menhgia'       => $amount,
                            'sothe'         => 'momoauto',
                            'soseri'        => 'momoauto',
                            'thucnhan'      => $amount,
                            'trangthai'     => 1,
                            'date'          => gettime(),
                            'tranid'        => $tranId,
                            'url_config'          => $rows['sitename']
                        ]);

                        if ($create) {
                            /* update tiền user*/
                            $update1 = $LTT->cong("users", "money", $amount, " `id` = '$comment' AND `url_config` = '" . $rows['sitename'] . "'");
                            $update3 = $LTT->cong("users", "tongnap", $amount, " `id` = '$comment' AND `url_config` = '" . $rows['sitename'] . "'");

                            $ghilog = $LTT->insert("log_site", [
                                'username' => $checuNHQ['username'],
                                'note'          => ' Vừa nạp momo auto ' . $amount . ' vào lúc ' . gettime() . '',
                                'ip'            => getip(),
                                'date'          => gettime(),
                                'url_config'          => $rows['sitename']
                            ]);
                        }
                    } else {
                        echo 'Đã cộng';
                    }
                } else {
                    echo 'ko có u';
                }
            }
        } else {
            echo ('Không có lịch sử');
        }
    }
}

print_r($gethistt);
