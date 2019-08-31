<?php

require_once 'order_grab.php';
$order_grab = new order_grab();
require_once 'users.php';
$users = new users();
// $no_kontak=str_replace('@c.us','',$chatId);
// $no_kontak='62816204646';
$no_kontak='6287711086938';
// $result = $order_grab->get_order_grab($no_kontak);
// $jumlah=$result['jumlah'];

$res = $users->get_detail($no_kontak);


$nama=$res[0]['nama'];
$kelompok=$res[0]['kelompok'];
$level=$res[0]['level'];


$result = $order_grab->report_ymd($no_kontak,$kelompok,$level);
$count_ytd = $result[0]['COUNT_YTD'];
$total_ytd = $result[0]['TOTAL_YTD'];
// print_r($result);die();

// $sudah_detail = $order_grab->sudah_terpakai_detail($no_kontak);
$belum_detail = $order_grab->belum_terpakai_detail($no_kontak);

// print_r($sudah_detail);die();

$jumlah_belum = $order_grab->belum_terpakai($no_kontak);
$jumlah_belum = $jumlah_belum[0]['jumlah'];

$this->sendMessage($chatId,

"------INFO Voucher Grab------------------------\n".
"Nama       :".$nama."  \n".
"Kontak     :".$no_kontak."  \n".
"Kelompok   :".$kelompok."  \n".
"----------------------------------------------\n".
"Jumlah Sudah Terpakai YTD  :".$count_ytd."  \n".
"Jumlah Belum Terpakai YTD  :".$jumlah_belum."  \n".
"----------------------------------------------\n".
"Total YTD  :".$total_ytd."  \n".
"----------------------------------------------\n".

// "----------------------------------------------\n".
// "Jumlah Sudah Terpakai   :".$jumlah_sudah."  \n".
// "Jumlah Belum Terpakai   :".$jumlah_belum."  \n".
"----------------------------------------------"
);





?>