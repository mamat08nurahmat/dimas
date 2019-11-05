<?php
    // Koneksi Database
    $conn = mysqli_connect("localhost", "root", "", "fei");
    include("PHPExcel/Classes/PHPExcel/IOFactory.php"); // tambahkan Library PHPExcel yang sudah di download
if(isset($_FILES["filenya"]["name"]))
    {
      $path = $_FILES["filenya"]["tmp_name"];
      $object = PHPExcel_IOFactory::load($path);
      foreach($object->getWorksheetIterator() as $worksheet)
      {
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        for($row=2; $row<=$highestRow; $row++)
        {
                    $nama          = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $kelas         = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $alamat        = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $telepon       = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $kelahiran     = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
      // var_dump($highestRow);die();

              $conn->query("INSERT INTO temp SET 
                nama='$nama',
                kelas='$kelas',
                alamat='$alamat',
                telepon='$telepon',
                kelahiran='$kelahiran'
              ");
              
        }
      }
    }
     


die();
     //tampung data
$judul=$_POST['judul'];
$kategori=$_POST['kategori'];
//khusus inputan file
$nama_foto=base64_encode($_FILES['fotonya']['name']);
$file_foto=$_FILES['fotonya']['tmp_name'];
//pidankan gambar ke folder . praktek dulu
move_uploaded_file($file_foto,'gambar/'.$nama_foto);
//insert ke table galeri
$db->query("INSERT INTO 3_galeri SET
  judul='$judul', 
  kategori='$kategori',
  fotonya='$nama_foto'");
//kalau sudah betul semua buar redirect
    ?>









