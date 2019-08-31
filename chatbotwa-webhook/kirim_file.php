<?php


// die();

class kirim_file{
    
    function report($no_kontak){
        $base_url_report = "http://" . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'].'/report.php';
        //http://35.232.20.194:1111/report.php
        $data = [
            // 'phone' => "6281973480077", // Receivers phone
            'phone' => $no_kontak, // Receivers phone
        
            'body' => $base_url_report, // Receivers phone
            'filename' => "Report.xls", // Receivers phone
            'caption' => "Report" // Receivers phone

        ];
        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $url = 'https://api.chat-api.com/instance53243/sendFile?token=6o15kym7hd1sqk49';
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


// // require_once 'kirim_file.php';
// $kirim_file = new kirim_file();
// // $no_kontak=str_replace('@c.us','',$chatId);
// $no_kontak='6287711086938';
// $res = $kirim_file->report($no_kontak);


// print_r($res.'OK');die();
?>