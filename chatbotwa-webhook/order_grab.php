
<?php
        
        /* class order_grab */
        class order_grab {

//dev 08082019
function all_users() {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data order_grab
    $sql = "
    SELECT *
FROM 
form_users 
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


//dev 03092019
function grab_info_tim($kelompok) {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data order_grab
    $sql = "
    select 
    nama,
    no_pemesan,
    kelompok,
    count(nama) jumlah, 
    sum(CAST(replace(fare,'.00','') AS decimal(18))) as total_fare,
    MONTHNAME(order_voucher_at) as bulan
    from chatbotwa.vw_report_sudah_terpakai
    where kelompok='$kelompok'
    group by nama,no_pemesan,kelompok,bulan
    order by total_fare desc
    

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


// dev 21082019
function report_ymd($no_pemesan,$kelompok,$level) {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data order_grab
    $sql1 = "
    select 
    nama, kelompok, no_pemesan, no_pemimpin, YEAR, COUNT_YTD, TOTAL_YTD
    from vw_report_ytd where kelompok='$kelompok'
    ";

    $sql2 = "
    select 
    nama, kelompok, no_pemesan, no_pemimpin, YEAR, COUNT_YTD, TOTAL_YTD
    from vw_report_ytd where no_pemesan='$no_pemesan'
    ";


if($level==1){

    $result = $mysqli->query($sql1);
}else{
    $result = $mysqli->query($sql2);
}


    while ($data = $result->fetch_assoc()) {
        $hasil[] = $data;
    }

    // menutup koneksi database
    $mysqli->close();

    // nilai kembalian dalam bentuk array
    return $hasil;
}




//dev 09082019
function belum_terpakai_detail($no_pemesan) {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data order_grab
    $sql = "
    select 
    no_pemesan, nama, kelompok, kode_grab, used_at
    from vw_report_belum_terpakai where no_pemesan='$no_pemesan'
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

function sudah_terpakai_detail($no_pemesan) {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data order_grab
    $sql = "
    select 
    no_pemesan, no_pemimpin, nama, kelompok, kode_grab, order_voucher_at, Name_Employee, Date_Time, Pick_Up, Pickup_Date, Drop_Off, Dropoff_Date, Trip_Code, Employee_ID, Trip_Description, Promo_Value, Tolls_Others, fare, Total, update_at
    from vw_report_sudah_terpakai where no_pemesan='$no_pemesan'
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



function sudah_terpakai($no_pemesan) {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data order_grab
    $sql = "
    select 
    no_pemesan, nama, kelompok, jumlah,update_at    
    from vw_top_sudah_terpakai where no_pemesan='$no_pemesan'
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


//dev 08092019
function belum_terpakai($no_pemesan) {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data order_grab
    $sql = "
    select 
    
    no_pemesan, nama, kelompok, jumlah    
    from vw_top_belum_terpakai where no_pemesan='$no_pemesan'
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


//dev 08082019
function belum_notif_order() {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data order_grab
    $sql = "
    SELECT *
FROM 
vw_report_sudah_terpakai 
where is_notif=0
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


//dev 06082019
function detail_belum_terpakai($no_kontak_pemesan) {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data order_grab
    $sql = "
    select 
    a.no_pemesan
    ,b.nama
    ,b.kelompok
    ,c.kode_grab
    ,c.expired
    FROM chatbotwa.form_order_grab a
     left join form_users b ON a.no_pemesan=b.kontak
     left join form_kode_grab c ON a.id_kode_grab=c.id
     left join grab_report r ON c.kode_grab=r.Trip_code
    where a.no_pemesan='$no_kontak_pemesan' AND r.Trip_code IS NULL    
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
/*
*/

//dev 06082019
function cek_belum_terpakai($no_kontak_pemesan) {
    // memanggil file database.php
    require_once "config/database.php";

    // membuat objek db dengan nama $db
    $db = new database();

    // membuka koneksi ke database
    $mysqli = $db->connect();

    // sql statement untuk mengambil semua data order_grab
    $sql = "
    select count(*) as belum_terpakai
    FROM chatbotwa.form_order_grab a
     left join form_users b ON a.no_pemesan=b.kontak
     left join form_kode_grab c ON a.id_kode_grab=c.id
     left join grab_report r ON c.kode_grab=r.Trip_code
    where a.no_pemesan='$no_kontak_pemesan' AND r.Trip_code IS NULL    
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



//dev 01082019
            function export_report() {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data order_grab
                $sql = "
                SELECT 

a.no_pemesan
,b.nama
,b.kelompok
,c.kode_grab
,c.used_at
FROM chatbotwa.form_order_grab a
left join form_users b ON a.no_pemesan=b.kontak
left join form_kode_grab c ON a.id_kode_grab=c.id
ORDER BY c.used_at descb 
             
                
                ";

               
          $result = $mysqli->query($sql);
        
                while ($data = $result->fetch_assoc()) {
                    $hasil[] = $data;
                }
        
                // menutup koneksi database
                $mysqli->close();
        
                // nilai kembalian dalam bentuk array
                return $hasil;
                // return  $result;
            }            

            /* method untuk menampilkan data order_grab */
            function view() {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // sql statement untuk mengambil semua data order_grab
                $sql = "
                
                SELECT 
                a.no_pemesan
                ,b.nama
                ,b.kelompok
                ,c.kode_grab
                ,c.used_at
                
                
                ,r.Name_Employee
                ,r.Date_Time
                ,r.Pickup_Date
                ,r.Dropoff_Date
                ,r.Trip_Code
                ,r.Employee_ID
                ,r.Trip_Description 
                
                FROM chatbotwa.form_order_grab a
                left join form_users b ON a.no_pemesan=b.kontak
                left join form_kode_grab c ON a.id_kode_grab=c.id
                left join grab_report r ON c.kode_grab=r.Trip_code
                ;                
                
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
                $sql = "INSERT INTO `form_order_grab`(`id`, `no_pemesan`, `no_pemimpin`, `id_kode_grab`, `is_approved`, `timestamp`) VALUES (NULL,'$no_pemesan','$no_pemimpin','$id_kode_grab',0,NOW())"; //dev 08082019
        
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
            function update_notif($kode_grab) {
                // memanggil file database.php
                require_once "config/database.php";
        
                // membuat objek db dengan nama $db
                $db = new database();
        
                // membuka koneksi ke database
                $mysqli = $db->connect();
        
                // $nama         = $mysqli->real_escape_string($nama);
                // $tempat_lahir = $mysqli->real_escape_string($tempat_lahir);
                // $alamat       = $mysqli->real_escape_string($alamat);
        
                // sql statement untuk update data order_grab
                $sql = "
                UPDATE
                form_order_grab o
                left join form_kode_grab  k ON o.id_kode_grab=k.id
                SET o.is_approved=1 
                WHERE k.kode_grab='$kode_grab'
                "; 
        
                $result = $mysqli->query($sql);
        
                // cek hasil query
                // if($result){
                //     /* jika data berhasil disimpan alihkan ke halaman order_grab dan tampilkan pesan = 3 */
                //     header("Location: index.php?alert=3");
                // }
                // else{
                //     /* jika data gagal disimpan alihkan ke halaman order_grab dan tampilkan pesan = 1 */
                //     header("Location: index.php?alert=1");
                // }
                    return $result;
                // menutup koneksi database
                $mysqli->close();
            }
            

        }
        ?>
        