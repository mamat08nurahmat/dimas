<?php


// die();

class kirim_pesan{

    function notif($no_kontak){

        $pesan=
        "------Voucher Grab------------------------\n".
        "Nama       : AAAA  \n".
        // "Nama       :".$nama."  \n".
        "----------------------------------------------\n".
        // $looping1.
        // $looping2.
        "----------------------------------------------\n".
        // "Jumlah Sudah Terpakai   :".$jumlah_sudah."  \n".
        "Jumlah Belum Terpakai   :123  \n".
        "----------------------------------------------"
        ;

// $pesan="xxxxxxxxxxxxxxxxxxxxxxxxx"."\n";
// $pesan.="aaaaaaaaaaaaaaaaaaaaaaaa"."\n";

// $looping1="Trip_Description"."\n";
// foreach($sudah_detail as $data):
// $looping1.=$data['Trip_Description']." - ( Rp.".$data['Total']" ) \n";   
//     // $looping.="Tgl Order : ".$data["Date_Time"]."\n".
//     // $looping.="Tgl Order : ".$data["Date_Time"]." | Tujuan : ".$data["Trip_Description"]." | Total : ".$data["Total"]."\n".
// endforeach;     
// $looping1.="xxxxxxxxxxxxxxxxxxxxxxxxx"."\n";

        //http://35.232.20.194:1111/report.php
        $data = [
            // 'phone' => "6281973480077", // Receivers phone
            'phone' => $no_kontak, // Receivers phone
        
            'body' => $pesan

        ];
        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $url = 'https://api.chat-api.com/instance53244/sendMessage?token=oedqhd1jfewd5io0';
        // Make a POST request
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        // Send a request
        $result = file_get_contents($url, false, $options);


    }




}

// dev 0208019 kirim file
// require_once 'kirim_pesan.php';
$kirim_pesan = new kirim_pesan();
// // $no_kontak=str_replace('@c.us','',$chatId);
$no_kontak='6287711086938';
$res = $kirim_pesan->notif($no_kontak);
// $res = $kirim_pesan->report($no_kontak);


print_r('OK');die();
?>