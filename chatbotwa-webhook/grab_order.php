<?php



    class whatsAppBot{
    //specify instance URL and token
    var $APIurl = 'http://eu19.chat-api.com/instance53243/';
    // var $APIurl = 'http://api.chat-api.com/instance53244/';
    var $token = '6o15kym7hd1sqk49';
    // var $pesan='';
//     public function __construct(){
//     //get the JSON body from the instance
//     $json = file_get_contents('php://input');
//     $decoded = json_decode($json,true);
//     //write parsed JSON-body to the file for debugging
//     ob_start();
//     var_dump($decoded);
//     $input = ob_get_contents();
//     ob_end_clean();
//     file_put_contents('input_requests.log',$input.PHP_EOL,FILE_APPEND);
                            
//     if(isset($decoded['messages'])){
//         //check every new message
//     foreach($decoded['messages'] as $message){
//         //delete excess spaces and split the message on spaces. The first word in the message is a command, other words are parameters
//         $text = explode(' ',trim($message['body']));
//         //current message shouldn't be send from your bot, because it calls recursion
    
        
//     if(!$message['fromMe'] ){
//     //check what command contains the first word and call the function
//     // $input = mb_strtolower($text[0],'UTF-8';
//     $input1 = mb_strtolower($text[0], 'UTF-8');
//     $input2 = mb_strtolower($text[1], 'UTF-8');
//     $input3 = mb_strtolower($text[2], 'UTF-8');
//     $input4 = mb_strtolower($text[3], 'UTF-8');
//     $input5 = mb_strtolower($text[4], 'UTF-8');
//     $input6 = mb_strtolower($text[5], 'UTF-8');
//     $input7 = mb_strtolower($text[6], 'UTF-8');
//     switch($input1){
//     case 'hi':  {$this->welcome($message['chatId'],false); break;}
//     case 'help':     {$this->help($message['chatId']); break;}
//     case 'move':     {$this->update_pemimpin($message['chatId'],$input1,$input2,$input3); break;}
//     case 'update':     {$this->update_kelompok($message['chatId'],$input1,$input2,$input3); break;}
//     case 'grab':     {$this->grab($message['chatId'],$input1,$input2); break;}
//     // case 'insert#users':     {$this->insert_users($message['chatId'],$input1,$input2,$input3,$input4,$input5); break;}
//     case 'reg':     {$this->insert_users($message['chatId'],$input1,$input2,$input3,$input4); break;}
    
//     case 'up':     {$this->update_users($message['chatId'],$input1,$input2,$input3,$input4,$input5,$input6); break;}

// //dev 07082019
// // case 'report':     {$this->report($message['chatId']); break;}
    


//     //REG NAMA KELOMPOK
//     // case 'view#users':     {$this->users_kelompok($message['chatId'],$input1,$input2); break;}
//     // case 'grab#order':     {$this->grab_order($message['chatId']); break;}
//     // case 'cek#stok':     {$this->cek_stok($message['chatId']); break;}
//     // case 'me':     {$this->me($message['chatId'],$message['senderName']); break;}
//         // case 'order':     {$this->order($message['chatId'],$message['senderName']); break;}
//         // case 'order':     {$this->order($message['chatId']); break;}
//     default:        {$this->default($message['chatId']); break;}
//         }
        
//     }}
//     }
//     }// end of __construct

    //this function calls function sendRequest to send a simple message
    //@param $chatId [string] [required] - the ID of chat where we send a message
    //@param $text [string] [required] - text of the message
    public function welcome($chatId, $noWelcome = false){
        date_default_timezone_set('Asia/Jakarta');
        // 24-hour format of an hour without leading zeros (0 through 23)
        $Hour = date('H');
        
        if ( $Hour >= 5 && $Hour <= 10 ) {
            $pesan= "Semangat Pagi..!!!";
        } else if ( $Hour >= 11 && $Hour <= 15 ) {
            $pesan= "Selamat Siang";
        } else if ( $Hour >= 16 && $Hour <= 18 ) {
            $pesan= "Selamat Sore";
        } else {
            $pesan= "Selamat Malam.....";
        }

    require_once 'users.php';
    $users = new users();
        // $nama='XYZ';
        // $kontak='6287711086938';
    $kontak=str_replace('@c.us','',$chatId);
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
    $this->sendMessage($chatId,
    // $welcomeString.
    "Hai...".$nama." \n".
    "".$pesan." \n".
    " \n".
    "Anda Terdaftar dalam kelompok ".strtoupper($kelompok)." \n".
    "Dengan No ".$kontak." \n".
    "-------------------------------------------------------\n".
    "Untuk melakukan pemesan Voucher Grab \n".
    "ketik GRAB <spasi> ORDER \n".    
    "--------------------------------------------------------\n".                                       
    "Butuh bantuan? --> ketik help \n".                                                
    "Ditanya aja Mas.. \n".                                                
    "--------------------------------------------------------"
                                          
    );
    }else{

        $this->sendMessage($chatId,
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
        "Ditanya aja Mas... \n".                                                
        "--------------------------------------------------------"                                      
        );
        

    }

    }

