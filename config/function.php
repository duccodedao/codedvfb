
<?php

include $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$LTT = new LTT;
$api_momo = $LTT->site('api_automm');
$my_user  = $getUser['username'];
$base_url = 'https://' . $_SERVER['SERVER_NAME'] . '/';
$user_auto_dvfb = $LTT->site('user_auto_dvfb');
$pass_auto_dvfb = $LTT->site('pass_auto_dvfb');
$token_auto_dvfb = $LTT->check('token_auto_dvfb');
$url_site_name = strtoupper($_SERVER['SERVER_NAME']);
$token_auto_site = $LTT->site('token_autodv');
$URL_ADMIN = $LTT->check('url_admin');
$lam_tron = $LTT->site('trang_thai_lam_tron');
$token_fb = $LTT->site('token_facebook');
$themes_landing = $LTT->site('theme_landing');
$themes_login = $LTT->site('theme_login');
$theme_home = $LTT->site('theme_home');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function check_oders($code, $token, $link){
    $data = array(
        'code_orders' => $code
    );
    $head =array(
        'api-token: '.$token,
        'Content-Type: application/json'
    );
    $url = 'https://thuycute.hoangvanlinh.vn/'.$link;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => $head,
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response, true);
    return $result;
}


if ($LTT->check_ip(getip()) == "block") {
    header('Location: /BAND-IP');
    exit;
}
if ($LTT->getUsers('capbac') == 0) {
    $chietkhau = $LTT->site('ck_user');
    $level = 'Thành Viên';
} elseif ($LTT->getUsers('capbac') == 1) {
    $chietkhau = $LTT->site('ck_ctv');
    $level = 'Cộng Tác Viên';
} elseif ($LTT->getUsers('capbac') == 2) {
    $chietkhau = $LTT->site('ck_dl');
    $level = 'Đại Lý';
} elseif ($LTT->getUsers('capbac') == 3) {
    $level = 'Nhà Phân Phối';
    $chietkhau = $LTT->site('ck_npp');
} elseif ($LTT->getUsers('capbac') == "99") {
    $chietkhau = "0";
    $level = 'Quản Trị Viên';
} else {
    #
}
function getCurURL()
{
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL = "https://";
    } else {
        $pageURL = 'http://';
    }
    if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}




function get_don(){}

function typepass2($string)
{
    return base64_encode(urlencode(md5(urlencode(base64_encode(base64_encode(md5(md5(md5(md5(base64_encode(md5(base64_encode(md5(base64_encode(json_encode(array("user" => base64_encode($string), "admin" => "Nguyễn Tiến Đạt", "kieumahoa" => "ntiendat"))))))))))))))))) . "=";
}

function apitelegram($message, $token_bot, $id_chat)
{



    $url = "https://api.telegram.org/bot$token_bot/sendMessage?chat_id=$id_chat&text=" . urlencode($message) . "";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
}

function apitele($message)
{
    global $LTT;
    $url = "https://api.telegram.org/bot" . $LTT->site('bot_tele') . "/sendMessage?chat_id=" . $LTT->site('id_chat_tele') . "&text=" . urlencode($message) . "";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
}
$rand = rand(10000, 99999);
$timenow = date("d/m/Y - H:i:s");
function format_date($time)
{
    return date("d-m-Y H:i:s", $time);
}
function format_money($number)
{
    return number_format($number);
}

$callback_cardvip = $LTT->site('base_url') . 'api/callback_cardvip.php';

function levelmem($number)
{
    if ($number == 0) {
        return 'Thành Viên';
    } elseif ($number == 1) {
        return 'Cộng Tác Viên';
    } elseif ($number == 2) {
        return 'Đại Lý';
    } elseif ($number == 4) {
        return 'Nhà Phân Phối';
    } elseif ($number == 3) {
        return 'Quản Trị Viên';
    } else {
        #
    }
}

