<?php

class ChatMomo
{
    private $config = array();

    private $URLAction = array(
        "CHECK_USER_BE_MSG" => "https://api.momo.vn/backend/auth-app/public/CHECK_USER_BE_MSG", //Check người dùng
        "SEND_OTP_MSG"      => "https://api.momo.vn/backend/otp-app/public/SEND_OTP_MSG", //Gửi OTP
        "REG_DEVICE_MSG"    => "https://api.momo.vn/backend/otp-app/public/REG_DEVICE_MSG", // Xác minh OTP
        "QUERY_TRAN_HIS_MSG" => "https://owa.momo.vn/api/QUERY_TRAN_HIS_MSG", // Check ls giao dịch
        "USER_LOGIN_MSG"     => "https://owa.momo.vn/public/login", // Đăng Nhập
        'CHECK_USER_PRIVATE' => 'https://owa.momo.vn/api/CHECK_USER_PRIVATE', // Check người dùng ẩn
        "QUERY_TRAN_HIS_MSG_NEW"            => "https://m.mservice.io/hydra/v1/user/noti", // check ls giao dịch 
        'GENERATE_TOKEN_AUTH_MSG'           => 'https://api.momo.vn/backend/auth-app/public/GENERATE_TOKEN_AUTH_MSG',

    );

    public function LoadData($phone, $sitename)
    {
        $select = $this->connect->query("SELECT * FROM `cron_momo` WHERE `phone` = '" . $phone . "' AND `sitename` = '$sitename' LIMIT 1 ");
        if ($select->num_rows == 0) {
            $this->CheckUser($phone, $sitename);
            return $this;
        }
        $this->config = $select->fetch_assoc();
        $this->sitename = $sitename;
        return $this;
    }

    public function __construct($conn)
    {
        $this->connect = $conn;
        return $this;
    }

