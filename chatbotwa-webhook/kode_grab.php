
<?php
        
        /* class kode_grab */
        class kode_grab {

            /* method untuk menampilkan data kode grab aktif */
            function view_stok() {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data grab
                $sql = "SELECT count(*) as stok FROM form_kode_grab  WHERE is_used='0'ORDER BY id DESC";
        
                $result = $mysqli->query($sql);
        
                while ($data = $result->fetch_assoc()) {
                    $hasil[] = $data;
                }
        
                // menutup koneksi database
                $mysqli->close();
        
                // nilai kembalian dalam bentuk array
                return $hasil;
            }


            /* method untuk menampilkan data kode grab aktif */
            function view_aktif() {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data grab
                $sql = "SELECT * FROM form_kode_grab  WHERE is_used='0' AND MONTH(active)=MONTH(NOW()) ORDER BY id ASC LIMIT 1";
        
                $result = $mysqli->query($sql);
        
                while ($data = $result->fetch_assoc()) {
                    $hasil[] = $data;
                }
        
                // menutup koneksi database
                $mysqli->close();
        
                // nilai kembalian dalam bentuk array
                return $hasil;
            }

            /* Method untuk mengubah data pada tabel kode_grab */
            function update($id) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
        
                // sql statement untuk update data kode_grab
                $sql = "UPDATE `form_kode_grab` SET `is_used`=1,`used_at`=NOW() WHERE id=$id"; 
        
                $result = $mysqli->query($sql);
        
                // // cek hasil query
                // if($result){
                //     /* jika data berhasil disimpan alihkan ke halaman kode_grab dan tampilkan pesan = 3 */
                //     header("Location: index.php?alert=3");
                // }
                // else{
                //     /* jika data gagal disimpan alihkan ke halaman kode_grab dan tampilkan pesan = 1 */
                //     header("Location: index.php?alert=1");
                // }
        
                // menutup koneksi database
                $mysqli->close();

                return  $result;
            }                        
 //================================================================           
            /* method untuk menampilkan data kode_grab */
            function view() {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data kode_grab
                $sql = "SELECT * FROM form_kode_grab ORDER BY id DESC";
        
                $result = $mysqli->query($sql);
        
                while ($data = $result->fetch_assoc()) {
                    $hasil[] = $data;
                }
        
                // menutup koneksi database
                $mysqli->close();
        
                // nilai kembalian dalam bentuk array
                return $hasil;
            }
        
            /* Method untuk menyimpan data ke tabel kode_grab */
            function insert($nis, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, $alamat, $no_telepon) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                $nis          = $mysqli->real_escape_string($nis);
                $nama         = $mysqli->real_escape_string($nama);
                $tempat_lahir = $mysqli->real_escape_string($tempat_lahir);
                $alamat       = $mysqli->real_escape_string($alamat);
        
                // sql statement untuk insert data kode_grab
                $sql = "INSERT INTO db_kode_grab (nis,nama,tempat_lahir,tanggal_lahir,jenis_kelamin,agama,alamat,no_telepon) 
                        VALUES ('$nis','$nama','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$agama','$alamat','$no_telepon')";
        
                $result = $mysqli->query($sql);
        
                // cek hasil query
                if($result){
                    /* jika data berhasil disimpan alihkan ke halaman kode_grab dan tampilkan pesan = 2 */
                    header("Location: index.php?alert=2");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman kode_grab dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
        
            /* Method untuk menampilkan data kode_grab berdasarkan nis */
            function get_kode_grab($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil data kode_grab berdasarkan nis
                $sql = "SELECT * FROM db_kode_grab WHERE nis='$nis'";
        
                $result = $mysqli->query($sql);
                $data   = $result->fetch_assoc();
        
                // menutup koneksi database
                $mysqli->close();
                
                // nilai kembalian dalam bentuk array
                return $data;
            }
            

            
            /* Method untuk menghapus data pada tabel kode_grab */
            function delete($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk delete data kode_grab
                $sql = "DELETE FROM db_kode_grab WHERE nis = '$nis'";
        
                $result = $mysqli->query($sql);
        
                // cek hasil query
                if($result){
                    /* jika data berhasil disimpan alihkan ke halaman kode_grab dan tampilkan pesan = 4 */
                    header("Location: index.php?alert=4");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman kode_grab dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
        }
        ?>
        