function sitenapthe($sitenap)
{
    if ($sitenap == 'thesieure') {
        return 'THESIEURE';
    } elseif ($sitenap == 'theviet') {
        return 'THEVIET';
    } elseif ($sitenap == 'trumgachthe') {
        return 'TRUMGACHTHE';
    } elseif ($sitenap == 'thesieuviet') {
        return 'THESIEUVIET.VN';
    } elseif ($sitenap == 'gachthe1s') {
        return 'GACHTHE1S';
    } else {
        return 'Chưa xác định';
    }
}

function sttservice($number)
{
    if ($number == '0') {
        return '<button type="button" class="btn btn-danger btn-sm">Bảo trì</button>';
    } elseif ($number == '1') {
        return '<button type="button" class="btn btn-success btn-sm">Hoạt động</button>';
    } elseif ($number == '2') {
        return '<button type="button" class="btn btn-warning btn-sm">Bảo trì</button>';
    } else {
        return 'Chưa xác định';
    }
}

function statusorder($number)
{
    if ($number == 'Success') {
        return '<button type="button" class="badge bg-success bg-sm bg-dim">Đã hoàn thành</button>';
    } elseif ($number == 'Pause') {
        return '<button type="button" class="btn btn-danger btn-sm">Đã hủy</button>';
    } elseif ($number == 'Report') {
        return '<button type="button" class="btn btn-warning btn-sm">Tạm dừng</button>';
    } elseif ($number == 'Refund') {
        return '<button type="button" class="btn btn-success btn-sm">Đã hoàn tiền</button>';
    } elseif ($number == 'Waiting') {
        return '<button type="button" class="btn btn-warning btn-sm">Chờ hủy</button>';
    } elseif ($number == 'Expired') {
        return '<button type="button" class="btn btn-danger btn-sm">Đã hết hạn</button>';
    } elseif ($number == 'CookieDie') {
        return '<button type="button" class="btn btn-danger btn-sm">Cookie die</button>';
    } elseif ($number == 'ProxyError') {
        return '<button type="button" class="btn btn-warning btn-sm">Proxy lỗi</button>';
    } elseif ($number == 'Pendding') {
        return '<button type="button" class="btn btn-warning btn-sm">Đang chờ</button>';
    } elseif ($number == 'DiePause') {
        return '<button type="button" class="btn btn-warning btn-sm">Đã Xảy Ra Lỗi</button>';
    } else {
        return '<button type="button" class="btn btn-info btn-sm">Đang hoạt động</button>';
    }
}

function msg_success($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(96).'", "'.$text.'","success");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function statuscard($number)
{
    if ($number == '0') {
        return '<button type="button" class="btn btn-warning btn-sm">Đang xử lý</button>';
    } elseif ($number == '1') {
        return '<button type="button" class="btn btn-success btn-sm">Thẻ đúng</button>';
    } elseif ($number == '2') {
        return '<button type="button" class="btn btn-danger btn-sm">Thẻ sai</button>';
    } else {
        return '<button type="button" class="btn btn-info btn-sm">Khác</button>';
    }
}
$site_gmail = $LTT->site('mail_config');
$site_pass = $LTT->site('pass_mail_config');
function sendCSM($mail_nhan, $ten_nhan, $chu_de, $noi_dung, $bcc)
{
    global $LTT;
    
    try {
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $LTT->site('mail_config');;
        $mail->Password   = $LTT->site('pass_mail_config');                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port       = 465;
        $mail->setFrom($LTT->site('mail_config'), $bcc);
        $mail->addAddress($mail_nhan, $ten_nhan);           
        $mail->addReplyTo($LTT->site('mail_config'), $bcc);
        $mail->addCC($mail_nhan);
        $mail->addBCC($mail_nhan);
        $mail->isHTML(true);                                  
        $mail->Subject = $chu_de;
        $mail->Body    = $noi_dung;
        $mail->CharSet = 'UTF-8';
        $send = $mail->send();
        return $send;
    } catch (Exception $e) {
        return "Failed";
    }
}

function BASE_URL($url)
{
    global $base_url;
    return $base_url . $url;
}

function gettime()
{
    return date('Y-m-d H:i:s');
}
function check_string($data)
{
    return (trim(htmlspecialchars(addslashes($data))));
}
function format_cash($price)
{
    return str_replace(",", ".", number_format($price));
}
function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);

    curl_close($ch);
    return $data;
}
function random($string, $int)
{
    return substr(str_shuffle($string), 0, $int);
}
function check_img($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("png", "jpeg", "jpg", "PNG", "JPEG", "JPG", "gif", "GIF");
    if (in_array($ext, $valid_ext)) {
        return true;
    }
}

