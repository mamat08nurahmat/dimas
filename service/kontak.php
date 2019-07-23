
<?php
        
        /* class kontak */
        class kontak {
        
            /* method untuk menampilkan data kontak */
            function view_is_pemimpin($no_kontak_pemohon) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data kontak
                $sql = "
                SELECT * FROM form_kontak 
                WHERE kelompok IN(
                SELECT kelompok FROM form_kontak WHERE no_kontak=$no_kontak_pemohon
                )
                 AND pemimpin=1
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

            function view_detail($no_kontak) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data kontak
                $sql = "
                SELECT * FROM form_kontak 
                WHERE no_kontak=$no_kontak
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


//dev 21072019
            /* method untuk menampilkan data kontak */
            function view_pemimpin($no_kontak) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data kontak
                $sql = "
                SELECT 
                a.*
                ,b.nama as nama_pemesan 
                FROM form_kontak a
LEFT JOIN form_kontak b ON a.kelompok=b.kelompok
WHERE a.pemimpin=1 AND b.no_kontak='$no_kontak'
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


            


            /* Method untuk menyimpan data ke tabel kontak */
            function insert($nama,$no_kontak,$kelompok) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
                        
                // $nis          = $mysqli->real_escape_string($nis);
        
                // sql statement untuk insert data kontak
                $sql = "
                INSERT INTO `form_kontak`(`id`, `nama`, `no_kontak`, `kelompok`, `pemimpin`) VALUES (NULL,'$nama','$no_kontak','$kelompok',0)                
                ";
        
                 $result = $mysqli->query($sql);
                 return $result;
                //  return $last_id = $mysqli->insert_id; 
        
        
                // menutup koneksi database
                $mysqli->close();
            }
        
            /* Method untuk menampilkan data kontak berdasarkan nis */
            function get_kontak($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil data kontak berdasarkan nis
                $sql = "SELECT * FROM db_kontak WHERE nis='$nis'";
        
                $result = $mysqli->query($sql);
                $data   = $result->fetch_assoc();
        
                // menutup koneksi database
                $mysqli->close();
                
                // nilai kembalian dalam bentuk array
                return $data;
            }
            
            /* Method untuk mengubah data pada tabel kontak */
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
        
                // sql statement untuk update data kontak
                $sql = "UPDATE db_kontak SET nama            = '$nama',
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
                    /* jika data berhasil disimpan alihkan ke halaman kontak dan tampilkan pesan = 3 */
                    header("Location: index.php?alert=3");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman kontak dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
            
            /* Method untuk menghapus data pada tabel kontak */
            function delete($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk delete data kontak
                $sql = "DELETE FROM db_kontak WHERE nis = '$nis'";
        
                $result = $mysqli->query($sql);
        
                // cek hasil query
                if($result){
                    /* jika data berhasil disimpan alihkan ke halaman kontak dan tampilkan pesan = 4 */
                    header("Location: index.php?alert=4");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman kontak dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
        }
        ?>
        