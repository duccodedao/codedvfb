<?php require('../../config/function.php');

if ( $_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /****
       Up to you which header to send, some prefer 403 even if 
       the files does exist for security
    ****/
    /**** header( 'HTTP/1.0 403 Not Found', TRUE, 403 ); ****/
    /**** include('403.html'); ****/
    include('../../pages/error405.php');
            // $return['status'] = false;
            // $return['error'] = 'error';
            // $return['msg']   = 'Method GET not allowed!';
            // die(json_encode($return));
    /**** choose the appropriate page to redirect users ****/

}else{
    
   if(empty(check_string($_POST['Link']))){
        $return['status'] = false;
        $return['error'] = true;
        $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Vui Lòng Nhập Link Cần Tìm !</strong></div>';
        $return['message']   = 'Vui Lòng Nhập Link Cần Tìm !';
        die(json_encode($return));
    }
     elseif(check_string($_POST['_token']) != x_csrf_token()){
            $return['status'] = false;
            $return['error'] = true;
            $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>Lỗi cookie, vui lòng load lại trang!</strong></div>';
            $return['message']   = 'error_request_response';
            die(json_encode($return));
        }
     
     
     else{
           $linkpost=$_POST['Link'];
    
         
$data = array(
'link'=> $linkpost
);
 $head = array(
 "user-agent: Mozilla/5.0 (Linux; Android 11; Redmi Note 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Mobile Safari/537.36"
 );
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://id.traodoisub.com/api.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_ENCODING, true);
   $login_data =curl_exec($ch);
   curl_close($ch);
   $json = json_decode($login_data, true);
   $checklink=$json['success'];
    $idfb=$json['id'];
  
  if($checklink=="200"){
      
               $return['status'] = true;
        $return['error'] = false;
        $return['data'] = '    <div class="container ">
                                            <center><h4 >Chúc mừng bạn đã tìm thành công!</h4></center></div>
                                        <br>
                                        <div class="container">
                                        <div class="row align-items-center">
                                        <div class="col-auto">
                                        <img src="https://graph.facebook.com/'.$idfb.'/picture?width=50&height=50&access_token=6628568379|c1e620fa708a1d5696fb991c1bde5662" alt="user" class="rounded-circle" width="60px">
                                        </div> 
                                        <div class="col">
                                         <div class="input-group">
                                      <input onclick="if (!window.__cfRLUnblockHandlers) return false; coppy("phone_momo_'.$idfb.'"  placeholder="'.$idfb.'" value="'.$idfb.'"  class="form-control input-id text-center" id="content_codeRecharge">
                                      &nbsp;
                                      <div class="input-group-prepend"></div><br>
                                        <div class="input-group-prepend">
                                            
                                        </div></div></div></div></div>
                                  
                                        <br><br>';
        die(json_encode($return));
  }
  else{
       $return['status'] = false;
        $return['error'] = true;
        $return['data'] = '<div class="alert alert-danger text-center" role="alert"><strong>'.$json['error'].'</strong></div><br>';
        $return['message']   = ''.$json['error'].'';
        die(json_encode($return));
  }
             
             
             
             
                                      
       
     }
  unlink('cookies.txt');
}