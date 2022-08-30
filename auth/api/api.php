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
    $action= check_string($_POST['action']);
      $ten_api = check_string($_POST['ten_api']);
    $link_callback   = check_string($_POST['link_callback']);
    $token_api     = check_string($_POST['token_api']);
  
  if($action=="them_api"){
      

  
    if(empty($ten_api)){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Thiếu mục tên API !";
        die(json_encode($return));
    }
     if(empty($token_api)){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Thiếu token API !";
        die(json_encode($return));
    }
   
     
          $api_token = api_token();
    $user_api = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '".$url_site_name."' ");
    
    
    if($token_api!==$user_api['token']){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "API không hợp lệ !";
        die(json_encode($return));
    }
    
    
     if($LTT->num_rows(" SELECT * FROM `list_api` WHERE `username` = '".$user_api['username']."' ") >= 3)
                                {
                                   $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Bạn đã thêm tối đã API !";
        die(json_encode($return));
                                }
     if(empty($api_token)){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Thiếu API Token !";
        die(json_encode($return));
    }
    
    if(!$user_api){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "API Token không hợp lệ !";
        die(json_encode($return));
    }
    
    else{
          $create = $LTT->insert("list_api", [
            'username'      => $user_api['username'],
            'token'          => $token_api,
            'name_api' => $ten_api,
            'link_callback'       => $link_callback,
            'date'     => gettime(),
           
          
            'status'        => 'wait',
        
             'url_config'          => $url_site_name
        ]);
     
        if($create){
          

$data = array( 
'email' => $user_api['email'], 
'subject' => 'TÍCH HỢP API', 
'noidung' => '<h2>Thông Báo</h2>
        
        <h3>Nội Dung: Chúng tôi đã nhận được đơn yêu tích hợp API của bạn, chúng tôi sẽ có thông báo khi duyệt API này.</h3><br>
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
        $return['message']   = "Thêm tích hợp thành công !";
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
    if($action=="set_apier"){
         $api_token = api_token();
    $checkusite = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$api_token'  AND  `url_config` = '".$url_site_name."' ");
    
    if(empty($api_token)){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Thiếu API Token";
        die(json_encode($return));
    }
    
    if(!$checkusite){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "API Token không hợp lệ";
        die(json_encode($return));
    }
    
    if($checkusite['capbac'] != 99){
        $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Bạn không phải ADMIN !";
        die(json_encode($return));
    }
    $action2= check_string($_POST['action2']);
        $id= check_string($_POST['id']);
       $token = check_string($_POST['token']);
         $check_name = $LTT->get_row(" SELECT * FROM `users` WHERE `token` = '$token'  AND  `url_config` = '".$url_site_name."' ");
        
        if($action2=="duyet"){
            
        
          $update = $LTT->update("list_api", [
        'status' => 'active'
   ], " `id` = '$id' AND  `token` = '$token' ");
        
         if($update){
              $data = array( 
'email' => $check_name['email'], 
'subject' => 'TÍCH HỢP API', 
'noidung' => '<h2>Thông Báo</h2>
        
        <h3>Nội Dung: Chúng tôi đã đã duyệt api của bạn.</h3><br>
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
        $return['message']   = "Duyệt thành công !";
        die(json_encode($return));
        }else{
             $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Lỗi Hệ Thống !";
        die(json_encode($return));
        }
        
        }
        if($action2=="block"){
            
        
          $update = $LTT->update("list_api", [
        'status' => 'block'
   ], " `id` = '$id' AND  `token` = '$token' ");
        
         if($update){
               $return['status'] = true;
        $return['error'] = false;
        $return['message']   = "Khoá thành công !";
        die(json_encode($return));
        }else{
             $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Lỗi Hệ Thống !";
        die(json_encode($return));
        }
        
        }
        if($action2=="mo"){
            
        
          $update = $LTT->update("list_api", [
        'status' => 'active'
   ], " `id` = '$id' AND  `token` = '$token' ");
        
         if($update){
               $return['status'] = true;
        $return['error'] = false;
        $return['message']   = "Mở thành công !";
        die(json_encode($return));
        }else{
             $return['status'] = false;
        $return['error'] = true;
        $return['message']   = "Lỗi Hệ Thống !";
        die(json_encode($return));
        }
        
        }
       
        
        
    }
  
   
      
   
    
    
   
     
      
}