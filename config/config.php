
<?php

session_start();
ob_start('minify_output');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$namews = $_SERVER['SERVER_NAME'];
error_reporting(0);
define('SERVERNAME','localhost');
define('USERNAME','tshopdatvcom_taowebgame');
define('PASSWORD','tshopdatvcom_taowebgame');
define('DATABASE','tshopdatvcom_taowebgame');
$LeTuanTai = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE);
$LeTuanTai->query("set names 'utf8'");
class LTT
{
    private $ketnoi;
    function connect()
    {
        if (!$this->ketnoi)
        {
            $this->ketnoi = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die ('ERROR CONNECT !');
            mysqli_query($this->ketnoi, "set names 'utf8'");
            return $this;
        }
    }
    function dis_connect()
    {
        if ($this->ketnoi)
        {
            mysqli_close($this->ketnoi);
        }
    }
  
      
    


    function site($data)
    {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `setting` WHERE `url_config` = '".strtoupper($_SERVER['SERVER_NAME'])."' ")->fetch_array();
        return $row[$data];
    }
    
     function check($data)
    {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `options` WHERE `key` = '$data' ")->fetch_array();
        return $row['value'];
    }
     function check_ip($data)
    {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `band_ip` WHERE `ip_band` = '$data' AND `url_config` = '".strtoupper($_SERVER['SERVER_NAME'])."'")->fetch_array();
        return $row['status'];
    }
    
    
     function modal($data, $data2)
    {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `thong_bao_modal` WHERE `loai_tb` = '$data' AND `url_config` = '".strtoupper($_SERVER['SERVER_NAME'])."'")->fetch_array();
        return $row[$data2];
    }
    
    
    
    
    
    
    
    function getUsers($data)
    {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'  AND  `url_config` = '".strtoupper($_SERVER['SERVER_NAME'])."'")->fetch_array();
        return $row[$data];
    }
    
    function query($sql)
    {
        $this->connect();
        $row = $this->ketnoi->query($sql);
        return $row;
    }
    function cong($table, $data, $sotien, $where)
    {
        $this->connect();
        $row = $this->ketnoi->query("UPDATE `$table` SET `$data` = `$data` + '$sotien' WHERE $where ");
        return $row;
    }
    function tru($table, $data, $sotien, $where)
    {
        $this->connect();
        $row = $this->ketnoi->query("UPDATE `$table` SET `$data` = `$data` - '$sotien' WHERE $where ");
        return $row;
    }
    
        

    
    function insert($table, $data)
    {
        $this->connect();
        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value)
        {
            $field_list .= ",$key";
            $value_list .= ",'".mysqli_real_escape_string($this->ketnoi, $value)."'";
        }
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
 
        return mysqli_query($this->ketnoi, $sql);
    }
    function update($table, $data, $where)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value)
        {
            $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
        return mysqli_query($this->ketnoi, $sql);
    }
    function update_value($table, $data, $where, $value1)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value){
            $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where.' LIMIT '.$value1;
        return mysqli_query($this->ketnoi, $sql);
    }
    function remove($table, $where)
    {
        $this->connect();
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query($this->ketnoi, $sql);
    }
    function get_list($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Lỗi kết nối database ');
        }
        $return = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $return[] = $row;
        }
        mysqli_free_result($result);
        return $return;
    }
    function get_row($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Lỗi kết nối database 2');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }
    function num_rows($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Lỗi kết nối database 2');
        }
        $row = mysqli_num_rows($result);
        mysqli_free_result($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }
}

if(isset($_SESSION['username']))
{ 
    $LTT = new LTT;
    $getUser = $LTT->get_row(" SELECT * FROM users WHERE username = '".$_SESSION['username']."'  AND  `url_config` = '".strtoupper($_SERVER['SERVER_NAME'])."'");
    $my_username = 'True';
     $id  = $getUser['id'];
    $my_user  = $getUser['username'];
    $my_email  = $getUser['email'];
    $my_money = $getUser['money'];
    $my_level = $getUser['level'];
    $my_capbac = $getUser['capbac'];
    
    if(!$getUser)
    {
        session_start();
        session_destroy();
        header('location: /');
    }
    
    if($getUser['banned'] >= 1){
        die('Chúc mừng bạn đã bị banned vĩnh viễn vì đã vi phạm chính sách cộng đồng của chúng tôi');
        exit;
    }
    
    if ($getUser['money'] < 0)
    {
        $LTT->update("users", array(
            'banned' => 1
        ), "username = '$my_user' ");
        session_start();
        session_destroy();
        header('location: /');
        die();
    }
    
    
}
else
{
    $my_level = NULL;
    $my_money = 0;
}


function CheckAdmin()
{
    global $my_capbac;
    if($my_capbac != 99)
    {
        return die('<script type="text/javascript">setTimeout(function(){ location.href = "'.BASE_URL('').'" }, 0);</script>');
    }
}