//dev 01082019
public function default($chatId){
    date_default_timezone_set('Asia/Jakarta');
    // 24-hour format of an hour without leading zeros (0 through 23)
    $Hour = date('H');
    
    if ( $Hour >= 5 && $Hour <= 10 ) {
        $pesan= "Semangat Pagi..!!!";
    } else if ( $Hour >= 11 && $Hour <= 15 ) {
        $pesan= "Selamat Siang";
    } else if ( $Hour >= 16 || $Hour <= 18 ) {
        $pesan= "Selamat Sore";
    } else if ( $Hour >= 19 || $Hour <= 4 ) {
        $pesan= "Selamat Malam";
    }

require_once 'users.php';
$users = new users();
    // $nama='XYZ';
    // $kontak='6287711086938';
$no_kontak=str_replace('@c.us','',$chatId);
$res = $users->get_detail($kontak);
$nama=$res[0]['nama'];


$res5 = $users->get_users($no_kontak);
$ada_kontak = count($res5['kontak']);

// $res6 = $users->get_kelompok(strtoupper($input3));
// $ada_kelompok = count($res6['kelompok']);

// if($ada_kontak>0 && $chatId='6287711086938@c.us'){
// if($ada_kontak>0 && $chatId='6281330526862@c.us'){
//     // $welcomeString = ($noWelcome) ? "Upps..Typo bro..\n" : "Hi.. ".$nama."   \n";
// $this->sendMessage($chatId,
// // $welcomeString.
// "--------------------------------------------------------\n".                                       
// "ANDA BENAR... \n".                                                
// "--------------------------------------------------------"                                      
// );
// }
// elseif($ada_kontak>0 && $chatId='628155085678@c.us' ){
//     // $welcomeString = ($noWelcome) ? "Upps..Typo bro..\n" : "Hi.. ".$nama."   \n";
//     $this->sendMessage($chatId,
//     // $welcomeString.    
//     "--------------------------------------------------------\n".                                       
//     "Silahkan tanya Apih Mi.. \n".                                                
//     "--------------------------------------------------------"                                      
//     );
// }else
if($ada_kontak>0 ){

    // if($chatId='628155085678@c.us'){
         
    //         $this->sendMessage($chatId,  
    //         "--------------------------------------------------------\n".                                       
    //         "Silahkan tanya Apih Mi.. \n".                                                
    //         "--------------------------------------------------------"                                      
    //         );
        
    //     }else{

//dev 0208019 kirim stiker
require_once 'kirim_stiker.php';
$kirim_stiker = new kirim_stiker();
    // $nama='XYZ';
    // $kontak='6287711086938';
$no_kontak=str_replace('@c.us','',$chatId);
$res = $kirim_stiker->siap($no_kontak);




/*

$this->sendMessage($chatId,
// $welcomeString.

// "Hi...".$nama." \n".
// "".$pesan." \n".
// " \n".
// "Dengan Saya DiMas bisa Dibantu Mas / Mba.. ??? \n".
// "-------------------------------------------------------\n".
// "Untuk melakukan pemesan Voucher Grab \n".
// "ketik GRAB <spasi> ORDER \n".    
// "--------------------------------------------------------\n".                                       
// "Butuh bantuan? --> ketik help \n".                                                
// "--------------------------------------------------------"                                      
"sedang mengetik...."                                      
);
 */

    // }
        
}else{
//belum terdaftar default

$this->sendMessage($chatId,
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
"Ditanya aja Mas... \n".                                                
"--------------------------------------------------------"                                      
);


}

}




