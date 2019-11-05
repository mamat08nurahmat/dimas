<?php

class api{


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
//====================================================================================================
//====================================================================================================
//====================================================================================================


//================MODULE WELCOME====================
public function welcome($kontak){

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
    // $kontak='6287711086938';
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
    $this->sendMessage($kontak,
    // $welcomeString.
    "Hello.....😁 ".$nama." \n".
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
    
    $this->sendMessage($kontak,
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
        }

//================MODULE KIRIM STIKER MUGIWARA====================
public function kirim_stiker_mugiwara($phone){

        // $api = new api();
        // $phone='6287711086938';
        $file_url = "http://" . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'].'/mugiwara.png';
        $file_name='mugiwara.png';
        $caption='Zzzzzz...';
        $this->sendFile($phone, $file_url,$file_name,$caption);

}

//================MODULE HELP====================
public function help($kontak){
    $this->sendMessage($kontak,
    
    // "KETIK UP<spasi>NAMA_BARU<spasi>NO_BARU<spasi>KELOMPOK_BARU<spasi>[1/2]<spasi>62111111111 \n".                                               
    // "KETIK GRAB<spasi>STOK \n".                                               
    "😎😎😎💬💬💬💬💬💬\n".                                       
    "#untuk orDAS voucher grab  \n".
    "ketik GRAB<spasi>ORDER   \n".
    "--------------------------------------------------------\n".                                       
    "#untuk info order voucher grab  \n".
    "ketik GRAB <spasi> INFO   \n".
    "--------------------------------------------------------\n".                                       
    "#untuk registrasi user  \n".
    "ketik REG <spasi> NAMA <spasi> KELOMPOK \n".                                               
    "--> contoh  \n".                                               
    "REG TOPENG SPO  \n".                                               
    "--------------------------------------------------------\n".                                       
    "#untuk update kelompok  \n".
    "ketik UPDATE <spasi> KELOMPOK <spasi> KELOMPOK_BARU \n".                                               
    "--> contoh  \n".                                               
    "UPDATE KELOMPOK DSS  \n".                                               
    "--------------------------------------------------------\n".                                       
    "#untuk update pemimpin  \n".
    "ketik MOVE <spasi> PEMIMPIN <spasi> NO_PEMIMPIN_BARU \n".                                               
    "--> contoh  \n".                                               
    "MOVE PEMIMPIN 628123456789  \n".        
    "-------------------------------------------------------- \n".                                           
    "Keterangan Kelompok \n".
    "-------------------------------------------------------- \n".                                           
    "DSS  = DIRECT SALES \n".
    "TSS  = TELE SALES \n".
    "SUP  = SUPPORT \n".
    "BCS1 = BISNIS CORPORATE SALES 1 \n".
    "BCS2 = BISNIS CORPORATE SALES 2 \n".
    "BCS3 = BISNIS CORPORATE SALES 3 \n".
    "BCS4 = BISNIS CORPORATE SALES 4 \n".
    "SMN  = SALES MANAGEMENT \n".
    "SPO  = SALES PLANNING \n".
    "SCO  = SALES COMPANY \n".
    "SGV  = SALES GOVERMENT \n".
    "OBM  = OPTIMALISASI BISNIS MERCHANT \n".
    "-------------------------------------------------------- \n".                                       
    "Kirim ke Saya di 6281932477899 \n".
    "--------------------------------------------------------"
    );
}

//=====================================
//=====================================
}



// require_once 'api.php';
//=========TES DEV FUNCTION============================
// $api = new api();
// $kontak='6287711086938';
// $api->help($kontak);
//=========TES DEV FUNCTION============================

//dev 0208019 kirim stiker

        // $api = new api();
        // $phone='6287711086938';
        // $file_url = "http://" . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'].'/mugiwara.png';
        // $file_name='mugiwara.png';
        // $caption='Zzzzzz...';
        // $res = $api->sendFile($phone, $file_url,$file_name,$caption);
        // print_r($res);die();


//========================welcome

// date_default_timezone_set('Asia/Jakarta');
// // 24-hour format of an hour without leading zeros (0 through 23)
// $Hour = date('H');

// if ( $Hour >= 5 && $Hour <= 10 ) {
//     $pesan= "Semangat Pagi..🌅🌅🌅 ";
// } else if ( $Hour >= 11 && $Hour <= 15 ) {
//     $pesan= "Selamat Siang..☀️☀️☀️";
// } else if ( $Hour >= 16 && $Hour <= 18 ) {
//     $pesan= "Selamat Sore..🌇🌇🌇";
// } else {
//     $pesan= "Selamat Malam..🌜🌜🌜";
// }

// require_once 'users.php';
// $users = new users();
// // $nama='XYZ';
// $kontak='6287711086938';
// // $kontak=str_replace('@c.us','',$chatId);
// $res = $users->get_detail($kontak);
// $nama=$res[0]['nama'];

// $res1 = $users->get_pemimpin($kontak);
// $kontak_pemimpin =$res1[0]['kontak'];
// $nama_pemimpin =$res1[0]['nama'];
// $kelompok =$res1[0]['kelompok'];

// $res5 = $users->get_users($kontak);
// $ada_kontak = count($res5['kontak']);
// // $res6 = $users->get_kelompok(strtoupper($input3));
// // $ada_kelompok = count($res6['kelompok']);

// if($ada_kontak>0){

// // $welcomeString = ($noWelcome) ? "Upps..Typo bro..\n" : "Hi.. ".$nama."   \n";
// $api->sendMessage($kontak,
// // $welcomeString.
// "Haiiyy.....😁 ".$nama." \n".
// "".$pesan." \n".
// " \n".
// "Anda Terdaftar dalam kelompok ".strtoupper($kelompok)." \n".
// "Dengan No 📱 ".$kontak." \n".
// "-------------------------------------------------------\n".
// "Untuk melakukan pemesan Voucher Grab 🏎️🏎️🏎️\n".
// "ketik GRAB <spasi> ORDER \n".    
// "--------------------------------------------------------\n".                                       
// "Butuh bantuan? --> ketik help \n".                                                
// "Ditanya aja Mas..🙏🙏🙏 \n".                                                
// "--------------------------------------------------------"
                                  
// );
// }else{

// $api->sendMessage($kontak,
// // $welcomeString.
// "Hi..".$pesan." \n".
// "Saya Dimas \n".
// " \n".
// "Anda Belum kenalan dengan saya.. \n".
// "-------------------------------------------------------\n".
// "No Anda Belum terdaftar silahkan Registrasi Terlebih dahulu  \n".
// "ketik REG <spasi> NAMA <spasi> KELOMPOK \n".                                               
// "--------------------------------------------------------\n".                                       
// "Butuh bantuan? --> ketik help \n".                                                
// "Ditanya aja Mas...🙏🙏🙏  \n".                                                
// "--------------------------------------------------------"                                      
// );


// }

//========================        
//print_r('OK');die();
?>