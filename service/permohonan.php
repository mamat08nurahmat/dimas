
<?php
        
        /* class permohonan */
        class permohonan {
        
            /* method untuk menampilkan data permohonan */
            function view_detail($no_kontak_pemimpin) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data permohonan
                $sql = "SELECT * FROM `form_permohonan` WHERE `no_pemimpin`=$no_kontak_pemimpin ORDER BY id DESC LIMIT 1";
        
                $result = $mysqli->query($sql);
        
                while ($data = $result->fetch_assoc()) {
                    $hasil[] = $data;
                }
        
                // menutup koneksi database
                $mysqli->close();
        
                // nilai kembalian dalam bentuk array
                return $hasil;
            }
//dev 21072019
            /* method untuk menampilkan data permohonan */
            function view_pemimpin($no_permohonan) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data permohonan
                $sql = "
                SELECT 
                a.*
                ,b.nama as nama_pemesan 
                FROM form_permohonan a
LEFT JOIN form_permohonan b ON a.kelompok=b.kelompok
WHERE a.pemimpin=1 AND b.no_permohonan='$no_permohonan'
                ";
        
                $result = $mysqli->query($sql);
        
                while ($data = $result->fetch_assoc()) {
                    $hasil[] = $data;
                }
        
                // menutup koneksi database
                $mysqli->close();
        
                // nilai kembalian dalam bentuk array
                return $hasil;
            }


            

	
            
            /* Method untuk menyimpan data ke tabel permohonan */
            function insert($no_pemimpin,$no_pemohon) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk insert data permohonan
                // $sql = "INSERT INTO form_permohonan (id,no_pemimpin,no_pemesan,is_approved,timestamp) 
                //         VALUES ('$id','$no_pemimpin','$no_pemesan','$is_approved','$timestamp')";
                
$sql = "
INSERT INTO `form_permohonan`(`id`, `no_pemohon`, `no_pemimpin`, `hal`, `is_approved`, `timestamp`) VALUES (NULL,$no_pemohon,$no_pemimpin,'UPGRADE LEVEL',0,NOW())

";
                
$result = $mysqli->query($sql); 
return $last_id = $mysqli->insert_id;        
                 
                // cek hasil query
                // if($result){
                //     /* jika data berhasil disimpan alihkan ke halaman permohonan dan tampilkan pesan = 2 */
                //     header("Location: index.php?alert=2");
                // }
                // else{
                //     /* jika data gagal disimpan alihkan ke halaman permohonan dan tampilkan pesan = 1 */
                //     header("Location: index.php?alert=1");
                // }
        
                // menutup koneksi database
                $mysqli->close();
            }

            function update_upgrade_yes($no_kontak_pemimpin,$no_kontak_pemohon)
              {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // $nama         = $mysqli->real_escape_string($nama);
                // $tempat_lahir = $mysqli->real_escape_string($tempat_lahir);
                // $alamat       = $mysqli->real_escape_string($alamat);
        
                // sql statement untuk update data permohonan
                // $sql = "UPDATE db_permohonan SET nama            = '$nama',
                //                             tempat_lahir    = '$tempat_lahir',
                //                             tanggal_lahir   = '$tanggal_lahir',
                //                             jenis_kelamin   = '$jenis_kelamin',
                //                             agama           = '$agama',
                //                             alamat          = '$alamat',
                //                             no_telepon      = '$no_telepon'
                //                       WHERE nis             = '$nis'"; 

$sql = "
-- SELECT A.* FROM form_permohonan A
UPDATE form_permohonan A-- ,form_kontak B,form_kontak C
INNER JOIN form_kontak B ON A.no_pemimpin=B.no_kontak
INNER JOIN form_kontak C ON A.no_pemohon=C.no_kontak
SET A.is_approved=1
,B.pemimpin=0
,C.pemimpin=1
WHERE A.hal='UPGRADE LEVEL' 
AND A.is_approved!=1
AND A.no_pemimpin=$no_kontak_pemimpin
AND A.no_pemohon=$no_kontak_pemohon

";                
// !!!!!!!!!!!!!!! update date now
// ?????????????
// $result = $mysqli->query($sql); 
// return $last_id = $mysqli->update_id;        

return  $result = $mysqli->query($sql);
        
                // cek hasil query
                // if($result){
                //     /* jika data berhasil disimpan alihkan ke halaman permohonan dan tampilkan pesan = 3 */
                //     header("Location: index.php?alert=3");
                // }
                // else{
                //     /* jika data gagal disimpan alihkan ke halaman permohonan dan tampilkan pesan = 1 */
                //     header("Location: index.php?alert=1");
                // }
        
                // menutup koneksi database
                $mysqli->close();
            }



            function view_permohonan($kode_grab) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data grab
                $sql = "SELECT * FROM form_permohonan  WHERE kode_grab='$kode_grab'permohonan BY id DESC LIMIT 1";
        
                $result = $mysqli->query($sql);
        
                while ($data = $result->fetch_assoc()) {
                    $hasil[] = $data;
                }
        
                // menutup koneksi database
                $mysqli->close();
        
                // nilai kembalian dalam bentuk array
                return $hasil;
            }