function XoaDauCach($text)
{
    return trim(preg_replace('/\s+/', ' ', $text));
}

function getHeader()
{
    $headers = array();
    $copy_server = array(
        'CONTENT_TYPE'   => 'Content-Type',
        'CONTENT_LENGTH' => 'Content-Length',
        'CONTENT_MD5'    => 'Content-Md5',
    );
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) === 'HTTP_') {
            $key = substr($key, 5);
            if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                $headers[$key] = $value;
            }
        } elseif (isset($copy_server[$key])) {
            $headers[$copy_server[$key]] = $value;
        }
    }
    if (!isset($headers['Authorization'])) {
        if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
            $basic_pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
            $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
        } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
            $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
        }
    }
    return $headers;
}


function callback($callback, $ketqua, $requestid)
{
    return curl_get("$callback?ketqua=$ketqua&requestid=$requestid");
}
function check_username($data)
{
    if (preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $data, $matches)) {
        return true;
    } else {
        return false;
    }
}
function check_email($data)
{
    if (preg_match('/^.+@.+$/', $data, $matches)) {
        return true;
    } else {
        return false;
    }
}
function check_phone($data)
{
    if (preg_match('/^\+?(\d.*){3,}$/', $data, $matches)) {
        return true;
    } else {
        return false;
    }
}
function check_number($data)
{
    return is_numeric($data);
}
function check_url($url)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_HEADER, 1);
    curl_setopt($c, CURLOPT_NOBODY, 1);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_FRESH_CONNECT, 1);
    if (!curl_exec($c)) {
        return false;
    } else {
        return true;
    }
}
function check_zip($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("zip", "ZIP");
    if (in_array($ext, $valid_ext)) {
        return true;
    }
}