//dev 25072019
    public function grab($chatId,$input1,$input2){

    // dev 28072019
    require_once 'users.php';
    $users = new users();
    $no_kontak=str_replace('@c.us','',$chatId);
    $res5 = $users->get_users($no_kontak);
    $ada_kontak = count($res5['kontak']);

    // $res6 = $users->get_kelompok(strtoupper($input3));
    // $ada_kelompok = count($res6['kelompok']);

    if($ada_kontak>0){

        switch(mb_strtolower($input2)){
            //  case 'hi':  {$this->welcome($chatId,false); break;}

            //  case 'help':     {$this->help($chatId); break;}

            case 'order':    {
                $this->grab_order($chatId);             
            break;}

            case 'info':    {
                $this->grab_info($chatId);             
            break;}
            
            case 'stok':    {
                $this->cek_stok($chatId);             
            break;}
            
            case 'report':    {
                $this->grab_report($chatId);             
            break;}
            
            default:        {$this->welcome($chatId,true); break;}
                }

        // $this->grab_order($chatId);             

    }else{


                                    $text2=
    "Upps.. \n".
    "-------------------------------------------------------\n".
    "No Anda Belum terdaftar silahkan Registrasi Terlebih dahulu untuk melakukan order  \n".
    "ketik REG <spasi> NAMA <spasi> KELOMPOK \n".    
    // "--------------------------------------------------------\n".                                       
    // "butuh bantuan? --> ketik help \n".                                                
    "--------------------------------------------------------";
                                    $data = array('chatId'=>$chatId,'body'=>$text2);
                                    $this->sendRequest('message',$data);

    }

    // $order = ($input2!='order') ? "Incorrect command\n" : "ORDER \n";
    // $this->sendMessage($chatId,
    // "------DEV------------------------------------------\n".
    // "GRAB#ORDER --> UNTUK ORDER GRAB  \n".
    // "INPUT 1 :".$input1."  \n".    
    // "INPUT 2 :".$input2."  \n".
    // "===>> :".$order."  \n".                     
    // "------- \n".
    // "-----------------------------------------------------"
    // );
}



