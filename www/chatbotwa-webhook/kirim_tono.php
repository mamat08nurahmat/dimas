<?php

// dev 0208019 kirim file
require_once 'kirim_file.php';
$kirim_file = new kirim_file();
// $no_kontak=str_replace('@c.us','',$chatId);
$no_kontak='6281574518623';
$res = $kirim_file->report($no_kontak);

?>