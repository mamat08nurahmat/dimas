<?php

class kirim_pesan_all_user{

    var $APIurl = 'https://api.chat-api.com/instance53243/';
    var $token = '6o15kym7hd1sqk49';

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
//=======================================
// require_once 'order_notif.php';
// $return = $order_notif->kirim_pemesan();

// print_r($return);
/*
*/
require_once 'order_grab.php';
// require_once 'kirim_pesan_all_user.php';
$order_grab = new order_grab();

$all_users = $order_grab->all_users();
$kirim_pesan_all_user = new kirim_pesan_all_user();

// print_r($belum_notif);die();



if(isset($all_users)){


    $text = 
    // "Anda Terdaftar dalam kelompok ".strtoupper($kelompok)." \n".
    "--------------------------------------------------------\n".
    // "PEMBERITAHUAN\n".
    // "--------------------------------------------------------\n".
    "Selamat Pagi...\n".
    "Dimas sudah sehat kembali...😎😎😎😎\n".
    "Proses Pemesanan voucher grab bisa lewat saya lagi ...\n".
    "+6281932477899\n".
    "".
    "Terimakasih...\n".
    "--------------------------------------------------------\n".                                       
    "Butuh bantuan? --> ketik help \n".                                                
    "Ditanya aja Mas.. \n".                                                
    "--------------------------------------------------------"
    ;

    // $kirim_pesan_all_user->sendMessage('6287813056474',$text); //testing
    // $kirim_pesan_all_user->sendMessage('6281973480077',$text); //testing

//---------------
foreach($all_users as $data):
    // echo $data["no_pemesan"].'<br>';


    
    // $kirim_pesan_all_user->sendMessage('6281973480077',$text); //testing

    $kirim_pesan_all_user->sendMessage($data["kontak"],$text);

    // $kirim_pesan_all_user->sendMessage($data["no_pemimpin"],$text);
    // $order_grab->update_notif($data["Trip_Code"]);
echo $data["kontak"]." ( ".$data["nama"]." ) --> is send notif"."<br>";
endforeach;
//---------------


print_r('isset');
}else{
    print_r('no set');
    
}


?>
