<?php

include_once __DIR__ . '/libs/simple_html_dom.php';
$access = true;
$dom = new simple_html_dom();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://thesieure.com/wallet/history/vnd',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=ujc63pvqph4lmeiknki6jh3uhu;lang_code=eyJpdiI6InVZV1lKcTFURUFxUDZETkdBT29FWkE9PSIsInZhbHVlIjoiNDdDNG03dlhiNlZJZlRHSEZ3ZWNUdz09IiwibWFjIjoiZDUyNzUxMjIzYzk1OThkZGNkMjhjMWZlMjgxYTJjMWVlMWJhZmM3YTYyMDJlYjY3MjJhNWVkZTlkOTk1ZDkyOCJ9; client_info=eyJpdiI6IkRkZFBueEE2eU9uNWJXXC9tcTZ3MW1nPT0iLCJ2YWx1ZSI6IjhwdGRmUVVqRm1MNDFxbWg4bDNyUWc9PSIsIm1hYyI6ImU3Mzk3MWI3ZWVhNjAzMTg1Yzc5MDkzNmU0NWJhMGRmMGZlNTUyZTM2ZWExNWVlNWRmYzJkZmUzYjc0MjNlNmIifQ%3D%3D; TCK=703c47931a1b46b184283865c8b441f4; user_secure=eyJpdiI6ImdJREZLZEh4Yjd1TXBza0o0NVFGOFE9PSIsInZhbHVlIjoiVFo5ZThaUWRhODJ6cjRpOXE2TldXaDByVUpCc0RZYWJNTmdVRDlFaEw1dGRtSzRqeWM4Nm9aSk9uUGtiKzBXbCIsIm1hYyI6ImMxNTYxYWE2M2NlMzIwNTU2NzQ4M2I3OGYzYzU4ZWViNDJlZjczZTcxOWNhOWRhZTA5MzY4OGQ2NmNiODBjOTQifQ%3D%3D; XSRF-TOKEN=eyJpdiI6ImgzWUQxdTlLVUpWU0Y1a0p0a1FCU0E9PSIsInZhbHVlIjoieW1nd1ZFNlBrUUNFM3VvUG1RQjZWMnl4RzRGSW9Ta3NjVXhmXC8zdVp3ekw2ZEVSMnA0RHJ3emg2cGNWRytwUTciLCJtYWMiOiI0YzllZmNlZWI0ODA5MDA0MjAzNDMxM2Y2YmEyNzdhNTM3MGU4NmEyZGI1YWNiZGE2ZWQ5MjQwMDI4OGM4M2JjIn0%3D; web_session=eyJpdiI6IjR2VzM0ZEJMYmw4MEdEeVRuSDNwR0E9PSIsInZhbHVlIjoib2RqMmlUeHBxakxyaGx1QjFNNDFLWklBQVFtN0pQVzBIQ2pQY3ZcLzhJMjNXcHRiZldGNVJnRnRBSVRETHNCOW0iLCJtYWMiOiIxYTMyZGIwNmFlNjQ5ZmI5OTgyMWRhYmZmMzM1YzliOTRkZjhmZGZjMjRjZWRmNGY3ZDkyMDI5NWEzNWExZGU3In0%3D;; PHPSESSID=7d04fmegv5kp6h3rms635ltkn4; TCK=3b46e2da4231b50f487a738f1420d80f; XSRF-TOKEN=eyJpdiI6IkVQaTg2MjdvbUlOKzZ3elJSaHlFXC93PT0iLCJ2YWx1ZSI6ImExUU9jRG9wd3cyXC9RSGZhcG4zT0J4UzByQW16anNlR21NXC9EM0tsdENrY2M2Z2N4K1JCXC9EbTZaenJZQkJua2YiLCJtYWMiOiI1MDgxYzBhZmFhMmRhMjM0NDg0NjE3YTMwZTVkZTA5NDM3ODg1MTQwNzVmNzUwNmY4ZDIyOGM0ZmE5ZmYyMGUxIn0%3D; client_info=eyJpdiI6IkZyc1dDcXVUSFhcL0hYUjFKQmVaQzRBPT0iLCJ2YWx1ZSI6ImdDdEZkK1BvcVZsV0VRbDBSZEtjNXc9PSIsIm1hYyI6ImE4NzNkMjMzMWMzMzQ4NmY5YTYxZTc3ZTFlMWQ3Y2NmNjYxYjdhMDViODU5ZTMyN2VmMmEyYzZhM2I5ZmVkMzkifQ%3D%3D; lang_code=eyJpdiI6IlNFZTBOam0yU2dSSVZ3RDVsUWtDaWc9PSIsInZhbHVlIjoiSWQ0UFU5eGk3R0ZsY0RDTlFRSDRtUT09IiwibWFjIjoiZTQ1MTI4MmMwZGRiNTUxYzM5MjYxYzcxMmZiN2I2NjY2MDUwYzBlZGRhZDdkOGI0MTQ4MDA4ZDQzMzc1MDVmZiJ9; web_session=eyJpdiI6IktMZ0ZSc0YyRlpIcHhTZ3Y2K2NFV3c9PSIsInZhbHVlIjoiOVY0aFBOeFpoSGJDSjhWRStoYUp4c3pWaGRBU3pScHV4cTNvXC9DbnFhalJBM04xWVc5UloyUVFXOUtlTFpSdEMiLCJtYWMiOiI3ZGE1ZDRmMjgyZmQ0MWI3NzBhNmFhMmVkYzhlMWJjNWU2NzY1NGNmNTNhMjU3N2QwMTFhYTJhMjJjYzYwMmQ5In0%3D',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.136 Safari/537.36'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

if (!empty($response)) {
  $Get_Table = str_get_html($response)->find('tbody', 0);
  header("Content-Type: application/json");
  // Xuất dữ liệu
  foreach ($Get_Table->find('tr') as $Data) {
    $Json_Datas[] = array(
      // Trạng thái trả về
      'trading_code' => $Data->find('td', 0)->plaintext,
      'before_money_cost' => $Data->find('td', 1)->plaintext,
      'amount' => $Data->find('td', 2)->plaintext,
      'io' => substr($Data->find('td', 2)->plaintext, 0, 1) . '1',
      'after_money_cost' => $Data->find('td', 3)->plaintext,
      'time_created' => $Data->find('td', 5)->plaintext,
      'status' => $Data->find('td', 4)->plaintext,
      'content_send' => explode('|||', $Data->find('td', 6)->plaintext)[0],
    );
  }
  // echo(json_encode($Json_Datas, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
}
