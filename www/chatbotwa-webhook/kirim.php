<?php


    require_once 'users.php';
    $users = new users();

    
    // $res5 = $users->get_users($no_kontak);
    $result = $users->get_all_kontak();

    // print_r($result);die();
//     // $no_kontak = $res5['kontak'];
//     // $chatId=$no_kontak.'@c.us'; 
    foreach($result as $data) {

// echo $data['kontak'].'@c.us';
// echo '<br>';

$pesan =
        // "--------------------------------------------------------\n".                                       
        "Selamat Pagi \n".
        "  \n".
        "Voucher Grab Telah Tersedia \n".
        "Voucher dapat digunakan pertanggal 1 Agustus 2019  \n".
        "  \n".
        "Thanks  \n".
        "Dimas  \n".
        "--------------------------------------------------------\n".
        "Butuh bantuan? --> ketik help \n".      
        "Ditanya aja Mas \n".      
        "--------------------------------------------------------"
;

// "phone": 6287711086938,
// "body": "http://34.85.53.9:1111/Profile.pdf",
// "filename": "Profile.pdf",
// "caption": "profile"

$data = [
    'phone' => $data['kontak'].'@c.us', // Receivers phone

    // 'body' => 'http://34.85.53.9:1111/index.php', // Receivers phone
    // 'filename' => 'index.php', // Receivers phone
    // 'caption' => 'index', // Receivers phone
    'body' => $pesan, // Message
];
$json = json_encode($data); // Encode data to JSON
// URL for request POST /message
$url = 'https://api.chat-api.com/instance53244/message?token=oedqhd1jfewd5io0';
// Make a POST request
$options = stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $json
    ]
]);
// Send a request
$result = file_get_contents($url, false, $options);


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


    }

// die();



print_r('OK');die();
?>