// dev grab#no
function update_grab_no($no_pemimpin) {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // $nama         = $mysqli->real_escape_string($nama);
    // $tempat_lahir = $mysqli->real_escape_string($tempat_lahir);
    // $alamat       = $mysqli->real_escape_string($alamat);

    // sql statement untuk update data permohonan
    // $sql = "UPDATE db_permohonan SET nama            = '$nama',
    //                             tempat_lahir    = '$tempat_lahir',
    //                             tanggal_lahir   = '$tanggal_lahir',
    //                             jenis_kelamin   = '$jenis_kelamin',
    //                             agama           = '$agama',
    //                             alamat          = '$alamat',
    //                             no_telepon      = '$no_telepon'
    //                       WHERE nis             = '$nis'"; 

$sql = "
UPDATE form_permohonan SET is_approved=0,kode_grab=NULL WHERE is_approved=0 AND no_pemimpin=$no_pemimpin permohonan BY id DESC LIMIT 1

";                
// !!!!!!!!!!!!!!! update date now
// ?????????????
// $result = $mysqli->query($sql); 
// return $last_id = $mysqli->update_id;        

return  $result = $mysqli->query($sql);

    // cek hasil query
    // if($result){
    //     /* jika data berhasil disimpan alihkan ke halaman permohonan dan tampilkan pesan = 3 */
    //     header("Location: index.php?alert=3");
    // }
    // else{
    //     /* jika data gagal disimpan alihkan ke halaman permohonan dan tampilkan pesan = 1 */
    //     header("Location: index.php?alert=1");
    // }

    // menutup koneksi database
    $mysqli->close();
}



// dev grab#no
function view_grab_no($no_pemimpin) {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data permohonan
    $sql = "
    SELECT 
 * 
    FROM form_permohonan 
WHERE is_approved=0 
AND no_pemimpin='$no_pemimpin'
permohonan BY id DESC LIMIT 1
    ";

    $result = $mysqli->query($sql);

    while ($data = $result->fetch_assoc()) {
        $hasil[] = $data;
    }

    // menutup koneksi database
    $mysqli->close();

    // nilai kembalian dalam bentuk array
    return $hasil;
}



//==========================

            /* Method untuk menampilkan data permohonan berdasarkan nis */
            function get_permohonan($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil data permohonan berdasarkan nis
                $sql = "SELECT * FROM db_permohonan WHERE nis='$nis'";
        
                $result = $mysqli->query($sql);
                $data   = $result->fetch_assoc();
        
                // menutup koneksi database
                $mysqli->close();
                
                // nilai kembalian dalam bentuk array
                return $data;
            }
            
            /* Method untuk mengubah data pada tabel permohonan */
            function update($nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, $alamat, $no_telepon, $nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                $nama         = $mysqli->real_escape_string($nama);
                $tempat_lahir = $mysqli->real_escape_string($tempat_lahir);
                $alamat       = $mysqli->real_escape_string($alamat);
        
                // sql statement untuk update data permohonan
                $sql = "UPDATE db_permohonan SET nama            = '$nama',
                                            tempat_lahir    = '$tempat_lahir',
                                            tanggal_lahir   = '$tanggal_lahir',
                                            jenis_kelamin   = '$jenis_kelamin',
                                            agama           = '$agama',
                                            alamat          = '$alamat',
                                            no_telepon      = '$no_telepon'
                                      WHERE nis             = '$nis'"; 
        
                $result = $mysqli->query($sql);
        
                // cek hasil query
                if($result){
                    /* jika data berhasil disimpan alihkan ke halaman permohonan dan tampilkan pesan = 3 */
                    header("Location: index.php?alert=3");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman permohonan dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
            
            /* Method untuk menghapus data pada tabel permohonan */
            function delete($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk delete data permohonan
                $sql = "DELETE FROM db_permohonan WHERE nis = '$nis'";
        
                $result = $mysqli->query($sql);
        
                // cek hasil query
                if($result){
                    /* jika data berhasil disimpan alihkan ke halaman permohonan dan tampilkan pesan = 4 */
                    header("Location: index.php?alert=4");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman permohonan dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
        }
        ?>
        