    public function CheckUser($phone, $sitename)
    {
        $select = $this->connect->query("SELECT * FROM `cron_momo` WHERE `phone` = '" . $phone . "'  AND `sitename` = '$sitename' ");
        if ($select->num_rows >= 1) {
            $this->connect->query("UPDATE `cron_momo` SET `agent_id` = 'underfined',
                                                            `sessionkey` = '',
                                                            `authorization` = 'underfined' WHERE `phone` = '$phone'  AND `sitename` = '$sitename' ");
        } else if ($select->num_rows == 0) {
            $device = $this->connect->query("SELECT * FROM `device` ORDER BY RAND() LIMIT 1 ")->fetch_assoc();
            $this->connect->query("INSERT INTO `cron_momo` SET `phone` = '" . $phone . "',
            `sitename` = '" . $sitename . "',
                                                                 `imei` = '" . $this->generateImei() . "',
                                                                 `SECUREID` = '" . $this->get_SECUREID() . "',
                                                                 `rkey` = '" . $this->generateRandom(20) . "',
                                                                 `AAID` = '" . $this->generateImei() . "',
                                                                 `TOKEN` = '" . $this->get_TOKEN() . "',
                                                                 `device` = '" . $device["device"] . "',
                                                                 `hardware` = '" . $device["hardware"] . "',
                                                                 `facture` = '" . $device["facture"] . "',
                                                                 `MODELID` = '" . $device["MODELID"] . "' ");
        }
        $this->config = $this->connect->query("SELECT * FROM `cron_momo` WHERE `phone` = '" . $phone . "'  AND `sitename` = '$sitename' LIMIT 1 ")->fetch_assoc();
        return $this;
    }

    public function SendOTP()
    {
        $result = $this->SEND_OTP_MSG();
        if (!empty($result["errorCode"])) {
            return array(
                "status" => "error",
                "code"   => $result["errorCode"],
                "message" => $result["errorDesc"]
            );
        } else if (is_null($result)) {
            return array(
                "status" => "error",
                "code"   => -5,
                "message" => "Hết thời gian truy cập vui lòng đăng nhập lại"
            );
        }
        return array(
            "status"  => "success",
            "message" => "Thành công"
        );
    }

    public function CheckBeUser()
    {
        $result = $this->CHECK_USER_BE_MSG();
        if (!empty($result["errorCode"])) {
            return array(
                "status" => "error",
                "code"   => $result["errorCode"],
                "message" => $result["errorDesc"]
            );
        }
        $this->connect->query("UPDATE `cron_momo` SET `Name` = '" . $result['extra']['NAME'] . "' WHERE `phone` = '" . $this->config['phone'] . "'  AND `sitename` = '" . $this->sitename . "' ");
        return array(
            "status"  => "success",
            "message" => "Thành công"
        );
    }

    public function Checklist($day = 30)
    {
        $resuts = $this->QUERY_TRAN_HIS_MSG_NEW($day);
        // die(print_r($resuts));
        if ($resuts == null || empty($resuts)) {
            $loginagain = $this->RefreshTokenLogin();
            if ($loginagain['status'] == true) {
                $requai = array(
                    "status" => false,
                    "message" => "Đã xảy ra lỗi với API Token vui lòng kiểm tra lại, vui lòng load lại trang và thử lại, nếu vẫn gặp lỗi hãy đăng nhập lại"
                );
                return ($requai);
            } else {
                return (array(
                    "status" => false,
                    "code"   => -5,
                    "message" => "Hết thời gian truy cập vui lòng đăng nhập lại"
                ));
            }
        } else {

            $data = $resuts['message']['notifications'];
            $i = 0;
            $return = null;
            foreach ($data as $value) {
                if ($value['type'] == 77 or $value['type'] == 90) { // 4001, 1, nap tiền 15, nhận quà 1100, liên kết ngân hàng 9, nhận tiền 77, 90, 45 lời cảm ơn khi sendmony

                    #code insert db
                    $return[$i]["tranId"] = $value['tranId'];
                    $return[$i]["partnerID"] = $value['sender'];
                    $return[$i]["caption"] = $value['caption'];
                    $return[$i]["finishTime"] = date('H:i:s d-m-Y', substr($value['time'], 0, 10));
                    $extra = json_decode($value['extra']);
                    $return[$i]["partnerName"] = $extra->partnerName;
                    $return[$i]["comment"] = $extra->comment;
                    $return[$i]["amount"] = (int)str_replace('.0', '', $extra->amount);
                    $return[$i]["typehistory"] = 'Nhận tiền';
                    $i++;
                }
            }
            return (array(
                "status" => true,
                'message' => 'Thành công',
                "momoMsgHistory" => $return
            ));
        }
    }

    public function QUERY_TRAN_HIS_MSG_NEW($day = 30)
    {
        $begin = (time() - (86400 * $day)) * 1000;
        $header = array(
            "authorization: Bearer " . $this->config["authorization"],
            "user_phone: " . $this->config['phone'],
            "Host: m.mservice.io",

        );
        $Data = '{
              "userId": "' . $this->config['phone'] . '",
              "fromTime": ' . $begin . ',
              "toTime": ' . $this->get_microtime() . ',
              "limit": 500,
              "cursor": ""
          }';
        return $this->CURL("QUERY_TRAN_HIS_MSG_NEW", $header, $Data);
    }

    public function ImportOTP($code)
    {
        $this->config['ohash'] = hash('sha256', $this->config["phone"] . $this->config["rkey"] . $code);
        $this->connect->query("UPDATE `cron_momo` SET `ohash` = '" . $this->config['ohash'] . "' WHERE `phone` = '" . $this->config["phone"] . "' AND `sitename` = '" . $this->sitename . "' ");
        $result = $this->REG_DEVICE_MSG();
        if (!empty($result["errorCode"])) {
            return array(
                "status" => "error",
                "code"   => $result["errorCode"],
                "message" => $result["errorDesc"]
            );
        } else if (is_null($result)) {
            return array(
                "status" => "error",
                "code"   => -5,
                "message" => "Hết thời gian truy cập vui lòng đăng nhập lại"
            );
        }
        $setupKeyDecrypt = $this->get_setupKey($result["extra"]["setupKey"]);
        $this->connect->query("UPDATE `cron_momo` SET `setupKey` = '" . $result["extra"]["setupKey"] . "',
                                                       `setupKeyDecrypt` = '" . $setupKeyDecrypt . "' WHERE `phone` =  '" . $this->config["phone"] . "' AND `sitename` = '" . $this->sitename . "' ");
        return array(
            "status" => "success",
            "message" => "Thành công"
        );
    }

    public function LoginUser($password = "")
    {
        if ($password == "") {
            $result = $this->USER_LOGIN_MSG();
        } else {
            $this->config["password"] = $password;
            $result = $this->USER_LOGIN_MSG();
        }
        if (!empty($result["errorCode"])) {
            return array(
                "status" => "error",
                "code"   => $result["errorCode"],
                "message" => $result["errorDesc"]
            );
        } else if (is_null($result)) {
            return array(
                "status"  => "error",
                "code"    => -5,
                "message" => "Hết thời gian truy cập vui lòng đăng nhập lại"
            );
        }
        $extra = $result["extra"];
        $this->connect->query("UPDATE `cron_momo` SET `password` = '" . $this->config["password"] . "',
                                                        `authorization` = '" . $extra["AUTH_TOKEN"] . "',
                                                        `agent_id` = '" . $result["momoMsg"]["agentId"] . "',
                                                        `RSA_PUBLIC_KEY` = '" . $extra["REQUEST_ENCRYPT_KEY"] . "',
                                                        `REFRESH_TOKEN` = '" . $extra["REFRESH_TOKEN"] . "',
                                                        `BALANCE` = '" . $extra["BALANCE"] . "',
                                                        `Name` = '" . $extra["NAME"] . "',
                                                        `sessionkey` = '" . $extra["SESSION_KEY"] . "' WHERE `phone` = '" . $this->config["phone"] . "' AND `sitename` = '" . $this->sitename . "' ");
        return array(
            "status" => "success",
            "BALANCE"  => (int)$extra["BALANCE"],
            "message" => "Thành công",
            $result
        );
    }

    public function USER_LOGIN_MSG()
    {
        $microtime = $this->get_microtime();
        $header = array(
            "agent_id: " . $this->config["agent_id"],
            "user_phone: " . $this->config["phone"],
            "sessionkey: " . (!empty($this->config["sessionkey"])) ? $this->config["sessionkey"] : "",
            "authorization: Bearer " . $this->config["authorization"],
            "msgtype: USER_LOGIN_MSG",
            "Host: owa.momo.vn",
            "user_id: " . $this->config["phone"],
            "User-Agent: okhttp/3.14.17",
            "app_version: 31110",
            "app_code: 3.1.11",
            "device_os: ANDROID"
        );
        $Data = '{
              "user": "' . $this->config["phone"] . '",
              "msgType": "USER_LOGIN_MSG",
              "pass": "' . $this->config["password"] . '",
              "cmdId": "' . $microtime . '000000",
              "lang": "vi",
              "time": ' . (int)$microtime . ',
              "channel": "APP",
              "appVer": 31110,
              "appCode": "3.1.11",
              "deviceOS": "ANDROID",
              "buildNumber": 0,
              "appId": "vn.momo.platform",
              "result": true,
              "errorCode": 0,
              "errorDesc": "",
              "momoMsg": {
                "_class": "mservice.backend.entity.msg.LoginMsg",
                "isSetup": false
              },
              "extra": {
                "pHash": "' . $this->get_pHash() . '",
                "AAID": "' . $this->config["AAID"] . '",
                "IDFA": "",
                "TOKEN": "' . $this->config["TOKEN"] . '",
                "SIMULATOR": "",
                "SECUREID": "' . $this->config["SECUREID"] . '",
                "MODELID": "' . $this->config["MODELID"] . '",
                "checkSum": "' . $this->generateCheckSum("USER_LOGIN_MSG", $microtime) . '"
              }
            }';
        return $this->CURL("USER_LOGIN_MSG", $header, $Data);
    }

    public function GENERATE_TOKEN_AUTH_MSG()
    {
        $microtime = $this->get_microtime();
        $header = array(
            'accept: application/json',
            'app_version: 31110',
            'app_code: 3.1.11',
            'device_os: ANDROID',
            'agent_id: ' . $this->config["agent_id"] . '',
            'sessionkey: ' . (!empty($this->config["sessionkey"])) ? $this->config["sessionkey"] : "" . '',
            'user_phone: ' . $this->config["phone"] . '',
            'lang: vi',
            'authorization: Bearer ' . $this->config["authorization"] . '',
            'msgtype: GENERATE_TOKEN_AUTH_MSG',
            'Content-Type: application/json',
            'Host: api.momo.vn',
            'User-Agent: okhttp/4.9.0'
        );
        $Data = '{
        "user": "' . $this->config["phone"] . '",
        "msgType": "GENERATE_TOKEN_AUTH_MSG",
        "cmdId": "' . $microtime . '000000",
        "lang": "vi",
        "time": ' . $microtime . ',
        "channel": "APP",
        "appVer": 31110,
        "appCode": "3.1.11",
        "deviceOS": "ANDROID",
        "buildNumber": 0,
        "appId": "vn.momo.platform",
        "result": true,
        "errorCode": 0,
        "errorDesc": "",
        "momoMsg": {
            "_class": "mservice.backend.entity.msg.RefreshTokenMsg",
            "refreshToken": "' . $this->config["REFRESH_TOKEN"] . '"
        },
        "extra": {
           "pHash": "' . $this->get_pHash() . '",
            "AAID": "' . $this->config["AAID"] . '",
            "IDFA": "",
            "TOKEN": "' . $this->config["TOKEN"] . '",
            "SIMULATOR": "",
            "SECUREID": "' . $this->config["SECUREID"] . '",
            "MODELID": "' . $this->config["MODELID"] . '",
            "checkSum": "' . $this->generateCheckSum("GENERATE_TOKEN_AUTH_MSG", $microtime) . '"
        }
        }';
        return $this->CURL("GENERATE_TOKEN_AUTH_MSG", $header, $Data);
    }

    public function RefreshTokenLogin()
    {
        $result = $this->GENERATE_TOKEN_AUTH_MSG();

        if (!empty($result["errorCode"])) {
            return json_encode(array(
                "status" => false,
                "code"   => $result["errorCode"],
                "message" => $result["errorDesc"],
                $this->config["REFRESH_TOKEN"]
            ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else if (is_null($result)) {
            return json_encode(array(
                "status"  => false,
                "code"    => -5,
                "message" => "Hết thời gian truy cập vui lòng đăng nhập lại"
            ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            $extra = $result["extra"];
            $this->connect->query("UPDATE `cron_momo` SET `authorization` = '" . $extra["AUTH_TOKEN"] . "',
                                                        `agent_id` = '" . $result["momoMsg"]["agentId"] . "',
                                                        `RSA_PUBLIC_KEY` = '" . $extra["REQUEST_ENCRYPT_KEY"] . "',
                                                        `sessionkey` = '" . $extra["SESSION_KEY"] . "' WHERE `phone` = '" . $this->config["phone"] . "' AND `sitename` = '" . $this->sitename . "' ");


            return json_encode(array(
                "status" => true,
                "message" => "Login thành công",
                'default' => $result
            ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }

    public function CHECK_USER_BE_MSG()
    {
        $microtime = $this->get_microtime();
        $header = array(
            "agent_id: undefined",
            "sessionkey:",
            "user_phone: undefined",
            "authorization: Bearer undefined",
            "msgtype: CHECK_USER_BE_MSG",
            'Host: api.momo.vn',
            "User-Agent: okhttp/3.14.17",
            "app_version: 31110",
            "app_code: 3.1.11",
            "device_os: ANDROID"
        );
        $Data = '{
              "user": "' . $this->config["phone"] . '",
              "msgType": "CHECK_USER_BE_MSG",
              "cmdId": "' . (string)$microtime . '000000",
              "lang": "vi",
              "time": ' . (int)$microtime . ',
              "channel": "APP",
              "appVer": 31110,
              "appCode": "3.1.11",
              "deviceOS": "ANDROID",
              "buildNumber": 0,
              "appId": "vn.momo.platform",
              "result": true,
              "errorCode":0,
              "errorDesc":"",
              "momoMsg":{
                "_class": "mservice.backend.entity.msg.RegDeviceMsg",
                "number": "' . $this->config["phone"] . '",
                "imei": "' . $this->config["imei"] . '",
                "cname": "Vietnam",
                "ccode": "084",
                "device": "' . $this->config["device"] . '",
                "firmware": "23",
                "hardware": "' . $this->config["hardware"] . '",
                "manufacture": "' . $this->config["facture"] . '",
                "csp": "",
                "icc": "",
                "mcc": "",
                "device_os": "Android",
                "secure_id": "' . $this->config["SECUREID"] . '"
              },
              "extra": {
                "checkSum": ""
                  }
            }';
        return $this->CURL("CHECK_USER_BE_MSG", $header, $Data);
    }

    public function REG_DEVICE_MSG()
    {
        $microtime = $this->get_microtime();
        $header = array(
            "agent_id: undefined",
            "sessionkey:",
            "user_phone: undefined",
            "authorization: Bearer undefined",
            "msgtype: REG_DEVICE_MSG",
            'Host: api.momo.vn',
            "User-Agent: okhttp/3.14.17",
            "app_version: 31110",
            "app_code: 3.1.11",
            "device_os: ANDROID"
        );
        $Data = '{
              "user": "' . $this->config["phone"] . '",
              "msgType": "REG_DEVICE_MSG",
              "cmdId": "' . $microtime . '000000",
              "lang": "vi",
              "time": ' . $microtime . ',
              "channel": "APP",
              "appVer": 31110,
              "appCode": "3.1.11",
              "deviceOS": "ANDROID",
              "buildNumber": 0,
              "appId": "vn.momo.platform",
              "result": true,
              "errorCode": 0,
              "errorDesc": "",
              "momoMsg": {
                "_class": "mservice.backend.entity.msg.RegDeviceMsg",
                "number": "' . $this->config["phone"] . '",
                "imei": "' . $this->config["imei"] . '",
                "cname": "Vietnam",
                "ccode": "084",
                "device": "' . $this->config["device"] . '",
                "firmware": "23",
                "hardware": "' . $this->config["hardware"] . '",
                "manufacture": "' . $this->config["facture"] . '",
                "csp": "",
                "icc": "",
                "mcc": "",
                "device_os": "Android",
                "secure_id": "' . $this->config["SECUREID"] . '"
              },
              "extra": {
                "ohash": "' . $this->config['ohash'] . '",
                "AAID": "' . $this->config["AAID"] . '",
                "IDFA": "",
                "TOKEN": "' . $this->config["TOKEN"] . '",
                "SIMULATOR": "",
                "SECUREID": "' . $this->config["SECUREID"] . '",
                "MODELID": "' . $this->config["MODELID"] . '",
                "checkSum": ""
              }
            }';
        return $this->CURL("REG_DEVICE_MSG", $header, $Data);
    }

    public function SEND_OTP_MSG()
    {
        $header = array(
            "agent_id: undefined",
            "sessionkey:",
            "user_phone: undefined",
            "authorization: Bearer undefined",
            "msgtype: SEND_OTP_MSG",
            'Host: api.momo.vn',
            "User-Agent: okhttp/3.14.17",
            "app_version: 31110",
            "app_code: 3.1.11",
            "device_os: ANDROID"
        );
        $microtime = $this->get_microtime();
        $Data = '{
              "user": "' . $this->config["phone"] . '",
              "msgType": "SEND_OTP_MSG",
              "cmdId": "' . $microtime . '000000",
              "lang": "vi",
              "time": ' . $microtime . ',
              "channel": "APP",
              "appVer": 31110,
              "appCode": "3.1.11",
              "deviceOS": "ANDROID",
              "buildNumber": 0,
              "appId": "vn.momo.platform",
              "result": true,
              "errorCode": 0,
              "errorDesc": "",
              "momoMsg": {
                "_class": "mservice.backend.entity.msg.RegDeviceMsg",
                "number": "' . $this->config["phone"] . '",
                "imei": "' . $this->config["imei"] . '",
                "cname": "Vietnam",
                "ccode": "084",
                "device": "' . $this->config["device"] . '",
                "firmware": "23",
                "hardware": "' . $this->config["hardware"] . '",
                "manufacture": "' . $this->config["facture"] . '",
                "csp": "",
                "icc": "",
                "mcc": "",
                "device_os": "Android",
                "secure_id": "' . $this->config["SECUREID"] . '"
              },
              "extra": {
                "action": "SEND",
                "rkey": "' . $this->config["rkey"] . '",
                "AAID": "' . $this->config["AAID"] . '",
                "IDFA": "",
                "TOKEN": "' . $this->config["TOKEN"] . '",
                "SIMULATOR": "",
                "SECUREID": "' . $this->config["SECUREID"] . '",
                "MODELID": "' . $this->config["MODELID"] . '",
                "isVoice": false,
                "REQUIRE_HASH_STRING_OTP": true,
                "checkSum": ""
              }
            }';
        return $this->CURL("SEND_OTP_MSG", $header, $Data);
    }

    private function CURL($Action, $header, $data)
    {
        $Data = is_array($data) ? json_encode($data) : $data;
        $curl = curl_init();
        $header[] = 'Content-Type: application/json';
        $header[] = 'accept: application/json';
        $header[] = 'Content-Length: ' . strlen($Data);
        $opt = array(
            CURLOPT_URL => $this->URLAction[$Action],
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST => empty($data) ? FALSE : TRUE,
            CURLOPT_POSTFIELDS => $Data,
            CURLOPT_CUSTOMREQUEST => empty($data) ? 'GET' : 'POST',
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_ENCODING => "",
            CURLOPT_HEADER => FALSE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
        );
        curl_setopt_array($curl, $opt);
        $body = curl_exec($curl);
        if (is_object(json_decode($body))) {
            return json_decode($body, true);
        }
        return json_decode($this->Decrypt_data($body), true);
    }

    private function get_TOKEN()
    {
        return  $this->generateRandom(22) . ':' . $this->generateRandom(9) . '-' . $this->generateRandom(20) . '-' . $this->generateRandom(12) . '-' .    $this->generateRandom(7) . '-' . $this->generateRandom(7) . '-' . $this->generateRandom(53) . '-' . $this->generateRandom(9) . '_' . $this->generateRandom(11) . '-' . $this->generateRandom(4);
    }


    public function Encrypt_data($data, $key)
    {
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $this->keys = $key;
        return base64_encode(openssl_encrypt(is_array($data) ? json_encode($data) : $data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
    }

    public function Decrypt_data($data)
    {

        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return openssl_decrypt(base64_decode($data), 'AES-256-CBC', $this->keys, OPENSSL_RAW_DATA, $iv);
    }

    public function generateCheckSum($type, $microtime)
    {
        $Encrypt =   $this->config["phone"] . $microtime . '000000' . $type . ($microtime / 1000000000000.0) . 'E12';
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return base64_encode(openssl_encrypt($Encrypt, 'AES-256-CBC', $this->config["setupKeyDecrypt"], OPENSSL_RAW_DATA, $iv));
    }

    private function get_pHash()
    {
        $data = $this->config["imei"] . "|" . $this->config["password"];
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return base64_encode(openssl_encrypt($data, 'AES-256-CBC', $this->config["setupKeyDecrypt"], OPENSSL_RAW_DATA, $iv));
    }

    public function get_setupKey($setUpKey)
    {
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return openssl_decrypt(base64_decode($setUpKey), 'AES-256-CBC', $this->config["ohash"], OPENSSL_RAW_DATA, $iv);
    }

    private function get_SECUREID($length = 17)
    {
        $characters = '0123456789abcde';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateImei()
    {
        return $this->generateRandomString(8) . '-' . $this->generateRandomString(4) . '-' . $this->generateRandomString(4) . '-' . $this->generateRandomString(4) . '-' . $this->generateRandomString(12);
    }

    private function generateRandomString($length = 20)
    {
        $characters = '0123456789abcde';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function generateRandom($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function get_microtime()
    {
        return round(microtime(true) * 1000);
    }
}
