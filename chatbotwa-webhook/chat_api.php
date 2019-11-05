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
//=======================================
// require_once 'order_notif.php';
// $return = $order_notif->kirim_pemesan();

// print_r($return);
/*
*/
require_once 'order_grab.php';
// require_once 'chat_api.php';
$order_grab = new order_grab();

$belum_notif = $order_grab->belum_notif_order();
$chat_api = new chat_api();

// print_r($belum_notif);die();

if(isset($belum_notif)){
//---------------
foreach($belum_notif as $data):
    // echo $data["no_pemesan"].'<br>';

    $text = 
    // "Anda Terdaftar dalam kelompok ".strtoupper($kelompok)." \n".
    "--------------------------------------------------------\n".
    "Order Grab Detail\n".
    "--------------------------------------------------------\n".
    // $looping1.
    "Nama    : ".$data["Name_Employee"]."\n".
    "Tujuan : ".$data["Trip_Description"]."\n". 
    "\n".
    "Kode Voucher : ".$data["Trip_Code"]."\n". 
    "\n".
    "Pick Up : ".$data["Pick_Up"]."\n". 
    "( ".$data["Pickup_Date"]." )\n".
    "\n".
    "Drop Off: ".$data["Drop_Off"]."\n". 
    "( ".$data["Dropoff_Date"]." )\n". 
    "\n". 
    "Total 💳   : Rp. ".number_format(str_replace(".00","",$data["Fare"]))."\n".
    // "--------------------------------------------------------"."\n";
    "--------------------------------------------------------\n".                                       
    "Butuh bantuan? --> ketik help \n".                                                
    "Ditanya aja Mas.. \n".                                                
    "--------------------------------------------------------"
    ;
    
    // $chat_api->sendMessage('6287711086938',$text); //testing
    $chat_api->sendMessage($data["no_pemesan"],$text);
    $chat_api->sendMessage($data["no_pemimpin"],$text);
    $order_grab->update_notif($data["Trip_Code"]);
echo $data["no_pemesan"]." ( ".$data["Name_Employee"]." ) --> is send notif"."<br>";
endforeach;
//---------------


print_r('isset');
}else{
    print_r('no set');
    
}


?>
