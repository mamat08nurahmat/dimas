<?php

class kirim_stiker{


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

//dev 0208019 kirim stiker
// require_once 'kirim_stiker.php';
        $kirim_stiker = new kirim_stiker();
        // $phone='6287711086938';
        // $file_url = "http://" . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'].'/mugiwara.png';
        // $file_name='mugiwara.png';
        // $caption='Zzzzzz...';
        // $res = $kirim_stiker->sendFile($phone, $file_url,$file_name,$caption);
        // print_r($res);die();


//========================welcome
date_default_timezone_set('Asia/Jakarta');
// 24-hour format of an hour without leading zeros (0 through 23)
$Hour = date('H');

if ( $Hour >= 5 && $Hour <= 10 ) {
    $pesan= "Semangat Pagi..🌅🌅🌅 ";
} else if ( $Hour >= 11 && $Hour <= 15 ) {
    $pesan= "Selamat Siang..☀️☀️☀️";
} else if ( $Hour >= 16 && $Hour <= 18 ) {
    $pesan= "Selamat Sore..🌇🌇🌇";
} else {
    $pesan= "Selamat Malam..🌜🌜🌜";
}

require_once 'users.php';
$users = new users();
// $nama='XYZ';
$kontak='6287711086938';
// $kontak=str_replace('@c.us','',$chatId);
$res = $users->get_detail($kontak);
$nama=$res[0]['nama'];

$res1 = $users->get_pemimpin($kontak);
$kontak_pemimpin =$res1[0]['kontak'];
$nama_pemimpin =$res1[0]['nama'];
$kelompok =$res1[0]['kelompok'];

$res5 = $users->get_users($kontak);
$ada_kontak = count($res5['kontak']);
// $res6 = $users->get_kelompok(strtoupper($input3));
// $ada_kelompok = count($res6['kelompok']);

if($ada_kontak>0){

// $welcomeString = ($noWelcome) ? "Upps..Typo bro..\n" : "Hi.. ".$nama."   \n";
$kirim_stiker->sendMessage($kontak,
// $welcomeString.
"Haiiyy.....😁 ".$nama." \n".
"".$pesan." \n".
" \n".
"Anda Terdaftar dalam kelompok ".strtoupper($kelompok)." \n".
"Dengan No 📱 ".$kontak." \n".
"-------------------------------------------------------\n".
"Untuk melakukan pemesan Voucher Grab 🏎️🏎️🏎️\n".
"ketik GRAB <spasi> ORDER \n".    
"--------------------------------------------------------\n".                                       
"Butuh bantuan? --> ketik help \n".                                                
"Ditanya aja Mas..🙏🙏🙏 \n".                                                
"--------------------------------------------------------"
                                  
);
}else{

$kirim_stiker->sendMessage($kontak,
// $welcomeString.
"Hi..".$pesan." \n".
"Saya Dimas \n".
" \n".
"Anda Belum kenalan dengan saya.. \n".
"-------------------------------------------------------\n".
"No Anda Belum terdaftar silahkan Registrasi Terlebih dahulu  \n".
"ketik REG <spasi> NAMA <spasi> KELOMPOK \n".                                               
"--------------------------------------------------------\n".                                       
"Butuh bantuan? --> ketik help \n".                                                
"Ditanya aja Mas...🙏🙏🙏  \n".                                                
"--------------------------------------------------------"                                      
);


}

//========================        
//print_r('OK');die();
?>