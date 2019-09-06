
<?php
        
        /* class order_grab */
        class order_grab {
        
            /* method untuk menampilkan data order_grab */
            function view() {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data order_grab
                $sql = "SELECT * FROM db_order_grab ORDER BY nis DESC";
        
                $result = $mysqli->query($sql);
        
                while ($data = $result->fetch_assoc()) {
                    $hasil[] = $data;
                }
        
                // menutup koneksi database
                $mysqli->close();
        
                // nilai kembalian dalam bentuk array
                return $hasil;
            }
        
            /* Method untuk menyimpan data ke tabel order_grab */
            function insert($no_pemesan,$no_pemimpin,$id_kode_grab) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // $nis          = $mysqli->real_escape_string($nis);
                // $nama         = $mysqli->real_escape_string($nama);
                // $tempat_lahir = $mysqli->real_escape_string($tempat_lahir);
                // $alamat       = $mysqli->real_escape_string($alamat);
        
                // sql statement untuk insert data order_grab
                $sql = "INSERT INTO `form_order_grab`(`id`, `no_pemesan`, `no_pemimpin`, `id_kode_grab`, `is_approved`, `timestamp`) VALUES (NULL,'$no_pemesan','$no_pemimpin','$id_kode_grab',1,NOW())";
        
                $result = $mysqli->query($sql);
                return $result;
                // // cek hasil query
                // if($result){
                //     /* jika data berhasil disimpan alihkan ke halaman order_grab dan tampilkan pesan = 2 */
                //     header("Location: index.php?alert=2");
                // }
                // else{
                //     /* jika data gagal disimpan alihkan ke halaman order_grab dan tampilkan pesan = 1 */
                //     header("Location: index.php?alert=1");
                // }
        
                // menutup koneksi database
                $mysqli->close();
            }
        
            /* Method untuk menampilkan data order_grab berdasarkan nis */
            function get_order_grab($kontak) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil data order_grab berdasarkan nis
                $sql = "
                SELECT 
                b.nama
                ,b.kontak
                ,b.kelompok
                ,count(a.id) jumlah 
                FROM form_order_grab a
                LEFT JOIN form_users b ON a.no_pemesan=b.kontak
                WHERE a.no_pemesan='$kontak'                
                ";
        
                $result = $mysqli->query($sql);
                $data   = $result->fetch_assoc();
        
                // menutup koneksi database
                $mysqli->close();
                
                // nilai kembalian dalam bentuk array
                return $data;
            }
            
            /* Method untuk mengubah data pada tabel order_grab */
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
        
                // sql statement untuk update data order_grab
                $sql = "UPDATE db_order_grab SET nama            = '$nama',
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
                    /* jika data berhasil disimpan alihkan ke halaman order_grab dan tampilkan pesan = 3 */
                    header("Location: index.php?alert=3");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman order_grab dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
            
            /* Method untuk menghapus data pada tabel order_grab */
            function delete($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk delete data order_grab
                $sql = "DELETE FROM db_order_grab WHERE nis = '$nis'";
        
                $result = $mysqli->query($sql);
        
                // cek hasil query
                if($result){
                    /* jika data berhasil disimpan alihkan ke halaman order_grab dan tampilkan pesan = 4 */
                    header("Location: index.php?alert=4");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman order_grab dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
        }
        ?>
        