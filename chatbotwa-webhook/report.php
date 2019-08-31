<?php

// $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
//                 "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
//                 $_SERVER['REQUEST_URI']; 

// echo $link; 

// die();

// print_r($res);die();


// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=report_grab.xls");
?>

<h3>Data Report</h3>
    
<table border="1" cellpadding="5">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>No_Kontak</th>
    <th>Kelompok</th>
    <th>Kode_Grab</th>
    <th>used_at</th>

    <th>Name_Employee</th>
    <th>Date_Time</th>
    <th>Pickup_Date</th>
    <th>Dropoff_Date</th>
    <th>Trip_Code</th>
    <th>Employee_ID</th>
    <th>Trip_Description</th>


  </tr>
<?php
require_once 'order_grab.php';
$order_grab = new order_grab();
$result = $order_grab->view();

$no = 1; // Untuk penomoran tabel, di awal set dengan 1

if (!empty($result)) { 
    foreach($result as $data) {

   

      echo "  <tr>
            <td width='50' class='center'>$no</td>
            <td width='150'>$data[nama]</td>
            <td width='60'>$data[no_pemesan]</td>
            <td width='180'>$data[kelompok]</td>
            <td width='120'>$data[kode_grab]</td>
            <td width='120'>$data[used_at]</td>

            <td width='120'>$data[Name_Employee]</td>
            <td width='120'>$data[Date_Time]</td>
            <td width='120'>$data[Pickup_Date]</td>
            <td width='120'>$data[Dropoff_Date]</td>
            <td width='120'>$data[Trip_Code]</td>
            <td width='120'>$data[Employee_ID]</td>
            <td width='120'>$data[Trip_Description]</td>

          </tr>";
      $no++;
    }
  }



?>


</table>

