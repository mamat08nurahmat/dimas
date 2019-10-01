<?php



require_once 'api.php';
$api = new api();

class module{
    



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
$this->api->sendMessage($kontak,
// $welcomeString.
"HiiiiYYYY.....😁 ".$nama." \n".
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

$api->sendMessage($kontak,
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



}
//========================DEV===============================  
// require_once 'module.php';
        $module = new module();
        $kontak='6287711086938';
        $module->welcome($kontak);
//========================DEV================================        
print_r('OK');die();
?>