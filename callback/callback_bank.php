
<?php
require('../config/function.php');
/**
API:
Phương thức: Post
Thông tin sẽ nhận về:
'so_tien' => Số tiền khách chuyển
'ten_bank' => Tên ngân hàng (bao gồm cả Momo)
'id_khach' => id khách của shop
'ten_khach' => Họ tên thật của khách. (nếu có)
'sdt_khach' => Số điện thoại thực của khách (nếu có),
'ma_gd' => Mã giao dịch lần bank đó.
'noi_dung' => Nội dung khách viết khi bank.
'soDu_bank' => Số dư bank hiện tại sau khi nhận tiền.
'thoi_gian' => Thời gian bank (theo ngân hàng)
'trans_id' => số id phân biệt mõi lần callback.
'ma_baoMat' => Mã bảo mật chỉ chỉ bên shop và botsms biết để xác thực với nhau. Tránh callback giả mạo.
 **/

$so_tien = $_POST['so_tien'];
$id_khach = $_POST['id_khach'];
$ma_baoMat = $_POST['ma_baoMat'];
if (!isset($_POST['so_tien']) || !isset($_POST['id_khach']) || !isset($_POST['ma_baoMat'])) {
    die('Thiếu tham số bắt buộc');
} else {
    $tien_chuyen = intval($_POST['so_tien']); // số tiền khách chuyển
    $so_tien = $tien_chuyen + $tien_chuyen * $LTT->site('nap_km_bank') / 100;
    $id_khach = $_POST['id_khach']; // id hoặc tên tài khoản (phần nội dung sau cú pháp quy ước)
    $ma_baoMat = $_POST['ma_baoMat']; // mã bảo mật so khớp 2 bên
    $trans_id = $_POST['trans_id']; // id giao dịch này là duy nhất.
    $noi_dung = $_POST['noi_dung']; // Nội dung khách ghi khi chuyển khoản
    $sdt_khach = $_POST['sdt_khach'];
    $ten_khach = $_POST['ten_khach'];
    $ten_bank = $_POST['ten_bank'];
    $ma_gd = $_POST['ma_gd'];
    $thoi_gian = $_POST['thoi_gian'];



    if ($ma_baoMat == $api_momo) {
        $createtien = $LTT->insert("history_naptien", [
            'date' => $thoi_gian,
            'type' => 'Bank',
            'loaithe' => $ten_bank,
            'username'      => $id_khach,
            'namemomo'       => $ten_khach,
            'phonemomo'         => $sdt_khach,
            'thucnhan'      => $so_tien,
            'trangthai'     => 1,

            'tranid'        => $ma_gd,
            'url_config'          => $url_site_name
        ]);
        if ($createtien) {
            $ghilog = $LTT->insert("log_site", [
                'username' => $id_khach,
                'note'          => ' Vừa nạp tiền ' . $ten_bank . ' với mệnh giá ' . $so_tien . ' vào lúc ' . gettime() . '',
                'ip'            => getip(),
                'date'          => gettime(),
                'url_config'          => $url_site_name
            ]);

            $update1 = $LTT->cong("users", "money", $so_tien, " `username` = '$id_khach' AND  `url_config` = '" . $url_site_name . "'");
            $update3 = $LTT->cong("users", "tongnap", $so_tien, " `username` = '$id_khach' AND  `url_config` = '" . $url_site_name . "'");
            $return['status'] = false;
            $return['error'] = true;
            $return['message']   = "thành công !";
            die(json_encode($return));
        }
    } elseif ($ma_baoMat !== $api_momo) {
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Không thành công !";
        die(json_encode($return));
    } else {

        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Không thành công !";
        die(json_encode($return));
    }
}
