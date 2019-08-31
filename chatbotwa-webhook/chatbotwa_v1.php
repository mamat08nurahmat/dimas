<?php

// require_once 'kode.php';
// $kode = new kode();

// $input2="WOWOW";
// $input3="2019-12-31";

// $kode_grab=$input2;
// $expired=$input3;

// $hasil = $kode->insert($kode_grab,$expired);
// $result = ($hasil = false) ? "insert gagal \n" : "Insert Success \n";
// print_r($result);die();

                        class whatsAppBot{
                        //specify instance URL and token
                        var $APIurl = 'https://api.chat-api.com/instance53244/';
                        var $token = 'oedqhd1jfewd5io0';

                        public function __construct(){
                        //get the JSON body from the instance
                        $json = file_get_contents('php://input');
                        $decoded = json_decode($json,true);

                        //write parsed JSON-body to the file for debugging
                        ob_start();
                        var_dump($decoded);
                        $input = ob_get_contents();
                        ob_end_clean();
                        file_put_contents('input_requests.log',$input.PHP_EOL,FILE_APPEND);

                        if(isset($decoded['messages'])){
                        //check every new message
                        foreach($decoded['messages'] as $message){
                        //delete excess spaces and split the message on spaces. The first word in the message is a command, other words are parameters
                        $text = explode(' ',trim($message['body']));
                        //current message shouldn't be send from your bot, because it calls recursion
                        if(!$message['fromMe']){
                        //check what command contains the first word and call the function
                        // $input = mb_strtolower($text[0],'UTF-8';
                        $input1 = mb_strtolower($text[0], 'UTF-8');
                        $input2 = mb_strtolower($text[1], 'UTF-8');
                        $input3 = mb_strtolower($text[2], 'UTF-8');
                        $input4 = mb_strtolower($text[3], 'UTF-8');
                        switch(mb_strtolower($text[0],'UTF-8')){
                        case 'hi':  {$this->welcome($message['chatId'],false); break;}

                        case 'help':     {$this->help($message['chatId']); break;}

                        case 'grab':     {$this->grab($message['chatId'],$input1,$input2,$input3); break;}


                        case 'kontak#insert':     {$this->kontak_insert($message['chatId'],$input1,$input2,$input3,$input4); break;}
                        case 'kode#insert':     {$this->kode_insert($message['chatId'],$input1,$input2,$input3); break;}


                        case 'grab#order':     {$this->grab_order($message['chatId']); break;}
                        case 'grab#yes':     {$this->grab_yes($message['chatId']); break;}
                        case 'grab#no':     {$this->grab_no($message['chatId']); break;}
                        
                        case 'upgrade#me':     {$this->upgrade_me($message['chatId']); break;}
                        case 'upgrade#yes':     {$this->upgrade_yes($message['chatId']); break;}


                            // case 'me':     {$this->me($message['chatId'],$message['senderName']); break;}
                            // case 'order':     {$this->order($message['chatId'],$message['senderName']); break;}
                            // case 'order':     {$this->order($message['chatId']); break;}

                        default:        {$this->welcome($message['chatId'],true); break;}
                            }}

                        }}
                    }

                        //this function calls function sendRequest to send a simple message
                        //@param $chatId [string] [required] - the ID of chat where we send a message
                        //@param $text [string] [required] - text of the message
                        public function welcome($chatId, $noWelcome = false){
                        $welcomeString = ($noWelcome) ? "Incorrect command\n" : "Welcome to WhatsApp BNI SLN Tools \n";
                        $this->sendMessage($chatId,
                        $welcomeString.
                        "-------------------------------------------------------\n".
                        "Untuk melakukan pemesan  \n".
                        "ketik GRAB#ORDER \n".
                        "--------------------------------------------------------"
                        );
                        }


                        public function help($chatId){
                        
                            $this->sendMessage($chatId,
                        
                            "------HELP------------------------------------------\n".
                            "------  \n".
                            "------- \n".
                            "-----------------------------------------------------"
                            );
                            }

                            public function grab($chatId,$input1,$input2,$input3){
                                $no_kontak_pengirim =str_replace('@c.us','',$chatId);
                                $this->sendMessage($chatId,
                            
                                "------DEV------------------------------------------\n".
                                
                                "".$no_kontak_pengirim."  \n".
                                "".$input1."  \n".
                                "".$input2."  \n".
                                "".$input3."  \n".
                                "------- \n".
                                "-----------------------------------------------------"
                                );
                                }
                                

// dev kontak insert by wa
                        public function kontak_insert($chatId,$input1,$input2,$input3,$input4){

                            $no_kontak_pengirim =str_replace('@c.us','',$chatId);
                            
                            require_once 'kontak.php';
                            $kontak = new kontak();
                            
                            // $input2='JOKO';
                            // $input3='08080808080';
                            // $input4='SPO';
                            
                            // $id=NULL;
                            $nama=$input2;
                            $no_kontak=$input3;
                            $kelompok=$input4;
                            
                            $hasil = $kontak->insert($nama,$no_kontak,$kelompok);
                            $result = ($hasil = false) ? "insert gagal \n" : "Insert Success \n";


                            $this->sendMessage($chatId,
                            "------KONTAK ------------------------------------------\n".
                            // "".$no_kontak_pengirim."  \n".
                            // "".$input1."  \n".
                            // "".$input2."  \n".
                            // "".$input3."  \n".
                            // "".$input4."  \n".
                            "-------------------------------\n".
                            "".$result."  \n".
                            "-----------------------------------------------------"
                            );

                            }

// dev kode insert by wa
public function kode_insert($chatId,$input1,$input2,$input3){

    $no_kontak_pengirim =str_replace('@c.us','',$chatId);
    
    require_once 'kode.php';
    $kode = new kode();
    
    // $input2="WOWOW";
    // $input3="2019-12-31";
    
    $kode_grab=$input2;
    $expired=$input3;
    
    $hasil = $kode->insert($kode_grab,$expired);
    $result = ($hasil = false) ? "insert gagal \n" : "Insert Success \n";
    


    $this->sendMessage($chatId,
    "------KONTAK ------------------------------------------\n".
    // "".$no_kontak_pengirim."  \n".
    // "".$input1."  \n".
    // "".$input2."  \n".
    // "".$input3."  \n".
    // "".$input4."  \n".
    "-------------------------------\n".
    "".$result."  \n".
    "-----------------------------------------------------"
    );

    }


                        // dev
                        public function grab_order($chatId){

                            require_once 'kontak.php';
            
                            // membuat objek siswa
                            $kontak = new kontak();
                            
                            
                            $no_kontak_pemesan=str_replace('@c.us','',$chatId);
                            //tes
                            // $no_kontak_pemesan= '6287711086938';
                            $result = $kontak->view_pemimpin($no_kontak_pemesan);
                            
                            $no_kontak_pemimpin = $result[0]['no_kontak'];    
                            $kelompok=$result[0]['kelompok'];
                            $nama_pemesan=$result[0]['nama_pemesan'];
                            
                            $nomer_tujuan_pemimpin=$no_kontak_pemimpin.'@c.us';    
                            $nomer_tujuan_pemesan=$no_kontak_pemesan.'@c.us';    
                            // !!!!input data order return value order id
                            require_once 'order.php';
                            $order = new order();

                            // $no=null;
                            $no_pemimpin=$no_kontak_pemimpin;
                            $no_pemesan=$no_kontak_pemesan;
                            // $is_approved='1';
                            // $timestamp='2019-07-21 01:01:35';
                            $res = $order->insert($no_pemimpin,$no_pemesan);
                            
                            //Pesan ke pemimpin                        
                            $this->sendMessage($nomer_tujuan_pemimpin,
                        
                            "-------------------------------------------------------\n".
                                "ID_ORDER       :".$res."\n".
                                "NAMA PEMESAN   :".strtoupper($nama_pemesan)."\n".
                                "NO PEMESAN     :".$no_kontak_pemesan." \n".
                                "KELOMPOK       :".$kelompok."\n".
                                "-------------------------------------------------------\n".
                                "CONFIRM  ?                              \n".
                                "KETIK [GRAB#YES] UNTUK APPROVE      :\n".
                                "KETIK [GRAB#NO]  UNTUK CANCEL      :\n".
                                "------------------------------------------"
                            );

                            //Pesan ke pemesan                        
                            $this->sendMessage($nomer_tujuan_pemesan,
                        
                                "------------------------------------ \n".
                                "ID ORDER       :".$res."\n".
                                "NAMA PEMESAN   :".$nama_pemesan."\n".
                                "KELOMPOK       :".$kelompok."\n".
                                "STATUS         :WAITING APPROVE BY ".$no_kontak_pemimpin." \n".
                                "-----------------------------------------"

                            );


                        }

                        // dev 21072019
                        public function grab_yes($chatId){

                        require_once 'order.php';
                        require_once 'grab.php';
                        $order = new order();
                        $grab = new grab();    
                        
                        $no_kontak_pemimpin=str_replace('@c.us','',$chatId);
                        
                        //UPDATE ORDER HARI SEKARANG DAN SET KODE_GRAB

                        $res = $grab->view();
                        $kode_grab =$res[0]['kode_grab'];
                        $id_grab =$res[0]['id'];
                        // print_r($kode_grab);die();

                        $update_grab_yes = $order->update_grab_yes($kode_grab,$no_kontak_pemimpin);
                        // print_r($update_grab_yes);die();

                        $hasil = $order->view_order($kode_grab);
                        $id_order = $hasil[0]['id'];
                        $no_kontak_pemimpin = $hasil[0]['no_pemimpin'];
                        $no_kontak_pemesan = $hasil[0]['no_pemesan'];
                        // print_r($id_order);die();

                        $update_grab = $grab->update_grab($kode_grab,$id_order);


                        $nomer_tujuan_pemimpin=$no_kontak_pemimpin.'@c.us';    
                        $nomer_tujuan_pemesan=$no_kontak_pemesan.'@c.us';    

                        
                        //Pesan Konfirmasi ke pemimpin                        
                        $this->sendMessage($nomer_tujuan_pemimpin,

                            "------------------------------------ \n".
                            "ID ORDER      :".$id_order."\n".
                            "KODE GRAB     :".$kode_grab."\n".
                            "NO PEMESAN    :".$no_kontak_pemesan." \n".
                            // "KELOMPOK      :".$kelompok."\n".
                            // "KODE           :".$row['kode']."\n".
                            "STATUS        : IS APPROVED by".$no_kontak_pemimpin." \n".
                            // "EXPIRED     :".$row['expired']."\n".
                            "---------------------------------"
                        );

                        //Pesan ke pemesan                        
                        $this->sendMessage($nomer_tujuan_pemesan,

                        "------------------------------------- \n".
                        "ID ORDER       :".$id_order."\n".
                        "KODE GRAB      :".$kode_grab."\n".
                        "NO PEMESAN     :".$no_kontak_pemesan." \n".
                        // "KELOMPOK      :".$kelompok."\n".
                        // "KODE           :".$row['kode']."\n".
                        "STATUS         : IS APPROVED by ".$no_kontak_pemimpin." \n".
                        // "EXPIRED   :".$row['expired']."\n".
                        "----------------------------------------"
                        
                        );


                    }


                    // dev 21072019
                    public function grab_no($chatId){

                    require_once 'order.php';
                        // require_once 'kontak.php';
                    $order = new order();
                        // $kontak = new kontak();    
                        
                    $no_kontak_pemimpin=str_replace('@c.us','',$chatId);
                        
                    //UPDATE ORDER HARI SEKARANG DAN SET KODE_GRAB

                    // $res = $grab->view();
                    // $kode_grab =$res[0]['kode_grab'];
                    // $id_grab =$res[0]['id'];
                    // // print_r($kode_grab);die();

                    $update_grab_no = $order->update_grab_no($no_kontak_pemimpin);
                    // // // print_r($update_grab_yes);die();
                    $view_grab_no = $order->view_grab_no($no_kontak_pemimpin);
                    $no_kontak_pemesan = $view_grab_no[0]['no_pemesan']; 
                    $id_order = $view_grab_no[0]['id']; 
                    // $hasil = $order->view_order($kode_grab);
                    // $id_order = $hasil[0]['id'];
                    // $no_kontak_pemimpin = $hasil[0]['no_pemimpin'];
                    // $no_kontak_pemesan = $hasil[0]['no_pemesan'];
                    // // print_r($id_order);die();

                    // $update_grab = $grab->update_grab($kode_grab,$id_order);


                    $nomer_tujuan_pemimpin=$no_kontak_pemimpin.'@c.us';    
                    $nomer_tujuan_pemesan=$no_kontak_pemesan.'@c.us';    

                        
                        
                        
                        //Pesan Konfirmasi ke pemimpin                        
                    $this->sendMessage($nomer_tujuan_pemimpin,

                     "------------------------------------- \n".
                     "ID ORDER       :".$id_order."\n".
                     // "KODE GRAB  :".$kode_grab."\n".
                     "NO PEMESAN     :".$no_kontak_pemesan." \n".
                     // "KELOMPOK      :".$kelompok."\n".
                     // "KODE           :".$row['kode']."\n".
                     "STATUS         : IS CANCEL by ".$no_kontak_pemimpin." \n".
                     // "EXPIRED   :".$row['expired']."\n".
                     "-----------------------------------------"
                    );

                     //Pesan ke pemesan                        
                     $this->sendMessage($nomer_tujuan_pemesan,
                   "---------------------------------------- \n".
                     "ID ORDER       :".$id_order."\n".
                     // "KODE GRAB  :".$kode_grab."\n".
                     "NO PEMESAN     :".$no_kontak_pemesan." \n".
                     // "KELOMPOK      :".$kelompok."\n".
                     // "KODE           :".$row['kode']."\n".
                     "STATUS         : IS CANCEL by ".$no_kontak_pemimpin." \n".
                     // "EXPIRED   :".$row['expired']."\n".
                     "----------------------------------------"
                     
                     );
                   }



                // dev me#upgrade 21072019
                public function upgrade_me($chatId){

                    require_once 'kontak.php';
                    require_once 'permohonan.php';
                    $permohonan = new permohonan();
                    $kontak = new kontak();
                    
                    
                    $no_kontak_pemohon=str_replace('@c.us','',$chatId);

                    //tes
                    // $no_kontak_pemesan= '6287711086938';
                    $result = $kontak->view_is_pemimpin($no_kontak_pemohon);
                    $result2 = $kontak->view_detail($no_kontak_pemohon);
                    
                    // $no_kontak_pemimpin = $result[0]['no_kontak'];    
                    // $kelompok=$result[0]['kelompok'];
                    // $nama_pemohon=$result[0]['nama_pemesan'];
                    $nama_pemimpin=$result[0]['nama'];
                    $no_kontak_pemimpin=$result[0]['no_kontak'];
                    $nomer_tujuan_pemimpin=$no_kontak_pemimpin.'@c.us';
                    
                    $kelompok=$result2[0]['kelompok'];

                    $nama_pemohon=$result2[0]['nama'];
                    // $no_kontak_pemohon=$result2[0]['no_kontak'];    
                    $nomer_tujuan_pemohon=$no_kontak_pemohon.'@c.us';    

                    $res = $permohonan->insert($no_kontak_pemimpin,$no_kontak_pemohon);


                    //Pesan ke Pemohon                        
                    $this->sendMessage($nomer_tujuan_pemohon,

                        "------------------------------------ \n".
                        // "ID ORDER       :".$res."\n".
                        "HAL            : UPGRADE LEVEL ACCESS PEMIMPIN \n".
                        "NAMA PEMOHON   :".strtoupper($nama_pemohon)."\n".
                        "KELOMPOK       :".$kelompok."\n".
                        "STATUS         :WAITING APPROVE BY ".$no_kontak_pemimpin." \n".
                        "-----------------------------------------"

                    );

                    //Pesan ke pemimpin                        
                    $this->sendMessage($nomer_tujuan_pemimpin,

                        "______________________________________________\n".
                        // "ID_ORDER       :".$res."\n".
                        "HAL            : UPGRADE LEVEL ACCESS PEMIMPIN \n".
                        "NAMA PEMOHON   :".strtoupper($nama_pemohon)."\n".
                        "NO PEMOHON     :".$no_kontak_pemohon." \n".
                        "KELOMPOK       :".$kelompok."\n".
                        "_______________________________________________ \n".
                        "CONFIRM TO UPGRADE LEVEL ACCESS PEMIMPIN ?   \n".
                        "KETIK [UPGRADE#YES] UNTUK APPROVE      \n".
                        "KETIK [UPGRADE#NO]  UNTUK CANCEL      \n".
                        "_______________________________________________"
                    );



                }

                // dev upgrade#yes 21072019
                public function upgrade_yes($chatId){

                    require_once 'permohonan.php';
                    $permohonan = new permohonan();    
                    
                    $no_kontak_pemimpin=str_replace('@c.us','',$chatId);
                    $hasil = $permohonan->view_detail($no_kontak_pemimpin);
                    $no_kontak_pemohon=$hasil[0]['no_pemohon'];

                    $permohonan->update_upgrade_yes($no_kontak_pemimpin,$no_kontak_pemohon);
                //UPDATE ORDER HARI SEKARANG DAN SET KODE_GRAB

                // $res = $grab->view();
                // $kode_grab =$res[0]['kode_grab'];
                // $id_grab =$res[0]['id'];
                // // print_r($kode_grab);die();

                // $update_grab_yes = $order->update_grab_yes($kode_grab,$no_kontak_pemimpin);
                // // print_r($update_grab_yes);die();

                // $hasil = $order->view_order($kode_grab);
                // $id_order = $hasil[0]['id'];
                // $no_kontak_pemimpin = $hasil[0]['no_pemimpin'];
                // $no_kontak_pemesan = $hasil[0]['no_pemesan'];
                // // print_r($id_order);die();

                // $update_grab = $grab->update_grab($kode_grab,$id_order);


                $nomer_tujuan_pemimpin=$no_kontak_pemimpin.'@c.us';    
                $nomer_tujuan_pemesan=$no_kontak_pemohon.'@c.us';    

                    
                    //Pesan Konfirmasi ke pemimpin                        
                    $this->sendMessage($nomer_tujuan_pemimpin,

                        "------------------------------------ \n".
                        "HAL            : UPGRADE LEVEL ACCESS PEMIMPIN \n".
                        "NO PEMOHON    :".$no_kontak_pemohon." \n".
                        // "KELOMPOK      :".$kelompok."\n".
                        // "KODE           :".$row['kode']."\n".
                        "STATUS        : IS APPROVED by \n".
                        // "EXPIRED     :".$row['expired']."\n".
                        "---------------------------------"
                    );

                    //Pesan ke pemesan                        
                    $this->sendMessage($nomer_tujuan_pemesan,

                    "------------------------------------ \n".
                    "HAL            : UPGRADE LEVEL ACCESS PEMIMPIN \n".
                    "NO PEMOHON    :".$no_kontak_pemohon." \n".
                    // "KELOMPOK      :".$kelompok."\n".
                    // "KODE           :".$row['kode']."\n".
                    "STATUS        : IS APPROVED by \n".
                    // "EXPIRED     :".$row['expired']."\n".
                    "----------------------------------------"
                    
                    );


                }



// =====================================================================================
                        // dev
                        // public function order($chatId){
                        //     // $this->sendMessage($chatId,$name);    
                        //     include('db.php');
                        //     $db = new database();
                        //     $phone = str_replace('@c.us','',$chatId);    
                        //     // $kelompok='SPO';
                        //     $data_pemimpin = $db->data_pemimpin($phone);
                        //     $number_pemimpin=$data_pemimpin[0]['number'];
                        //     $kelompok_pemimpin=$data_pemimpin[0]['kelompok'];
                            
                        // // $data_number = $db->data_pemimpin($phone);
                        // // print_r($data_number[0]['number']); 
                        //     $nomer_tujuan=$number_pemimpin.'@c.us';    
                        //     // $nomer='6287711086938'.'@c.us';    
                            
                        //     $data_kode = $db->tampil_kode();
                        // // input order

                        //     foreach($data_kode as $row){                            
                        
                        //     $this->sendMessage($nomer_tujuan,
                        
                        //         "------------------------------ \n".
                        //         "ORDER BY  :".$phone." \n".
                        //         "KELOMPOK  :".$kelompok_pemimpin."\n".
                        //         "KODE      :".$row['kode']."\n".
                        //         "CONFIRM  ? [Y/N]      :\n".
                        //         // "EXPIRED   :".$row['expired']."\n".
                        //         "---------------------------------"
                        //     );
                        // }

                        // }



                        // 

                        //sends your nickname. it is called when the bot gets the command "me"
                        //@param $chatId [string] [required] - the ID of chat where we send a message
                        //@param $name [string] [required] - the "senderName" property of the message
                    //     public function me($chatId,$name){
                    //     include('db.php');
                    //     $db = new database();
                        
                    //     $data_barang = $db->tampil_data();
                    //     $full_name = $data_barang[0]['full_name'];
                    //     $no = 1;
                    //     foreach($data_barang as $row){                            
                    //     $welcomeString =  "XXXXXXXXXXXXXXXXXXXXX \n";
                    //     $this->sendMessage($chatId,
                    //     $welcomeString.
                    //     "Commands:\n".
                    //         "NO         :".$no++." \n".
                    //         "EMAIL      :".$row['email']."\n".
                    //         "USERNAME   :".$row['username']."\n".
                    //         "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA \n".
                    //         "ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ"
                    //     );
                    // }

                    // }
//====================================================================================

                        public function sendMessage($chatId, $text){
                        $data = array('chatId'=>$chatId,'body'=>$text);
                        $this->sendRequest('message',$data);}

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
                        new whatsAppBot();
?>