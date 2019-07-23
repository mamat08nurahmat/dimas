
<?php
        
        /* class grab */
        class grab {
        
            /* method untuk menampilkan data grab */
            function view() {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data grab
                $sql = "SELECT * FROM form_grab  WHERE is_used='no'ORDER BY id DESC";
        
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



            function update_grab($kode_grab,$id_order) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // $nama         = $mysqli->real_escape_string($nama);
                // $tempat_lahir = $mysqli->real_escape_string($tempat_lahir);
                // $alamat       = $mysqli->real_escape_string($alamat);
        
                // sql statement untuk update data grab
                // $sql = "UPDATE db_grab SET nama            = '$nama',
                //                             tempat_lahir    = '$tempat_lahir',
                //                             tanggal_lahir   = '$tanggal_lahir',
                //                             jenis_kelamin   = '$jenis_kelamin',
                //                             agama           = '$agama',
                //                             alamat          = '$alamat',
                //                             no_telepon      = '$no_telepon'
                //                       WHERE nis             = '$nis'"; 

$sql = "
UPDATE form_grab  
SET id_order = $id_order, 
    is_used = 'yes',
    used_at = NOW()
WHERE kode_grab='$kode_grab'

";                

return  $result = $mysqli->query($sql);
        
                // cek hasil query
                // if($result){
                //     /* jika data berhasil disimpan alihkan ke halaman grab dan tampilkan pesan = 3 */
                //     header("Location: index.php?alert=3");
                // }
                // else{
                //     /* jika data gagal disimpan alihkan ke halaman grab dan tampilkan pesan = 1 */
                //     header("Location: index.php?alert=1");
                // }
        
                // menutup koneksi database
                $mysqli->close();
            }

//==========================

            /* Method untuk menampilkan data grab berdasarkan nis */
            function get_grab($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil data grab berdasarkan nis
                $sql = "SELECT * FROM db_grab WHERE nis='$nis'";
        
                $result = $mysqli->query($sql);
                $data   = $result->fetch_assoc();
        
                // menutup koneksi database
                $mysqli->close();
                
                // nilai kembalian dalam bentuk array
                return $data;
            }
            
            /* Method untuk mengubah data pada tabel grab */
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
        
                // sql statement untuk update data grab
                $sql = "UPDATE db_grab SET nama            = '$nama',
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
                    /* jika data berhasil disimpan alihkan ke halaman grab dan tampilkan pesan = 3 */
                    header("Location: index.php?alert=3");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman grab dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
            
            /* Method untuk menghapus data pada tabel grab */
            function delete($nis) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk delete data grab
                $sql = "DELETE FROM db_grab WHERE nis = '$nis'";
        
                $result = $mysqli->query($sql);
        
                // cek hasil query
                if($result){
                    /* jika data berhasil disimpan alihkan ke halaman grab dan tampilkan pesan = 4 */
                    header("Location: index.php?alert=4");
                }
                else{
                    /* jika data gagal disimpan alihkan ke halaman grab dan tampilkan pesan = 1 */
                    header("Location: index.php?alert=1");
                }
        
                // menutup koneksi database
                $mysqli->close();
            }
        }
        ?>
        