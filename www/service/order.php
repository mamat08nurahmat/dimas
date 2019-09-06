
<?php
        
        /* class order */
        class order {
        
            /* method untuk menampilkan data order */
            function view() {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data order
                $sql = "SELECT * FROM form_order ORDER BY id DESC";
        
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
            /* method untuk menampilkan data order */
            function view_pemimpin($no_order) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data order
                $sql = "
                SELECT 
                a.*
                ,b.nama as nama_pemesan 
                FROM form_order a
LEFT JOIN form_order b ON a.kelompok=b.kelompok
WHERE a.pemimpin=1 AND b.no_order='$no_order'
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


            

	
            
            /* Method untuk menyimpan data ke tabel order */
            function insert($no_pemimpin,$no_pemesan) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk insert data order
                // $sql = "INSERT INTO form_order (id,no_pemimpin,no_pemesan,is_approved,timestamp) 
                //         VALUES ('$id','$no_pemimpin','$no_pemesan','$is_approved','$timestamp')";
                
$sql = "
INSERT INTO `form_order`(`id`, `no_pemimpin`, `no_pemesan`, `kode_grab`, `is_approved`, `timestamp`) VALUES (NULL,$no_pemimpin,$no_pemesan,0,0,NOW())
";
                
$result = $mysqli->query($sql); 
return $last_id = $mysqli->insert_id;        
                 
                // cek hasil query
                // if($result){
                //     /* jika data berhasil disimpan alihkan ke halaman order dan tampilkan pesan = 2 */
                //     header("Location: index.php?alert=2");
                // }
                // else{
                //     /* jika data gagal disimpan alihkan ke halaman order dan tampilkan pesan = 1 */
                //     header("Location: index.php?alert=1");
                // }
        
                // menutup koneksi database
                $mysqli->close();
            }
        
            function update_grab_yes($kode_grab,$no_pemimpin) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // $nama         = $mysqli->real_escape_string($nama);
                // $tempat_lahir = $mysqli->real_escape_string($tempat_lahir);
                // $alamat       = $mysqli->real_escape_string($alamat);
        
                // sql statement untuk update data order
                // $sql = "UPDATE db_order SET nama            = '$nama',
                //                             tempat_lahir    = '$tempat_lahir',
                //                             tanggal_lahir   = '$tanggal_lahir',
                //                             jenis_kelamin   = '$jenis_kelamin',
                //                             agama           = '$agama',
                //                             alamat          = '$alamat',
                //                             no_telepon      = '$no_telepon'
                //                       WHERE nis             = '$nis'"; 

$sql = "
UPDATE form_order SET is_approved=1,kode_grab='$kode_grab' WHERE is_approved=0 AND no_pemimpin=$no_pemimpin ORDER BY id DESC LIMIT 1

";                
// nex dev updete berdasarkan timestamp hari ini

// !!!!!!!!!!!!!!! update date now
// ?????????????
// $result = $mysqli->query($sql); 
// return $last_id = $mysqli->update_id;        

return  $result = $mysqli->query($sql);
        
                // cek hasil query
                // if($result){
                //     /* jika data berhasil disimpan alihkan ke halaman order dan tampilkan pesan = 3 */
                //     header("Location: index.php?alert=3");
                // }
                // else{
                //     /* jika data gagal disimpan alihkan ke halaman order dan tampilkan pesan = 1 */
                //     header("Location: index.php?alert=1");
                // }
        
                // menutup koneksi database
                $mysqli->close();
            }



            function view_order($kode_grab) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data grab
                $sql = "SELECT * FROM form_order  WHERE kode_grab='$kode_grab'ORDER BY id DESC LIMIT 1";
        
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

    // sql statement untuk update data order
    // $sql = "UPDATE db_order SET nama            = '$nama',
    //                             tempat_lahir    = '$tempat_lahir',
    //                             tanggal_lahir   = '$tanggal_lahir',
    //                             jenis_kelamin   = '$jenis_kelamin',
    //                             agama           = '$agama',
    //                             alamat          = '$alamat',
    //                             no_telepon      = '$no_telepon'
    //                       WHERE nis             = '$nis'"; 

$sql = "
UPDATE form_order SET is_approved=0,kode_grab=NULL WHERE is_approved=0 AND no_pemimpin=$no_pemimpin ORDER BY id DESC LIMIT 1

";                
// !!!!!!!!!!!!!!! update date now
// ?????????????
// $result = $mysqli->query($sql); 
// return $last_id = $mysqli->update_id;        

return  $result = $mysqli->query($sql);

    // cek hasil query
    // if($result){
    //     /* jika data berhasil disimpan alihkan ke halaman order dan tampilkan pesan = 3 */
    //     header("Location: index.php?alert=3");
    // }
    // else{
    //     /* jika data gagal disimpan alihkan ke halaman order dan tampilkan pesan = 1 */
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

    // sql statement untuk mengambil semua data order
    $sql = "
    SELECT 
 * 
    FROM form_order 
WHERE is_approved=0 
AND no_pemimpin='$no_pemimpin'
ORDER BY id DESC LIMIT 1
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

            /* Method untuk menampilkan data order berdasarkan nis */
            function get_order($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil data order berdasarkan nis
                $sql = "SELECT * FROM db_order WHERE nis='$nis'";
        
                $result = $mysqli->query($sql);
                $data   = $result->fetch_assoc();
        
                // menutup koneksi database
                $mysqli->close();
                
                // nilai kembalian dalam bentuk array
                return $data;
            }
            
            /* Method untuk mengubah data pada tabel order */
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
        
                // sql statement untuk update data order
                $sql = "UPDATE db_order SET nama            = '$nama',
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
                    /* jika data berhasil disimpan alihkan ke halaman order dan tampilkan pesan = 3 */
                    header("Location: index.php?alert=3");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman order dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
            
            /* Method untuk menghapus data pada tabel order */
            function delete($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk delete data order
                $sql = "DELETE FROM db_order WHERE nis = '$nis'";
        
                $result = $mysqli->query($sql);
        
                // cek hasil query
                if($result){
                    /* jika data berhasil disimpan alihkan ke halaman order dan tampilkan pesan = 4 */
                    header("Location: index.php?alert=4");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman order dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
        }
        ?>
        