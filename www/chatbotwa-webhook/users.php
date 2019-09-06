
<?php
        
        /* class users */
        class users {

//dev 31072019
            /* Method untuk menampilkan data users berdasarkan kontak */
            function get_all_kontak() {
        // memanggil file database.php
        require_once "config/database.php";

        // membuat objek db dengan nama $db
        $db = new database();

        // membuka koneksi ke database
        $mysqli = $db->connect();

        // sql statement untuk mengambil semua data siswa
        $sql = "SELECT * FROM form_users WHERE kelompok='DEV'"; //tes
        // $sql = "SELECT * FROM form_users ";

        $result = $mysqli->query($sql);

        while ($data = $result->fetch_assoc()) {
            $hasil[] = $data;
        }

        // menutup koneksi database
        $mysqli->close();

        // nilai kembalian dalam bentuk array
        return $hasil;
            }


            /* Method untuk mengubah data pada tabel users */
            function update_kelompok($no_kontak,$kelompok_baru) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // $nama         = $mysqli->real_escape_string($nama);
                // $tempat_lahir = $mysqli->real_escape_string($tempat_lahir);
                // $alamat       = $mysqli->real_escape_string($alamat);
        
                // sql statement untuk update data users
                $sql = "UPDATE form_users SET kelompok    = '$kelompok_baru'
                                      WHERE kontak    = '$no_kontak'"; 
        
                $result = $mysqli->query($sql);
        
        
                // menutup koneksi database
                $mysqli->close();

                return $result;
            }


// dev 26072019
            /* Method untuk mengubah data pada tabel users */
            function update_pemimpin($no_kontak_pemimpin_lama,$no_kontak_pemimpin_baru) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk update data users
                $sql1 = "UPDATE `chatbotwa`.`form_users` SET `level`='1' WHERE `kontak`='$no_kontak_pemimpin_baru'"; 
                $result1 = $mysqli->query($sql1);
                $sql2 = "UPDATE `chatbotwa`.`form_users` SET `level`='2' WHERE `kontak`='$no_kontak_pemimpin_lama'"; 
                $result2 = $mysqli->query($sql2);
        
        
                // menutup koneksi database
                $mysqli->close();

                return $result;
            }



            /* method untuk menampilkan data kontak pemimpin supporting*/
            function get_pemimpin_sup() {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data kontak
                $sql = "
                SELECT * FROM form_users 
                WHERE kelompok='SUP' AND level=1
                ";

                // $sql = "
                // SELECT 
                // a.nama as nama_pemimpin
                // ,a.no_kontak as no_kontak_pemimpin
                // ,b.nama as nama_pemohon
                // ,b.no_kontak as no_kontak_pemohon

                // FROM form_kontak a 
                // LEFT JOIN form kontak b ON a.kelompok=b.kelompok
                // WHERE a.pemimpin=1
                // AND b.no_kontak=$no_kontak_pemohon    
                // ";
                

                $result = $mysqli->query($sql);
        
                while ($data = $result->fetch_assoc()) {
                    $hasil[] = $data;
                }
        
                // menutup koneksi database
                $mysqli->close();
        
                // nilai kembalian dalam bentuk array
                return $hasil;
            }
            
            /* method untuk menampilkan data kontak */
            function get_pemimpin($no_kontak) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data kontak
                $sql = "
                SELECT * FROM form_users 
                WHERE kelompok IN(
                SELECT kelompok FROM form_users WHERE kontak='$no_kontak'
                )
                 AND level=1
                ";

                // $sql = "
                // SELECT 
                // a.nama as nama_pemimpin
                // ,a.no_kontak as no_kontak_pemimpin
                // ,b.nama as nama_pemohon
                // ,b.no_kontak as no_kontak_pemohon

                // FROM form_kontak a 
                // LEFT JOIN form kontak b ON a.kelompok=b.kelompok
                // WHERE a.pemimpin=1
                // AND b.no_kontak=$no_kontak_pemohon    
                // ";
                

                $result = $mysqli->query($sql);
        
                while ($data = $result->fetch_assoc()) {
                    $hasil[] = $data;
                }
        
                // menutup koneksi database
                $mysqli->close();
        
                // nilai kembalian dalam bentuk array
                return $hasil;
            }

            function get_detail($no_kontak) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data kontak
                $sql = "
                SELECT * FROM `form_users` WHERE `kontak` ='$no_kontak'
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