function typepass($string)
{
    return base64_encode(urlencode(md5(urlencode(base64_encode(base64_encode(md5(md5(md5(md5(base64_encode(md5(base64_encode(md5(base64_encode(json_encode(array("user" => base64_encode($string), "admin" => "Nguyễn Tiến Đạt", "kieumahoa" => "ntiendat")))))))))))))))));
}
function phantrang($url, $start, $total, $kmess)
{
    $out[] = '<nav aria-label="Page navigation example"><ul class="pagination pagination-lg">';
    $neighbors = 2;
    if ($start >= $total) $start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
    else $start = max(0, (int)$start - ((int)$start % (int)$kmess));
    $base_link = '<li class="page-item"><a class="page-link" href="' . strtr($url, array('%' => '%%')) . 'page=%d' . '">%s</a></li>';
    $out[] = $start == 0 ? '' : sprintf($base_link, $start / $kmess, '<i class="fas fa-angle-left"></i>');
    if ($start > $kmess * $neighbors) $out[] = sprintf($base_link, 1, '1');
    if ($start > $kmess * ($neighbors + 1)) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    for ($nCont = $neighbors; $nCont >= 1; $nCont--) if ($start >= $kmess * $nCont) {
        $tmpStart = $start - $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    $out[] = '<li class="page-item active"><a class="page-link">' . ($start / $kmess + 1) . '</a></li>';
    $tmpMaxPages = (int)(($total - 1) / $kmess) * $kmess;
    for ($nCont = 1; $nCont <= $neighbors; $nCont++) if ($start + $kmess * $nCont <= $tmpMaxPages) {
        $tmpStart = $start + $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    if ($start + $kmess * ($neighbors + 1) < $tmpMaxPages) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    if ($start + $kmess * $neighbors < $tmpMaxPages) $out[] = sprintf($base_link, $tmpMaxPages / $kmess + 1, $tmpMaxPages / $kmess + 1);
    if ($start + $kmess < $total) {
        $display_page = ($start + $kmess) > $total ? $total : ($start / $kmess + 2);
        $out[] = sprintf($base_link, $display_page, '<i class="fas fa-angle-right"></i>');
    }
    $out[] = '</ul></nav>';
    return implode('', $out);
}

function getip()
{
    return $_SERVER['REMOTE_ADDR'];
}?>



<?php
function api_token()
{
    $headers = array();
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers['Api-Token'];
}

function x_csrf_token()
{
    $headers = array();
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers['X-Csrf-Token'];
}





function xoa_dau($str = null)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|E)/", 'e', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|U)/", 'u', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ|Y)/", 'y', $str);
    $str = preg_replace("/(Đ)/", 'd', $str);
    $str = preg_replace("/(Q)/", 'q', $str);
    $str = preg_replace("/(R)/", 'r', $str);
    $str = preg_replace("/(T)/", 't', $str);
    $str = preg_replace("/(Y)/", 'y', $str);
    $str = preg_replace("/(I)/", 'i', $str);
    $str = preg_replace("/(O)/", 'o', $str);
    $str = preg_replace("/(P)/", 'p', $str);
    $str = preg_replace("/(A)/", 'a', $str);
    $str = preg_replace("/(S)/", 's', $str);
    $str = preg_replace("/(D)/", 'd', $str);
    $str = preg_replace("/(F)/", 'f', $str);
    $str = preg_replace("/(G)/", 'g', $str);
    $str = preg_replace("/(H)/", 'h', $str);
    $str = preg_replace("/(J)/", 'j', $str);
    $str = preg_replace("/(K)/", 'k', $str);
    $str = preg_replace("/(L)/", 'l', $str);
    $str = preg_replace("/(Z)/", 'z', $str);
    $str = preg_replace("/(X)/", 'x', $str);
    $str = preg_replace("/(C)/", 'c', $str);
    $str = preg_replace("/(V)/", 'v', $str);
    $str = preg_replace("/(B)/", 'b', $str);
    $str = preg_replace("/(N)/", 'n', $str);
    $str = preg_replace("/(M)/", 'm', $str);
    $str = preg_replace("/(W)/", 'w', $str);
    $str = preg_replace("/( )/", '', $str);
    return $str;
}