public function help($chatId){
    
    $this->sendMessage($chatId,
    
    // "KETIK UP<spasi>NAMA_BARU<spasi>NO_BARU<spasi>KELOMPOK_BARU<spasi>[1/2]<spasi>62111111111 \n".                                               
    // "KETIK GRAB<spasi>STOK \n".                                               
    "--------------------------------------------------------\n".                                       
    "#untuk order voucher grab  \n".
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

// public function report($chatId){
    
    //     $this->sendMessage($chatId,
    
    //     // "KETIK UP<spasi>NAMA_BARU<spasi>NO_BARU<spasi>KELOMPOK_BARU<spasi>[1/2]<spasi>62111111111 \n".                                               
    //     // "KETIK GRAB<spasi>STOK \n".                                               
    
    //     'http://34.85.53.9:1111/report.php' 
    //     );
    
    //     }
    

    public function grab_order($chatId_pengirim){
        // public function grab($chatId_pengirim,$input1,$input2){
        $kontak_pengirim =str_replace('@c.us','',$chatId_pengirim);
        
        //Kode Grab aktif                                
        require_once 'kode_grab.php';
        require_once 'users.php';
        require_once 'order_grab.php';
        $grab = new kode_grab();
        $users = new users();
        $order_grab = new order_grab();
        $res = $grab->view_aktif();
        $kode_grab =$res[0]['kode_grab'];
        $expired =$res[0]['expired'];
        $id_kode_grab =$res[0]['id'];
        
        $res2 = $users->get_users($kontak_pengirim);
        $nama_pengirim =$res2['nama'];
        $level_pengirim =$res2['level'];
        $kelompok_pengirim =$res2['kelompok'];

        //dev 28072019
        if($level_pengirim==1){
        // jika level pemimpin akan dikirim ke pemimpin sup

            $res1 = $users->get_pemimpin_sup();
            $kontak_pemimpin =$res1[0]['kontak'];
            $nama_pemimpin =$res1[0]['nama'];
            $kelompok =$res1[0]['kelompok'];  

            
        }else{

            $res1 = $users->get_pemimpin($kontak_pengirim);
            $kontak_pemimpin =$res1[0]['kontak'];
            $nama_pemimpin =$res1[0]['nama'];
            $kelompok =$res1[0]['kelompok'];  
        }


    $chatId_pemimpin=$kontak_pemimpin.'@c.us';    
    // // $nomer_tujuan_pemesan=$no_kontak_pemesan.'@c.us'; 
    //CEK VOCHER YG TIDAK TERPAKAI
$cek = $order_grab->cek_belum_terpakai($kontak_pengirim);
$belum_terpakai = $cek[0]['belum_terpakai'];
$detail_kode_grab = $order_grab->detail_belum_terpakai($kontak_pengirim);
// $belum_terpakai = $cek[0]['kode_grab'];
    


//if($belum_terpakai>5){}else{}
    // PROSES ORDER
    
    
    
    if($belum_terpakai>=5){
      

// pesan ke pengirim 
$this->sendMessage($chatId_pengirim,

"-------------------------------------------------\n".
"Silahkan gunakan voucher yang belum terpakai\n".
"Request By     :".$nama_pengirim."  \n".
"Kelompok       :".$kelompok_pengirim."  \n".
"🏎️🏎️🏎️🏎️🏎️🏎️🏎️\n".
"----------------------------------------------------"
);


    foreach($detail_kode_grab as $data){
        $this->sendMessage($chatId_pengirim,   
        $data['kode_grab']

    );            

    }
        
    }else{

$res3 = $order_grab->insert($kontak_pengirim,$kontak_pemimpin,$id_kode_grab);        
// PROSES UPDATE kode_grab
$res4 = $grab->update($id_kode_grab);
//pesan ke pengirim 
$this->sendMessage($chatId_pengirim,

"-------------------------------------------------\n".
"Request By    :".$nama_pengirim."  \n".
// "Nama           :".$nama_pengirim."  \n".
"Kelompok       :".$kelompok_pengirim."  \n".
"🏎️🏎️🏎️🏎️🏎️🏎️🏎️\n".
"----------------------------------------------------"
);

//kirim kode yang taerbaru
    $this->sendMessage($chatId_pengirim,
    $kode_grab);    



//kirim kode yang udah diorder
foreach($detail_kode_grab as $data){
    $this->sendMessage($chatId_pengirim,   
    $data['kode_grab']
);            

}

//pesan ke pemimpin
// ?? jika level dgm / gm


// $this->sendMessage($chatId_pemimpin,
// "-------------------------------------------------\n".
// "Request By    :".$kontak_pengirim."  \n".
// "Nama           :".$nama_pengirim."  \n".
// "Kelompok       :".$kelompok_pengirim."  \n".
// "🏎️🏎️🏎️🏎️🏎️🏎️🏎️\n".
// "-------------------------------------------------- \n".
// "Kode Grab      :".$kode_grab."  \n".
// "----------------------------------------------------"
// );    
    
    // print_r('OK');
    
    }

 }

public function cek_stok($chatId){
        
        require_once 'kode_grab.php';
        $kode_grab = new kode_grab();
        $res5 = $kode_grab->view_stok();
        $stok=$res5[0]['stok'];
        $this->sendMessage($chatId,
    
        "------STOK KODE GRAB------------------------\n".
        "STOK   :".$stok."  \n".
        "----------------------------------------------"
        );
        }

//dev 0208019 grab report
public function grab_report($chatId){
        
// dev 0208019 kirim file
require_once 'kirim_file.php';
$kirim_file = new kirim_file();
$no_kontak=str_replace('@c.us','',$chatId);
// $no_kontak='6287711086938';
$res = $kirim_file->report($no_kontak);

    

    }





    //dev 28072019
    public function grab_info($chatId){
        
    require_once 'order_grab.php';
    $order_grab = new order_grab();
    $no_kontak=str_replace('@c.us','',$chatId);
    // $kontak='6287711086938';
    $result = $order_grab->get_order_grab($no_kontak);
    $nama=$result['nama'];
    $kontak=$result['kontak'];
    $kelompok=$result['kelompok'];
    $jumlah=$result['jumlah'];


    $this->sendMessage($chatId,

    "------INFO ORDER------------------------\n".
    "NAMA       :".$nama."  \n".
    "KONTAK     :".$kontak."  \n".
    "KELOMPOK   :".$kelompok."  \n".
    "JUMLAH     :".$jumlah."  \n".
    "----------------------------------------------"
    );

 }



//dev 25072019
// public function users_kelompok($chatId,$input1,$input2){
                                    
//     require_once 'users.php';
//     $users = new users();
//     // // $nama='XYZ';
//     // $kelompok='DEV';
//     $result = $users->get_all_kelompok($input2);
//     $this->sendMessage($chatId,
//         foreach($result as $data) {

//     "------STOK KODE GRAB------------------------\n".
//     "NAMA   :".$data['nama']."  \n".
//     "----------------------------------------------"
// }
//     );
//     }                                    

    public function insert_users($chatId,$input1,$input2,$input3,$input4){
     
         if($input4==1){
             $level=1;
         }else{
             $level=2;
         }

     require_once 'users.php';
     $users = new users();
     $no_kontak=str_replace('@c.us','',$chatId);

     // dev26072019                        
     // $res5 = $users->insert(strtoupper($input2),$no_kontak,strtoupper($input3));
     $res5 = $users->get_users($no_kontak);
     $ada_kontak = count($res5['kontak']);

     $res6 = $users->get_kelompok(strtoupper($input3));
     $ada_kelompok = count($res6['kelompok']);
     
     if($ada_kontak>0){
         
         $proses = "KONTAK SUDAH TERDAFTAR \n";
         // $proses = ($ada_kontak==0) ? "KONTAK BELUM TERDAFTAR \n" : "KONTAK SUDAH TERDAFTAR \n";
         
     }elseif($ada_kelompok==0 && $level==2){
         $proses =  "NAMA KELOMPOK SALAH \n";
         // $proses = ($ada_kelompok==0) ? "KELOMPOK BELUM TERDAFTAR \n" : "KELOMPOK SUDAH TERDAFTAR \n";

     }else{

         //insert(NAMA,NO_KONTAK,NAMA_KELOMPOK,LEVEL);
         $res7 = $users->insert(strtoupper($input2),$no_kontak,strtoupper($input3),$level);
         $proses = ($res7=false) ? "GAGAL \n" : "SUCCESS \n";
         
     }                        



         $this->sendMessage($chatId,
     
         // "------------------------------------------------\n".
         "==>>>>".$proses."  \n".
         "Anda Terdaftar Dalam Kelompok ".strtoupper($input3)."  \n".
         // "------".$input3."  \n".
         // "------".$input4."  \n".
         // "------".$input5."  \n".
         // "------- \n".
         "-----------------------------------------------------"
         );
    //dev
    $res1 = $users->get_pemimpin($no_kontak);
    $kontak_pemimpin =$res1[0]['kontak'];
    // $nama_pemimpin =$res1[0]['nama'];
    $kelompok =$res1[0]['kelompok']; 
    $chatId_pemimpin=$kontak_pemimpin.'@c.us';   


    $this->sendMessage($chatId_pemimpin,
                                
    "-----------NEW REGISTER--------------------------------------\n".
    "No Kontak      :".$no_kontak."  \n".
    "Nama           :".$input2."  \n".
    "Kelompok       :".$input3."  \n".
    // "No Pemimpin    :".$kontak_pemimpin."  \n".
    // "Nama Pemimpin  :".$nama_pemimpin."  \n".
    // "-------------------------------------------------- \n".
    // "Kode Grab      :".$kode_grab."  \n".
    // "Expired        :".$expired."  \n".
    // "QTY      :".$input3."  \n".
    // "".$id_kode_grab."  \n".
    "----------------------------------------------------"
    );
    //==========

}





//dev 28072019
//jika pemimpin       --> UPDATE  NAMA KONTAK KELOMPOK LEVEL WHERE_KOTAK
//jika bukan pemimpin --> UPDATE  NAMA KONTAK KELOMPOK 
public function update_users($chatId,$input1,$nama_update,$kontak_update,$kelompok_update,$level,$where_kontak){


    $kontak_pengirim =str_replace('@c.us','',$chatId);

    require_once 'users.php';
    $users = new users();
    $res2 = $users->get_users($kontak_pengirim);
    // $nama_pengirim =$res2['nama'];
    $level_user =$res2['level'];    
//cek level kontak
// jika level 1  level=1 else level=2
// $level_user=2;   
if($level_user==1){
    $level_update=$level;
    $where_kontak_update=$where_kontak;
}else{
    $level_update=2;
    $where_kontak_update=str_replace('@c.us','',$chatId);
}


$result = $users->update($nama_update,$kontak_update,$kelompok_update,$level_update,$where_kontak_update);

if($result){
    $this->sendMessage($chatId,

    "--------------------------------------------------------\n".                                       
    "--------------------------------------------------------\n".                                       
    "    ".$chatId." \n".
    "UPDATE    ".$input1." \n".
    // "SET ".$input3." \n".
    "NAMA    ".$nama_update." \n".
    "KONTAK    ".$kontak_update." \n".
    "KELOMPOK    ".$kelompok_update." \n".
    "LEVEL   ".$level_update." \n".
    "NO_KONTAK_UPDATE    ".$where_kontak_update." \n".
    "--------------------------------------------------------"
    );
    
}else{


    $this->sendMessage($chatId,

    "--------------------------------------------------------\n".                                       
    "GAGAL UPDATE     \n".
    "--------------------------------------------------------"
    );


}
    
    }



    public function update_pemimpin($chatId_pemimpin_lama,$input1,$input2,$no_kontak_pemimpin_baru){
            
        $no_kontak_pemimpin_lama=str_replace('@c.us','',$chatId_pemimpin_lama);
        // $no_kontak_pemimpin_baru=$input3;
        $chatId_pemimpin_baru=$no_kontak_pemimpin_baru.'@c.us'; 
        require_once 'users.php';
        $users = new users();
        $users->update_pemimpin($no_kontak_pemimpin_lama,$no_kontak_pemimpin_baru);
        //kirim ke pemimpin lama
        $this->sendMessage($chatId_pemimpin_lama,
        "--------------------------------------------------------\n".                                      
        "DATA PEMIMPIN KELOMPOK TERUPDATE  \n".
        "Request By    :".$no_kontak_pemimpin_lama."  \n". 
        "--------------------------------------------------------"
        );

        //kirim ke pemimpin lama
        $this->sendMessage($chatId_pemimpin_baru,
        "--------------------------------------------------------\n".                                       
        "DATA PEMIMPIN KELOMPOK TERUPDATE  \n".
        "Request By    :".$no_kontak_pemimpin_lama."  \n". 
        "--------------------------------------------------------"
        );
        

        }    


        public function update_kelompok($chatId,$input1,$input2,$kelompok_baru){
            
            $no_kontak=str_replace('@c.us','',$chatId);
            // $kelompok_baru=$input2;
            require_once 'users.php';
            $users = new users();


            $users->update_kelompok($no_kontak,strtoupper($kelompok_baru));
            //kirim ke pemimpin lama
            $this->sendMessage($chatId,
            "--------------------------------------------------------\n".                                      
            "DATA TERUPDATE  \n".
            "Anda terdaftar dalam kelompok :".strtoupper($kelompok_baru)."  \n". 
            "--------------------------------------------------------"
        );
        
        // $result2 = $users->get_detail_pemimpin_kelompok($kelompok_baru);
        // $no_kontak_pemimpin_baru=$result2[0]['kontak'];
        // $chatId_pemimpin_baru=$no_kontak_pemimpin_baru.'@c.us'; 
        

            // //kirim ke pemimpin baru
            // $this->sendMessage($chatId_pemimpin_baru,
            // "--------------------------------------------------------\n".                                       
            // "DATA  KELOMPOK BARU TERUPDATE  \n".
            // "Request By    :".$no_kontak_pemimpin_lama."  \n". 
            // "--------------------------------------------------------"
            // );
            
    
            }   

// =====================================================================================
// dev 31072019
//====================================================================================
//dev 01082019
// public function sendMessage($chatId, $text){

//         $data = array('chatId'=>$chatId,'body'=>$text);
//         $this->sendRequest('message',$data);


// }

//=======


                        public function sendMessage($chatId, $text){

                            
                            // require_once 'users.php';
                            // $users = new users();
                            // $no_kontak=str_replace('@c.us','',$chatId);
    
                            // // dev26072019
                            // $res5 = $users->get_users($no_kontak);
                            // $ada_kontak = count($res5['kontak']);
    

                            
                            // if($ada_kontak>0){                                
                                $data = array('chatId'=>$chatId,'body'=>$text);
                                $this->sendRequest('message',$data);
//                             }else{
                                
//                                 $text2=
// "Saya Bimo bisa Dibantu .. ? \n".
// "-------------------------------------------------------\n".
// "No Anda Belum terdaftar silahkan Registrasi Terlebih dahulu   \n".
// "ketik REG<spasi>NAMA<spasi>KELOMPOK \n".    
// // "--------------------------------------------------------\n".                                       
// // "butuh bantuan? --> ketik help \n".                                                
// "--------------------------------------------------------";
//                                 $data = array('chatId'=>$chatId,'body'=>$text2);
//                                 $this->sendRequest('message',$data);
                                        
//                             }
                    
                        }

                        public function sendRequest($method,$data){
                        $url = $this->APIurl.$method.'?token='.$this->token;
                        if(is_array($data)){ $data = json_encode($data);}
                        $options = stream_context_create(['http' => [
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/json',
                        'content' => $data]]);
                        $response = file_get_contents($url,false,$options);
                        file_put_contents('requests.log',$response.PHP_EOL,FILE_APPEND);}
                    }
                        //execute the class when this file is requested by the instance
                        // $wabot = new whatsAppBot();
                        // $no_kontak=$_GET['no'];
                        // print_r($no_kontak);die();
                        // $no_kontak='6287711086938';
                                // $chatId_pengirim=$no_kontak.'@c.us';  
                                // $wabot->grab_order($chatId_pengirim);
                        
                        
                        print_r('INPUT NO PEMESAN 62..... <br/>');                        
                        ?>


<?php
// define variables and set to empty values
// $no_kontak = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $wabot = new whatsAppBot();
        // $no_kontak=$_GET['no'];

        $no_kontak = $_POST["no"];
        // $no_kontak = test_input($_POST["no"]);

        $chatId_pengirim=$no_kontak.'@c.us';  
        $wabot->grab_order($chatId_pengirim);
    echo "<script>alert('Terkirim '.$no_kontak);</script>";
}
// else{
//     echo "<script>alert('KO');</script>";


// }

// function test_input($data) {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }
?>

                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                        <input type="text" name='no'><br>
                        <input type="submit" name="submit" value="Kirim"><br>
                        <form>
                        <?php// echo $_POST["no"]; ?>
