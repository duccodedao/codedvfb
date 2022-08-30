<?php require('../../config/function.php');

if ( $_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /****
       Up to you which header to send, some prefer 403 even if 
       the files does exist for security
    ****/
    /**** header( 'HTTP/1.0 403 Not Found', TRUE, 403 ); ****/
    /**** include('403.html'); ****/
    include('../../../pages/error405.php');
            // $return['status'] = false;
            // $return['error'] = 'error';
            // $return['msg']   = 'Method GET not allowed!';
            // die(json_encode($return));
    /**** choose the appropriate page to redirect users ****/

}else{
    
      $loai_ho_tro = check_string($_POST['loai_ho_tro']);
    $tieu_de_ho_tro    = check_string($_POST['tieu_de_ho_tro']);
    $id_ho_tro      = check_string($_POST['id_ho_tro']);
    $noi_dung_ho_tro      = check_string($_POST['noi_dung_ho_tro']);
    if(empty($loai_ho_tro)){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Thiếu mục loại hỗ trợ !";
        die(json_encode($return));
    }
     if(empty($tieu_de_ho_tro)){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Thiếu tiêu đề hỗ trợ !";
        die(json_encode($return));
    }
     if(empty($noi_dung_ho_tro)){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Thiếu nội dung cần hỗ trợ !";
        die(json_encode($return));
    }
     
          $api_token = api_token();
    $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '".$url_site_name."' ");
    
     if(empty($api_token)){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Thiếu API Token !";
        die(json_encode($return));
    }
    
    if(!$checkusite){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "API Token không hợp lệ !";
        die(json_encode($return));
    }
    else{
          $create = $LTT->insert("list_hotro", [
            'username'      => $checkusite['username'],
            'loai_hotro'          => $loai_ho_tro,
            'tieu_de_hotro' => $tieu_de_ho_tro,
            'id_hotro'       => $id_ho_tro,
            'date'     => gettime(),
            'noi_dung_hotro	'     => $noi_dung_ho_tro,
            'noi_dung_xuly'   => '',
          
            'status'        => 'wait',
        
             'url_config'          => $url_site_name
        ]);
        apitele('
'.$LTT->site("ten_website").' 
THÔNG BÁO MỚI
Có Thành Viên Gửi Yêu Cầu Hỗ Trợ
Tài Khoản: '.$checkusite['username'].' 
Loại Hỗ Trợ: '.$loai_ho_tro.'
Tiêu Đề Hỗ Trợ: '.$tieu_de_ho_tro.'
Nội Dung: '.$noi_dung_ho_tro.'
               ');
        if($create){
          

$data = array( 
'email' => $checkusite['email'], 
'subject' => 'XỬ LÝ HỖ TRỢ', 
'noidung' => '<h2>Thông Báo</h2>
        
        <h3>Nội Dung: Chúng tôi đã nhận được đơn yêu cầu hỗ trợ của bạn, chúng tôi sẽ phản hồi trong thời gian sớm nhất.</h3><br>
    <font color="#e34d4d">Cảm ơn bạn đã tin dùng dịch vụ của chúng tôi !</font>
     ' 
); 
 $head = array( 
 "user-agent: Mozilla/5.0 (Linux; Android 11; Redmi Note 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Mobile Safari/537.36" 
 ); 
 $url="https://".strtolower($url_site_name)."/auth/tools/mail.php";
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $head); 

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
curl_setopt($ch, CURLOPT_ENCODING, true); 
   $login_data = json_decode(curl_exec($ch)); 
   curl_close($ch); 
 

           
            
            
             $return['status'] = true;
        $return['error'] = false;
        $return['message']   = "Tạo hỗ trợ thành công !";
        die(json_encode($return));
        
        }
        else{
             $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Tạo hỗ trợ thất bại !";
        die(json_encode($return));
        }
        
        
        
        
        
    }
   
  
   
      
   
    
    
   
     
      
}