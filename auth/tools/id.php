<?php
$data = array(
'link'=> $_GET['link']
);
 $head = array(
 "user-agent: Mozilla/5.0 (Linux; Android 11; Redmi Note 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Mobile Safari/537.36"
 );
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://id.traodoisub.com/api.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_ENCODING, true);
   $login_data =curl_exec($ch);
   curl_close($ch);
  $json= json_decode($login_data, true);
  if($json['code']==200){
      $return['status'] = true;
      $return['message']   = "Lấy thành công";
      $return['data']   = $json['id'];
      die(json_encode($return));
  }
  else
  {
       $return['status'] = false;
      $return['message']   = $json['error'];
   
      die(json_encode($return));
  }