function cardvip($telCo, $amount, $pin, $serial, $requestId, $partner_key, $callback_cardvip)
{
    $dataPost = array(
        'APIKey' => $partner_key,
        'NetworkCode' => $telCo,
        'PricesExchange' => $amount,
        'NumberCard' => $pin,
        'SeriCard' => $serial,
        'IsFast' => 'true',
        'RequestId' => $requestId,
        'UrlCallback' => $callback_cardvip
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://partner.cardvip.vn/api/createExchange',
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
    $jsonData = json_decode($response, true);

    return $jsonData;
}

function minify_output($buffer)
{
    $search = array(
        '/\>[^\S ]+/s',
        '/[^\S ]+\</s',
        '/(\s)+/s'
    );
    $replace = array(
        '>',
        '<',
        '\\1'
    );

    if (preg_match("/\<html/i", $buffer) == 1 && preg_match("/\<\/html\>/i", $buffer) == 1) {
        $buffer = preg_replace($search, $replace, $buffer);
    }

    return $buffer;
}

function trumthe($telCo, $amount, $pin, $serial, $requestId, $partner_id, $partner_key)
{
    $url = 'https://trumthe.vn/chargingws/v2?sign=' . md5($partner_key . $pin . $serial) . '&telco=' . $telCo . '&code=' . $pin . '&serial=' . $serial . '&amount=' . $amount . '&request_id=' . $requestId . '&partner_id=' . $partner_id . '&command=charging';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    $jsonData = json_decode($data, true);
    return $jsonData;
}

function thesieure($telCo, $amount, $pin, $serial, $requestId, $partner_id, $partner_key)
{
    $url = 'https://thesieure.com/chargingws/v2?sign=' . md5($partner_key . $pin . $serial) . '&telco=' . $telCo . '&code=' . $pin . '&serial=' . $serial . '&amount=' . $amount . '&request_id=' . $requestId . '&partner_id=' . $partner_id . '&command=charging';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    $jsonData = json_decode($data, true);
    return $jsonData;
}
function trumgachthe($telCo, $amount, $pin, $serial, $requestId, $partner_id, $partner_key)
{
    $url = 'https://trumgachthe.net/chargingws/v2?sign=' . md5($partner_key . $pin . $serial) . '&telco=' . $telCo . '&code=' . $pin . '&serial=' . $serial . '&amount=' . $amount . '&request_id=' . $requestId . '&partner_id=' . $partner_id . '&command=charging';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    $jsongetData = json_decode($data, true);
    return $jsongetData;
}
function theviet($loaithe, $pin, $seri, $menhgia, $code)
{
    global $LTT;
    if ($loaithe == 'VNMOBI' || $loaithe == 'vietnamobile' || $loaithe == 'VIETNAMOBILE') {
        $loaithe = 16;
    }
    if ($loaithe == 'VIETTEL' || $loaithe == 'Viettel ') {
        $loaithe = 1;
    }
    if ($loaithe == 'MOBIFONE' || $loaithe == 'Mobifone') {
        $loaithe = 2;
    }
    if ($loaithe == 'VINAPHONE' || $loaithe == 'Vinaphone') {
        $loaithe = 3;
    }
    if ($loaithe == 'ZING' || $loaithe == 'Zing') {
        $loaithe = 14;
    }
    $dataPost = array(
        'ApiKey'    => $LTT->site('partner_key'),
        'Pin'       => $pin,
        'Seri'      => $seri,
        'CardType'  => $loaithe,
        'CardValue' => $menhgia,
        'requestid' => $code
    );
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://theviet.net/api/card',
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
    return json_decode($response, true);
}

// function lam_tron($number)
// {
//     if ($lam_tron == "ON") {
//         $gia_tien = ceil($number + $number * $chietkhau / 100);

//         return ($gia_tien);
//     } else {
//         $gia_tien = $number + $number * $chietkhau / 100;

//         return ($gia_tien);
//     }
// }

function check_mien($mien)
{
    $url = "https://api.builtwith.com/free1/api.json?KEY=e907846b-7ac2-44e2-ae86-a394262ecdb7&LOOKUP=$mien";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($data, true);
    if ($json['domain'] == strtolower($mien)) {
        return  true;
    } elseif ($json['Results'] == null) {
        return 400;
    }
}



function curl_thanhvu($path,$url,$post_data,$token){
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "$url",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"$post_data",
      CURLOPT_HTTPHEADER => array(
        "authority:thuycute.hoangvanlinh.vn",
       "path: $path",
        "cache-control: no-cache",
        "accept: application/json, text/javascript, */*; q=0.01",
        "x-requested-with: XMLHttpRequest",
        "user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.150 Mobile Safari/537.36",
        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
        "origin: https://thuycute.hoangvanlinh.vn",
        "sec-fetch-site: same-origin",
        "sec-fetch-mode: cors",
        "sec-fetch-dest: empty",
        "api-token: $token",
        "referer: $url"
        ),
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $response = curl_exec($curl);  
    return $response; 
        }

