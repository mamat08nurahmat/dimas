<?php

class chat_api{

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

$chat_api = new chat_api();
require_once 'order_grab.php';
$order_grab = new order_grab();
require_once 'users.php';
$users = new users();
//tes dev
$kontak_pemimpin='6287711086938';

$res = $users->get_detail($kontak_pemimpin);
$nama=$res[0]['nama'];
$kelompok=$res[0]['kelompok'];
$level=$res[0]['level'];

//function grab info tim
$grab_info_tim = $order_grab->grab_info_tim($kelompok);

// print_r($grab_info_tim);die();

// [nama] => ROMMY
// [no_pemesan] => 628179972606
// [kelompok] => SMN
// [jumlah] => 1
// [total_fare] => 115500
// [bulan] => 8

// $chatId_pemimpin=$kontak_pemimpin.'@c.us';   

//----
foreach($grab_info_tim as $data):
$text = 
// "Anda Terdaftar dalam kelompok ".strtoupper($kelompok)." \n".
"📋📋📋📋📋📋📋📋📋📋📋📋📋📋\n".
"Grab Info TIM ".$kelompok." \n".
"--------------------------------------------------------\n".
// $looping1.
"😎 Nama           : ".$data["nama"]."\n".
"📞 Kontak      : ".$data["no_pemesan"]."\n".
"📇 jumlah Voucher : ".$data["jumlah"]."\n". 
"💰 Total          : Rp. ".number_format(str_replace(".00","",$data["total_fare"]))."\n".
"📅 Bulan          : ".$data["bulan"]."\n". 
// "\n".
// "Kode Voucher : ".$data["Trip_Code"]."\n". 
// "\n".
// "Pick Up : ".$data["Pick_Up"]."\n". 
// "( ".$data["Pickup_Date"]." )\n".
// "\n".
// "Drop Off: ".$data["Drop_Off"]."\n". 
// "( ".$data["Dropoff_Date"]." )\n". 
// "\n". 
// "Total 💳   : Rp. ".number_format(str_replace(".00","",$data["fare"]))."\n".
// // "--------------------------------------------------------"."\n";

// "--------------------------------------------------------\n".                                       
// "Butuh bantuan? --> ketik help \n".                                                
// "Ditanya aja Mas.. \n".                                                
"--------------------------------------------------------"
;
$chat_api->sendMessage($kontak_pemimpin,$text);
endforeach;



print_r('tes dev grab info tim');die();
/*
require_once 'order_grab.php';
$order_grab = new order_grab();
require_once 'users.php';
$users = new users();
// $no_kontak=str_replace('@c.us','',$chatId);
// $no_kontak='62816204646';
$no_kontak='6287711086938';
// $result = $order_grab->get_order_grab($no_kontak);
// $jumlah=$result['jumlah'];

$res = $users->get_detail($no_kontak);


$nama=$res[0]['nama'];
$kelompok=$res[0]['kelompok'];
$level=$res[0]['level'];


$result = $order_grab->report_ymd($no_kontak,$kelompok,$level);
$count_ytd = $result[0]['COUNT_YTD'];
$total_ytd = $result[0]['TOTAL_YTD'];
// print_r($result);die();

// $sudah_detail = $order_grab->sudah_terpakai_detail($no_kontak);
$belum_detail = $order_grab->belum_terpakai_detail($no_kontak);

// print_r($sudah_detail);die();

$jumlah_belum = $order_grab->belum_terpakai($no_kontak);
$jumlah_belum = $jumlah_belum[0]['jumlah'];

$this->sendMessage($chatId,

"------INFO Voucher Grab------------------------\n".
"Nama       :".$nama."  \n".
"Kontak     :".$no_kontak."  \n".
"Kelompok   :".$kelompok."  \n".
"----------------------------------------------\n".
"Jumlah Sudah Terpakai YTD  :".$count_ytd."  \n".
"Jumlah Belum Terpakai YTD  :".$jumlah_belum."  \n".
"----------------------------------------------\n".
"Total YTD  :".$total_ytd."  \n".
"----------------------------------------------\n".

// "----------------------------------------------\n".
// "Jumlah Sudah Terpakai   :".$jumlah_sudah."  \n".
// "Jumlah Belum Terpakai   :".$jumlah_belum."  \n".
"----------------------------------------------"
);
*/ 



?>