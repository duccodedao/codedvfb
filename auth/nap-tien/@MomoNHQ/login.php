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
@$momo = new ChatMomo($NHQ_connect);
$requai = '';

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

$action = check_string($_POST['action']);

if (!empty($action)) {

    $act = check_string($_POST['act']);

    switch ($action) {
        case 'loginmomo':
            if (!empty($act)) {

                $phonemomo = check_string($_POST['phonemomo']);
                $passmomo = check_string($_POST['passmomo']);
                $codeotp = check_string($_POST['codeotp']);

                if (!empty($phonemomo)) {
                    switch ($act) {
                        case 'sendotp':
                            $requai = $momo->LoadData($phonemomo, $url_site_name)->SendOTP();
                            if ($requai['status'] == 'success') {
                                $return['status'] = true;
                                $return['step'] = 'veryotp';
                                $return['message']   = $requai['message'];
                                die(json_encode($return));
                            } else {
                                $return['status'] = false;
                                $return['message']   = $requai['message'];
                                die(json_encode($return));
                            }
                            break;

                        case 'veryotp':
                            if (!empty($codeotp)) {
                                $requai = $momo->LoadData($phonemomo, $url_site_name)->ImportOTP($codeotp);
                                if ($requai['status'] == 'success') {
                                    $return['status'] = true;
                                    $return['step'] = 'login';
                                    $return['message']   = $requai['message'];
                                    die(json_encode($return));
                                } else {
                                    $return['status'] = false;
                                    $return['message']   = $requai['message'];
                                    die(json_encode($return));
                                }
                            } else {
                                $return['status'] = false;
                                $return['message']   = 'Thiếu mã otp';
                                die(json_encode($return));
                            }

                            break;

                        case 'login':
                            if (!empty($passmomo)) {
                                $requai = $momo->LoadData($phonemomo, $url_site_name)->LoginUser($passmomo);
                                if ($requai['status'] == 'success') {
                                    $return['status'] = true;
                                    $return['step'] = 'SUCCESS';
                                    $return['message']   = $requai['message'] . ' Số dư: ' . $requai['BALANCE'];
                                    die(json_encode($return));
                                } else {
                                    $return['status'] = false;
                                    $return['message']   = $requai['message'];
                                    die(json_encode($return));
                                }
                            } else {
                                $return['status'] = false;
                                $return['message']   = 'Thiếu mã otp';
                                die(json_encode($return));
                            }
                            break;

                        default:
                            $return['status'] = false;
                            $return['message']   = "Thiếu số điện thoại";
                            die(json_encode($return));
                            break;
                    }
                } else {
                    $return['status'] = false;
                    $return['message']   = "Thiếu số điện thoại";
                    die(json_encode($return));
                }
            } else {
                $return['status'] = false;
                $return['message']   = "Thiếu số điện thoại";
                die(json_encode($return));
            }
            break;

        default:
            $return['status'] = false;
            $return['message']   = "Thiếu số điện thoại";
            die(json_encode($return));
            break;
    }
} else {
    $return['status'] = false;
    $return['message']   = "Thiếu số điện thoại";
    die(json_encode($return));
}