// dev 25072019 
function get_all_kelompok($kelompok) {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data kontak
    $sql = "
    SELECT * FROM `form_users` WHERE `kelompok` ='$kelompok'
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

//====================================================            
            /* method untuk menampilkan data users */
            function view() {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data users
                $sql = "SELECT * FROM db_users ORDER BY nis DESC";
        
                $result = $mysqli->query($sql);
        
                while ($data = $result->fetch_assoc()) {
                    $hasil[] = $data;
                }
        
                // menutup koneksi database
                $mysqli->close();
        
                // nilai kembalian dalam bentuk array
                return $hasil;
            }
        
            /* Method untuk menyimpan data ke tabel users */
            function insert($nama,$kontak,$kelompok,$level) {
                // $level=2; //non pemimpin
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
        
                // sql statement untuk insert data users
                $sql = "INSERT INTO `form_users`(`id`, `nama`, `kontak`, `kelompok`, `level`) VALUES (NULL,'$nama','$kontak','$kelompok',$level)";
        
                $result = $mysqli->query($sql);
        
                // cek hasil query
                // if($result){
                //     /* jika data berhasil disimpan alihkan ke halaman users dan tampilkan pesan = 2 */
                //     header("Location: index.php?alert=2");
                // }
                // else{
                //     /* jika data gagal disimpan alihkan ke halaman users dan tampilkan pesan = 1 */
                //     header("Location: index.php?alert=1");
                // }
        
                // menutup koneksi database
                $mysqli->close();
                return $result;
            }
        
            /* Method untuk menampilkan data users berdasarkan kontak */
            function get_users($kontak) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil data users berdasarkan nis
                $sql = "SELECT * FROM form_users WHERE kontak='$kontak'";
        
                $result = $mysqli->query($sql);
                $data   = $result->fetch_assoc();
        
                // menutup koneksi database
                $mysqli->close();
                
                // nilai kembalian dalam bentuk array
                return $data;
            }

            /* Method untuk menampilkan data users berdasarkan kontak */
            function get_kelompok($nama_kelompok) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil data users berdasarkan nis
                $sql = "SELECT * FROM form_users WHERE kelompok='$nama_kelompok'";
        
                $result = $mysqli->query($sql);
                $data   = $result->fetch_assoc();
        
                // menutup koneksi database
                $mysqli->close();
                
                // nilai kembalian dalam bentuk array
                return $data;
            }
            

            /* Method untuk mengubah data pada tabel users */
            function update($nama_update,$kontak_update,$kelompok_update,$level_update,$where_kontak_update) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // $nama         = $mysqli->real_escape_string($nama);
                // $tempat_lahir = $mysqli->real_escape_string($tempat_lahir);
                // $alamat       = $mysqli->real_escape_string($alamat);
        
                // sql statement untuk update data users
                $sql = "UPDATE form_users SET nama    = '$nama_update',
                                            kontak    = '$kontak_update',
                                            kelompok  = '$kelompok_update',
                                            level     = '$level_update'
                                      WHERE kontak    = '$where_kontak_update'"; 
        
                $result = $mysqli->query($sql);
        
        
                // menutup koneksi database
                $mysqli->close();

                return $result;
            }
            
            /* Method untuk menghapus data pada tabel users */
            function delete($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk delete data users
                $sql = "DELETE FROM db_users WHERE nis = '$nis'";
        
                $result = $mysqli->query($sql);
        
                // cek hasil query
                if($result){
                    /* jika data berhasil disimpan alihkan ke halaman users dan tampilkan pesan = 4 */
                    header("Location: index.php?alert=4");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman users dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
        }
        ?>
        