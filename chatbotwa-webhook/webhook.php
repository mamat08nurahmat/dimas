<?php

//http://35.232.20.194:1111/webhook.php?server=prod
//http://35.232.20.194:1111/webhook.php?server=dev

$url_webhook = "http://" . $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/chatbotwa-webhook/index.php';


// $server = $_GET['server'];
// if($server=='prod'){
//     $url_webhook = 'http://35.239.56.54/index.php'; //prod_server kubernetes

// }elseif($server=='dev'){
//     $url_webhook = "http://" . $_SERVER['SERVER_NAME'] .':1111/index.php';
//     // $url_webhook = 'http://35.194.63.175:1111/index.php'; //dev_server
// }elseif($server=='stag'){
//     $url_webhook = "http://" . $_SERVER['SERVER_NAME'] .':8888/index.php';
//     // $url_webhook = 'http://35.194.63.175:8888/index.php'; //dev_server
// }



$data = [
    
    'webhookUrl' => $url_webhook    
    // 'phone' => $data['kontak'].'@c.us', // Receivers phone
    
    // 'body' => 'http://34.85.53.9:1111/index.php', // Receivers phone
    // 'filename' => 'index.php', // Receivers phone
    // 'caption' => 'index', // Receivers phone
    // 'body' => $pesan // Message
];
$json = json_encode($data); // Encode data to JSON
// URL for request POST /message
$url = 'https://api.chat-api.com/instance53243/webhook?token=6o15kym7hd1sqk49';
// Make a POST request
$options = stream_context_create(['http' => [
    'method'  => 'POST',
    'header'  => 'Content-type: application/json',
    'content' => $json
    ]
    ]);
    // Send a request
    $result = file_get_contents($url, false, $options);
    
    
    
    print_r('webhook running on '.$url_webhook);die();
    
    ?>