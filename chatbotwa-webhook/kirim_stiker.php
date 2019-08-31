<?php

class kirim_stiker{

    function siap($no_kontak){
        $url_luffy = "http://" . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'].'/mugiwara.png';
        $data = [
            // 'phone' => "6281973480077", // Receivers phone
            'phone' => $no_kontak, // Receivers phone
        
            // 'body' => "https://media.giphy.com/media/apEtaOFjF9dCRy4BxV/giphy.gif", // Receivers phone
            'body' => $url_luffy, // Receivers phone
            
            'filename' => "luffy.png", // Receivers phone
            // 'caption' => "Masuk_Pa_Eko" // Receivers phone

        ];
        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $url = 'https://api.chat-api.com/instance53244/sendFile?token=oedqhd1jfewd5io0';
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

//dev 0208019 kirim stiker
// require_once 'kirim_stiker.php';
// $kirim_stiker = new kirim_stiker();
//     // $nama='XYZ';
//     // $kontak='6287711086938';
// // $no_kontak=str_replace('@c.us','',$chatId);
// $no_kontak='6287711086938';
// $res = $kirim_stiker->siap($no_kontak);


/*
$kontak = array(
    6287711086938//,6281574518623,62818760046
);

foreach ($kontak as $value) {
    
    $data = [
        // 'phone' => "6281973480077", // Receivers phone
        'phone' => $value, // Receivers phone
        
        'body' => "http://34.85.53.9:1111/icon.webp", // Receivers phone
        'filename' => "icon.webp", // Receivers phone
        'caption' => "Masuk_Pa_Eko" // Receivers phone
        // 'body' => $pesan, // Message
];
$json = json_encode($data); // Encode data to JSON
// URL for request POST /message
$url = 'https://api.chat-api.com/instance53244/sendFile?token=oedqhd1jfewd5io0';
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
*/

// print_r($kontak);
// die();







//  $this->sendMessage($data['kontak'].'@c.us',
    
//  // "KETIK UP<spasi>NAMA_BARU<spasi>NO_BARU<spasi>KELOMPOK_BARU<spasi>[1/2]<spasi>62111111111 \n".                                               
//  // "KETIK GRAB<spasi>STOK \n".                                               
//  "--------------------------------------------------------\n".                                       
//  "".$pesan."  \n".
//  "--------------------------------------------------------\n".                                       
//  "Voucher Grab Telah Tersedia \n".
//  "Fitur GRAB ORDER sudah dapat digunakan  \n".
//  "\n".
//  "Thanks  \n".
//  "Dimas  \n".
//  "--------------------------------------------------------".
//  "Butuh bantuan? --> ketik help \n".      
//  "Ditanya aja Mas \n".      
//  "--------------------------------------------------------"
//  );


    // }

// die();



//print_r('OK');die();
?>