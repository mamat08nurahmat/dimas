 
<?php
// memanggil file siswa.php
require_once 'siswa.php';

if (isset($_GET['id'])) {
    // membuat objek siswa
    $siswa = new siswa();

	$nis = $_GET['id'];

	// delete data siswa
    $siswa->delete($nis);
}					
?>