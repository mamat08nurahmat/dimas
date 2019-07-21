<?php
defined('BASEPATH') OR exit('No direct script access allowed');


                        class Bot extends Front{
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
                        switch(mb_strtolower($text[0],'UTF-8')){
                        case 'hi':  {$this->welcome($message['chatId'],false); break;}


                        case 'grab':     {$this->grab($message['chatId']); break;}


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
                        $welcomeString = ($noWelcome) ? "Incorrect command\n" : "WhatsApp BNI SLN \n";
                        $this->sendMessage($chatId,
                        $welcomeString.
                        "Commands:\n".
                        "1. GRAB ORDER \n".
                        "2. BBBBBBBBBBBBBBBBBBBBBBBBB \n".
                        "3. CCCCCCCCCCCCCCCCCCCCCCCCC \n".
                        "--------------------------------"
                        );
                        }


                        // dev
                        public function grab($chatId){
                            // $this->sendMessage($chatId,$name);    
                            include('db.php');
                            $db = new database();
                            $no_pemesan = str_replace('@c.us','',$chatId);    
                            // $kelompok='SPO';
                            $data_pemimpin = $db->data_pemimpin($no_pemesan);
                            $number_pemimpin=$data_pemimpin[0]['number'];
                            $kelompok_pemimpin=$data_pemimpin[0]['kelompok'];
                            $nomer_tujuan=$number_pemimpin.'@c.us';    
// !!!!input data order return value order id

                            
                            // $data_kode = $db->tampil_kode();
                        // input order

                            // foreach($data_kode as $row){                            
                        
                            $this->sendMessage($nomer_tujuan,
                        
                                "------------------------------ \n".
                                "ORDER REQUEST  :".$no_pemesan." \n".
                                "KELOMPOK       :".$kelompok_pemimpin."\n".
                                // "KODE           :".$row['kode']."\n".
                                "CONFIRM  ? [Y/N]      :\n".
                                // "EXPIRED   :".$row['expired']."\n".
                                "---------------------------------"
                            );
                        // }

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
                        public function me($chatId,$name){
                        include('db.php');
                        $db = new database();
                        
                        $data_barang = $db->tampil_data();
                        $full_name = $data_barang[0]['full_name'];
                        $no = 1;
                        foreach($data_barang as $row){                            
                        $welcomeString =  "XXXXXXXXXXXXXXXXXXXXX \n";
                        $this->sendMessage($chatId,
                        $welcomeString.
                        "Commands:\n".
                            "NO         :".$no++." \n".
                            "EMAIL      :".$row['email']."\n".
                            "USERNAME   :".$row['username']."\n".
                            "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA \n".
                            "ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ"
                        );
                    }
                    }
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
                        new Bot();
?>