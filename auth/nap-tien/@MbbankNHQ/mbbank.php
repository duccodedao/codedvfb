<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');

class MBBANK
{

    private $config = array();

    private $connect;

    public function __construct($conn)
    {
        $this->connect = $conn;
        return $this;
    }

    private function responseCode()
    {
        return [
            'GW200' => 'Error session'
        ];
    }

    private function CheckUser($username, $password)
    {
        $select = $this->connect->query("SELECT * FROM `mbbank` WHERE `username` = '" . $username . "' ");
        if ($select->num_rows == 0) {
            $this->connect->query("INSERT INTO `mbbank` SET `username` = '" . $username . "',
            `password` = '$password' ,
            `tId` = '" . $this->generateRandomString(40) . "' ,
            `deviceIdCommon` = '" . $this->deviceIdCommon() . "' ,
            `refNo` = '$username-" . date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . rand(10000, 99999) . "',
            `create_at` = '" . date('Y-m-d H:i:s') . "' ,
            `update_at` = '" . date('Y-m-d H:i:s') . "' 
            ");
        }
        $this->config = $this->connect->query("SELECT * FROM `mbbank` WHERE `username` = '" . $username . "' LIMIT 1 ")->fetch_assoc();
        return $this;
    }

    public function LoadData($username, $password)
    {
        $select = $this->connect->query("SELECT * FROM `mbbank` WHERE `username` = '" . $username . "' LIMIT 1 ");
        if ($select->num_rows == 0) {
            $this->CheckUser($username, $password);
            return $this;
        }
        $this->config = $select->fetch_assoc();
        return $this;
    }

    public function LoginMbBankMsg($password)
    {
        $result = $this->LoginMbBank($password);

        if ($result['result']['responseCode'] == '00') {
            $this->connect->query("UPDATE `mbbank` SET 
            `refNo` = '" . $result['refNo'] . "',
            `sessionId` = '" . $result['sessionId'] . "',
            `IDMB` = '" . $result['cust']['id'] . "',
            `chrgAcctCd` = '" . $result['cust']['chrgAcctCd'] . "',
            `createdBy` = '" . $result['cust']['createdBy'] . "',
            `custSectorCd` = '" . $result['cust']['custSectorCd'] . "',
            `entrustId` = '" . $result['cust']['entrustId'] . "',
            `phoneNo` = '" . $result['cust']['phoneNo'] . "',
            `name` = '" . $result['cust']['nm'] . "',
            `birthday` = '" . $result['cust']['dob'] . "',
            `spiUsrCd` = '" . $result['cust']['spiUsrCd'] . "',
            `srvcPcCd` = '" . $result['cust']['srvcPcCd'] . "',
            `acct_list` = '" . base64_encode(json_encode($result['cust']['acct_list'])) . "',
            `cardList` = '" . base64_encode(json_encode($result['cust']['cardList'])) . "',
            `softTokenList` = '" . base64_encode(json_encode($result['cust']['softTokenList'])) . "', 
            `biomatricAuthDeviceList` = '" . base64_encode(json_encode($result['cust']['biomatricAuthDeviceList'])) . "',
            `softTokenList` = '" . base64_encode(json_encode($result['cust']['softTokenList'])) . "', 
            `defaultAccount` = '" . base64_encode(json_encode($result['cust']['defaultAccount'])) . "',
            `custjson` = '" . (json_encode($result['cust'])) . "'
            WHERE `username` = '" . $this->config['username'] . "' ");
            return $result;
        } else {
            return $result;
        }
    }

    private function LoginMbBank($password = '')
    {
        $this->connect->query("UPDATE `mbbank` SET `password` = '" . $password . "' WHERE `username` = '" . $this->config['username'] . "' ");
        $softTokenId = $this->get_TOKEN();
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU4=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );

        $Action = 'https://mobile.mbbank.com.vn/retail_lite/common/doLogin';
        $Data = '{"refNo":"' . $this->config['refNo'] . '",
            "userId":"' . $this->config['username'] . '",
            "password":"' . $password . '",
            "softTokenId":"' . $softTokenId . '",
            "deviceId":"' . $this->config['deviceIdCommon'] . '",
            "deviceIdCommon":"' . $this->config['deviceIdCommon'] . '",
            "appVersion":"' . $this->config['appVersion'] . '"
        }';
        return $this->CURL($Action, $header, $Data);
    }

