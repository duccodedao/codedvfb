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

$id = $_POST['id'];

$conn = mysqli_connect($serverdb, $udb, $pdb, $ndb) or die('Error connection');
$MBBANK = new MBBANK($conn);

if(empty($id) && is_numeric($id) == false && $id < 0){
    die(json_encode([
        'status' => false,
        'message' => 'Error'
    ]));
}

$getlistcard = $LTT->get_row("SELECT * FROM `mbbankauto` WHERE `id` = '$id' AND `sitename` = '".$url_site_name."'");

if ($getlistcard) {
    $lsgd = $MBBANK->LoadData($getlistcard['account'], $getlistcard['password'])->getbalance();
    if ($lsgd['acct_list'] != null) {
        for ($i = 0; $i <= count($lsgd['acct_list']); $i++) {
            if ($lsgd['acct_list'][$i]['acctNo'] == $getlistcard['accountno']) {
                $balance = [
                    'status' => true,
                    'acctNo' => $lsgd['acct_list'][$i]['acctNo'],
                    'message' => 'Số dư là: ' . number_format($lsgd['acct_list'][$i]['currentBalance']) . 'đ',
                    'blance' => $lsgd['acct_list'][$i]['currentBalance']
                ];
            }
        }
echo json_encode($balance);
    } else {
        die(json_encode([
            'status' => true,
            'message' => 'Error'
        ]));
    }
} else {
    die(json_encode([
        'status' => false,
        'message' => 'Error'
    ]));
}