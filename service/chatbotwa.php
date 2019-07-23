<?php
            // require_once 'users.php';
            // $users = new users();
            // $nama='XYZ';
            // $kontak='621122334455';
            // $kelompok='TES';
            // $level='2';
            // $res5 = $users->insert($nama,$kontak,$kelompok,$level);
            // // $stok=$res5[0]['stok'];
            // print_r($res5);die();
// $id=3;
// $res4 = $kode_grab->update($id);
// print($res4);die();
// $no_pemesan='6211111111111';
// $no_pemimpin='623333333333';
// $id_kode_grab='123';
// $res = $order_grab->insert($no_pemesan,$no_pemimpin,$id_kode_grab);
// $hasil = ($res!=1) ? "GAGAL \n" : "SUCCESS \n";
// print_r($hasil);die();
// // // require_once 'kontak.php';
// // // $kontak = new kontak();
// $kontak_pengirim='6287711086938';
// $res = $users->get_pemimpin($kontak_pengirim);
// $kontak_pemimpin =$res[0]['kontak'];
// $nama_pemimpin =$res[0]['nama'];
// $kelompok =$res[0]['kelompok'];    

// // // $no_kontak_pemimpin=str_replace('@c.us','',$chatId);

// // // //UPDATE ORDER HARI SEKARANG DAN SET KODE_GRAB
// $kontak='6287711086938';
// $res = $users->get_users($kontak);
// $kontak_pengirim =$res['kontak'];
// $nama_pengirim =$res['nama'];
// // $kelompok =$res[0]['kelompok'];
// // // $id_grab =$res[0]['id'];

// print_r($kontak_pemimpin);die();




// require_once 'kode_grab.php';
// $grab = new kode_grab();
 

// $no_kontak_pemimpin=str_replace('@c.us','',$chatId);

// //UPDATE ORDER HARI SEKARANG DAN SET KODE_GRAB

// $res = $grab->view_aktif();
// $kode_grab =$res[0]['kode_grab'];
// $id_grab =$res[0]['id'];

// print_r($kode_grab);die();

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
                        $input5 = mb_strtolower($text[4], 'UTF-8');
                        switch(mb_strtolower($text[0],'UTF-8')){
                        case 'hi':  {$this->welcome($message['chatId'],false); break;}

                        case 'help':     {$this->help($message['chatId']); break;}

                        // case 'grab':     {$this->grab($message['chatId'],$input1,$input2); break;}
                       case 'insert#users':     {$this->insert_users($message['chatId'],$input1,$input2,$input3,$input4,$input5); break;}


                        case 'grab#order':     {$this->grab_order($message['chatId']); break;}
                        case 'cek#stok':     {$this->cek_stok($message['chatId']); break;}
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

                                // $no_kontak_pemimpin=str_replace('@c.us','',$chatId_pemimpin);
                                $res = $users->get_pemimpin($kontak_pengirim);
                                $kontak_pemimpin =$res[0]['kontak'];
                                $nama_pemimpin =$res[0]['nama'];
                                $kelompok =$res[0]['kelompok'];  

                                $res2 = $users->get_users($kontak_pengirim);
                              
                                $nama_pengirim =$res2['nama'];

                                $chatId_pemimpin=$kontak_pemimpin.'@c.us';    
                                // // $nomer_tujuan_pemesan=$no_kontak_pemesan.'@c.us'; 
                                
                                // PROSES ORDER
                                $res3 = $order_grab->insert($kontak_pengirim,$kontak_pemimpin,$id_kode_grab);
                            
                                // PROSES UPDATE kode_grab
                                $res4 = $grab->update($id_kode_grab);

                                //pesan ke pengirim 
                                $this->sendMessage($chatId_pengirim,
                            
                                "-------------------------------------------------\n".
                                // "No Pengirim    :".$kontak_pengirim."  \n".
                                // "Nama           :".$nama_pengirim."  \n".
                                "Kelompok       :".$kelompok."  \n".
                                "No Pemimpin    :".$kontak_pemimpin."  \n".
                                "Nama Pemimpin  :".$nama_pemimpin."  \n".
                                "-------------------------------------------------- \n".
                                "Kode Grab      :".$kode_grab."  \n".
                                "Expired        :".$expired."  \n".
                                // "QTY      :".$input3."  \n".
                                // "".$id_kode_grab."  \n".
                                "----------------------------------------------------"
                                );


                                // //pesan ke pemimpin
                                $this->sendMessage($chatId_pemimpin,
                            
                                "-------------------------------------------------\n".
                                "Request By    :".$kontak_pengirim."  \n".
                                "Nama           :".$nama_pengirim."  \n".
                                "Kelompok       :".$kelompok."  \n".
                                // "No Pemimpin    :".$kontak_pemimpin."  \n".
                                // "Nama Pemimpin  :".$nama_pemimpin."  \n".
                                "-------------------------------------------------- \n".
                                "Kode Grab      :".$kode_grab."  \n".
                                "Expired        :".$expired."  \n".
                                // "QTY      :".$input3."  \n".
                                // "".$id_kode_grab."  \n".
                                "----------------------------------------------------"
                                );




                                }
                                

                                public function cek_stok($chatId){
                                    
                                    require_once 'kode_grab.php';
                                    $kode_grab = new kode_grab();
                                    $res5 = $kode_grab->view_stok();
                                    $stok=$res5[0]['stok'];
                                    $this->sendMessage($chatId,
                                
                                    "------STOK KODE GRAB------------------------\n".
                                    "STOK   :".$stok."  \n".
                                    "--------------------------------------------"
                                    );
                                    }


                        public function insert_users($chatId,$input1,$input2,$input3,$input4,$input5){
                        

            require_once 'users.php';
            $users = new users();
            // $nama='XYZ';
            // $kontak='621122334455';
            // $kelompok='TES';
            // $level='2';
            $res5 = $users->insert($input2,$input3,strtoupper($input4),$input5);


                            $this->sendMessage($chatId,
                        
                            "------HELP------------------------------------------\n".
                            // "------".$input1."  \n".
                            "------".$input2."  \n".
                            "------".$input3."  \n".
                            "------".$input4."  \n".
                            "------".$input5."  \n".
                            // "------".$input1."  \n".
                            "------- \n".
                            "-----------------------------------------------------"
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