    public function getBeneficiary()
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU4=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );

        $Action = 'https://mobile.mbbank.com.vn/retail_lite/common/getBeneficiary';
        $Data = '{
        "sessionId": "' . $this->config['sessionId'] . '",
        "refNo": "' . $this->config['refNo'] . '",
        "type": "TRANSFER",
        "deviceIdCommon": "' . $this->config['deviceIdCommon'] . '",
        "appVersion": "' . $this->config['appVersion'] . '"
        }';

        $result = $this->CURL($Action, $header, $Data);

        if ($result['result']['ok'] == false) {
            $results = $this->LoginMbBankMsg($this->config['password']); // thực hiện login lại để get session
            if ($results['result']['ok'] == true) {
                return [
                    'result' => [
                        'message' => 'Vui lòng load lại trang',
                        'ok' => false,
                        'responseCode' => $result['result']['responseCode']
                    ]
                ];
            }
        } else {
            return $result;
        }
    }

    public function getNotificationDataList($rowend = 100)
    {
        $result = $this->getNotificationDataListMSG($rowend);

        if ($result['result']['ok'] == false) {
            $results = $this->LoginMbBankMsg($this->config['password']); // thực hiện login lại để get session
            if ($results['result']['ok'] == true) {
                return [
                    'result' => [
                        'message' => 'Vui lòng load lại trang',
                        'ok' => false,
                        'responseCode' => $result['result']['responseCode']
                    ]
                ];
            }
        } else {
            return $result;
        }
    }

    public function getNotificationDataListMSG($rowend = 100)
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU4=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );

        $Action = 'https://mobile.mbbank.com.vn/retail_lite/notification/getNotificationDataList';
        $Data = '{
            "refNo": "' . $this->config['refNo'] . '",
            "sessionId": "' . $this->config['sessionId'] . '",
            "fromRows": 0,
            "toRows": ' . $rowend . ',
            "deviceIdCommon": "' . $this->config['deviceIdCommon'] . '",
            "appVersion": "' . $this->config['appVersion'] . '"
        }';

        return $this->CURL($Action, $header, $Data);
    }

    public function doCheckConnection()
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU4=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );

        $Action = 'https://mobile.mbbank.com.vn/retail_lite/common/doCheckConnection';
        $Data = '{
            "refNo": "' . $this->config['deviceIdCommon'] . explode('-', $this->config['refNo'])[1] . '",
            "deviceId": "' . $this->config['deviceIdCommon'] . '",
            "deviceIdCommon": "' . $this->config['deviceIdCommon'] . '",
            "appVersion": "' . $this->config['appVersion'] . '"
        }';
        return $this->CURL($Action, $header, $Data);
    }

    public function doLogout()
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU4=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );

        $Action = 'https://mobile.mbbank.com.vn/retail_lite/common/doLogout';
        $Data = '{
            "refNo": "' . $this->config['deviceIdCommon'] . explode('-', $this->config['refNo'])[1] . '",
            "deviceIdCommon": "' . $this->config['deviceIdCommon'] . '",
            "appVersion": "' . $this->config['appVersion'] . '"
        }';
        return $this->CURL($Action, $header, $Data);
    }

    public function getBankList()
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU4=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );

        $Action = 'https://mobile.mbbank.com.vn/retail_lite/common/getBankList';
        $Data = '{
        "sessionId": "' . $this->config['sessionId'] . '",
        "refNo": "' . $this->config['refNo'] . '",
        "deviceIdCommon": "' . $this->config['deviceIdCommon'] . '",
        "appVersion": "' . $this->config['appVersion'] . '"
        }';
        $result = $this->CURL($Action, $header, $Data);

        if ($result['result']['ok'] == false) {
            $results = $this->LoginMbBankMsg($this->config['password']); // thực hiện login lại để get session
            if ($results['result']['ok'] == true) {
                return [
                    'result' => [
                        'message' => 'Vui lòng load lại trang',
                        'ok' => false,
                        'responseCode' => $result['result']['responseCode']
                    ]
                ];
            }
        } else {
            return $result;
        }
    }

    public function getCardList()
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU4=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );

        $Action = 'https://mobile.mbbank.com.vn/retail_lite/card/getList';
        $Data = '{
        "sessionId": "' . $this->config['sessionId'] . '",
        "refNo": "' . $this->config['refNo'] . '",
        "deviceIdCommon": "' . $this->config['deviceIdCommon'] . '",
        "appVersion": "' . $this->config['appVersion'] . '"
        }';

        $result = $this->CURL($Action, $header, $Data);

        if ($result['result']['ok'] == false) {
            $results = $this->LoginMbBankMsg($this->config['password']); // thực hiện login lại để get session
            if ($results['result']['ok'] == true) {
                return [
                    'result' => [
                        'message' => 'Vui lòng load lại trang',
                        'ok' => false,
                        'responseCode' => $result['result']['responseCode']
                    ]
                ];
            }
        } else {
            return $result;
        }
    }

    public function getUserInfo()
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU4=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );

        $Action = 'https://mobile.mbbank.com.vn/retail_lite/loan/getUserInfo';
        $Data = '{
        "sessionId": "' . $this->config['sessionId'] . '",
        "refNo": "' . $this->config['refNo'] . '",
        "deviceIdCommon": "' . $this->config['deviceIdCommon'] . '",
        "appVersion": "' . $this->config['appVersion'] . '"
        }';

        $result = $this->CURL($Action, $header, $Data);

        if ($result['result']['ok'] == false) {
            $results = $this->LoginMbBankMsg($this->config['password']); // thực hiện login lại để get session
            if ($results['result']['ok'] == true) {
                return [
                    'result' => [
                        'message' => 'Vui lòng load lại trang',
                        'ok' => false,
                        'responseCode' => $result['result']['responseCode']
                    ]
                ];
            }
        } else {
            return $result;
        }
    }

    public function getbalance()
    {

        $result = $this->getbalanceMSG();

        if ($result['result']['ok'] == false) {
            $results = $this->LoginMbBankMsg($this->config['password']); // thực hiện login lại để get session
            if ($results['result']['ok'] == true) {
                return [
                    'result' => [
                        'message' => 'Vui lòng load lại trang',
                        'ok' => false,
                        'responseCode' => $result['result']['responseCode']
                    ]
                ];
            }
        } else {
            return $result;
        }
    }


    public function getbalanceMSG()
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU4=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );

        $Action = 'https://mobile.mbbank.com.vn/retail_lite/account/v2.0/getBalance';
        $Data = '{
            "sessionId": "' . $this->config['sessionId'] . '",
            "refNo": "' . $this->config['refNo'] . '",
            "deviceIdCommon": "' . $this->config['deviceIdCommon'] . '",
            "appVersion": "' . $this->config['appVersion'] . '"
        }';
        return $this->CURL($Action, $header, $Data);
    }

    public function Checkhistory($day, $accountNo)
    {
        $result = $this->getTransactionHistory($day, $accountNo);
        if ($result['result']['ok'] == false) {
            $results = $this->LoginMbBankMsg($this->config['password']); // thực hiện login lại để get session
            if ($results['result']['ok'] == true) {
                return [
                    'result' => [
                        'message' => 'Vui lòng load lại trang',
                        'ok' => false,
                        'responseCode' => $result['result']['responseCode']
                    ]
                ];
            }
        } else {
            if ($result['transactionHistoryList'] != null) {
                $i = 0;
                foreach ($result['transactionHistoryList'] as $value) {
                    // echo trim($value['description']) . '<br>'; unknown
                    $postingDate = $this->checkvalue($value['postingDate']);
                    $transactionDate = $this->checkvalue($value['transactionDate']);
                    $accountNo = $this->checkvalue($value['accountNo']);
                    $creditAmount = $this->checkvalue($value['creditAmount']);
                    $debitAmount = $this->checkvalue($value['debitAmount']);
                    $currency = $this->checkvalue($value['currency']);
                    $description = $this->checkvalue($value['description']);
                    $description2 = explode('-', trim($this->checkvalue($value['description'])))[0];
                    $availableBalance = $this->checkvalue($value['availableBalance']);
                    $beneficiaryAccount = $this->checkvalue($value['beneficiaryAccount']);
                    $refNo = $this->checkvalue($value['refNo']);
                    $refNo2 = explode("\BNK", $this->checkvalue($value['refNo']))[0];
                    $benAccountName = $this->checkvalue($value['benAccountName']);
                    $bankName = $this->checkvalue($value['bankName']);
                    $benAccountNo = $this->checkvalue($value['benAccountNo']);
                    $dueDate = $this->checkvalue($value['dueDate']);
                    $docId = $this->checkvalue($value['docId']);
                    $transactionType = $this->checkvalue($value['transactionType']);

                    $return[$i] = [
                        'postingDate' => $postingDate,
                        'transactionDate' => $transactionDate,
                        'accountNo' => $accountNo,
                        'creditAmount' => $creditAmount,
                        'debitAmount' => $debitAmount,
                        'currency' => $currency,
                        'description' => $description,
                        'content' => $description2,
                        'availableBalance' => $availableBalance,
                        'beneficiaryAccount' => $beneficiaryAccount,
                        'refNo' => $refNo,
                        'tranId' => $refNo2,
                        'benAccountName' => $benAccountName,
                        'bankName' => $bankName,
                        'benAccountNo' => $benAccountNo,
                        'dueDate' => $dueDate,
                        'docId' => $docId,
                        'transactionType' => $transactionType,
                        'io' => empty($value['creditAmount']) ? '-1' : '1',
                    ];
                    $i++;
                }
                return [
                    'result' => [
                        'message' => 'Truy xuất thành công',
                        'ok' => true,
                        'transactionHistoryList' => $return
                    ]
                ];
            } else {
                return [
                    'result' => [
                        'message' => 'Không có lịch sử',
                        'ok' => false,
                    ]
                ];
            }
        }
    }

    public function checkvalue($string)
    {
        if (is_null($string) || empty($string)) {
            return false;
        } elseif (is_object($string) || is_array($string)) {
            return json_encode($string, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } elseif (is_string($string)) {
            return (string) $string;
        } elseif (is_numeric($string)) {
            return (int) $string;
        } else {
            return (string) $string;
        }
    }

    public function getTransactionHistory($day = 5, $accountNo)
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU4=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );

        $Action = 'https://mobile.mbbank.com.vn/retail_lite/common/getTransactionHistory';
        $Data = '{
        "sessionId": "' . $this->config['sessionId'] . '",
        "refNo": "' . $this->config['refNo'] . '",
        "fromDate": "' . date("d/m/Y", time() - 86400 * $day) . '",
        "toDate": "' . date("d/m/Y", time()) . '",
        "accountNo": "' . $accountNo . '",
        "type": "ACCOUNT",
        "historyType": "DATE_RANGE",
        "historyNumber": "",
        "deviceIdCommon": "' . $this->config['deviceIdCommon'] . '",
        "appVersion": "' . $this->config['appVersion'] . '"
        }';
        return $this->CURL($Action, $header, $Data);
    }

    private function CURL($Action, $header, $data = '')
    {
        $Data = is_array($data) ? json_encode($data) : $data;
        $curl = curl_init();
        $opt = array(
            CURLOPT_URL => $Action,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST => empty($data) ? FALSE : TRUE,
            CURLOPT_POSTFIELDS => $Data,
            CURLOPT_CUSTOMREQUEST => empty($data) ? 'GET' : 'POST',
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_ENCODING => "",
            CURLOPT_HEADER => FALSE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2,
            CURLOPT_TIMEOUT => 20,
        );
        curl_setopt_array($curl, $opt);
        $body = curl_exec($curl);
        if (is_object(json_decode($body))) {
            return json_decode($body, true);
        }
        return $body;
    }

    private function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdef';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function deviceIdCommon()
    {
        return "0000000-0000-0000-" . $this->generateRandomString(4) . "-" . $this->generateRandomString(12) . "";
    }

    public function get_TOKEN()
    {
        return  $this->generateRandom(22) . ':' . $this->generateRandom(9) . '-' . $this->generateRandom(20) . '-' . $this->generateRandom(12) . '-' . $this->generateRandom(7) . '-' . $this->generateRandom(7) . '-' . $this->generateRandom(53) . '-' . $this->generateRandom(9) . '_' . $this->generateRandom(11) . '-' . $this->generateRandom(4);
    }
    private function generateRandom($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    }
}
