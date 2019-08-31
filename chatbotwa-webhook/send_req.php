<?php

class send_req{

    var $APIurl = 'https://api.chat-api.com/instance53244/';
    var $token = 'oedqhd1jfewd5io0';

    public function sendRequest($method,$data){
        $url = $this->APIurl.$method.'?token='.$this->token;
        if(is_array($data)){ $data = json_encode($data);}
        $options = stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $data]]);
        $response = file_get_contents($url,false,$options);
        // file_put_contents('requests.log',$response.PHP_EOL,FILE_APPEND);
    
    }

    public function sendMessage($phone, $text){
                              
        $data = array('phone'=>$phone,'body'=>$text);
        $this->sendRequest('message',$data);
    }

    public function sendFile($phone, $file_url,$file_name,$caption){
                              
        $data = array('phone'=>$phone,'body'=>$file_url,'filename'=>$file_name,'caption'=>$caption);
        $this->sendRequest('sendFile',$data);
    }





}

// $send_req = new send_req();
// $phone='6287711086938';
// $text='xxxxxxxxxxx';
// $send_req->sendMessage($phone, $text);


$send_req = new send_req();
$phone='6287711086938';
$file_url = "http://" . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'].'/report.php';
$file_name='Report_Dimas.xls';
$caption='Report Dimas';
$send_req->sendFile($phone, $file_url,$file_name,$caption);

print_r('okkkk');die();

?>