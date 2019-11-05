<section class="content-header">
    <div class="row">
        <div class="col-md-9">
            <h3>
                Detail atas nama <?= $data['nama']?><small>
            </h3>
        </div>
        <div class="col-md-3">
            <ol class="breadcrumb" style="background:transparent">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">All Data</li>
                <li class="active">Detail <?= $data['kode_grab']?></li>
            </ol>
        </div>
    </div>
</section>


<section class="content">
   <div class="row" >
      
      <div class="col-md-10">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <div class="">
                  <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <button class="btn btn-success"onclick="javascript:history.back()"><i class="chevron-left"></i>Kembali</button>
                    </div>
                  </div>
                    <div class="row">
                        <div class="col-md-4">
                            <i>Kode Grab</i>
                            <input type="text" readonly class="form-control" value="<?= $data['kode_grab']?>">
                        </div>
                        <div class="col-md-8">
                            <i>Titik Penjemputan</i>
                            <input type="text" readonly class="form-control" value="<?= $data['Pick_Up']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <i>Nama</i>
                            <input type="text" readonly class="form-control" value="<?= $data['Name_Employee']?>">
                        </div>
                        <div class="col-md-8">
                            <i>Pick Up Date</i>
                            <input type="text" readonly class="form-control" value="<?= $data['Pickup_Date']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <i>Kelompok</i>
                            <input type="text" readonly class="form-control" value="<?= $data['kelompok']?>">
                        </div>
                        <div class="col-md-8">
                            <i>Titik Tujuan</i>
                            <input type="text" readonly class="form-control" value="<?= $data['Drop_Off']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <i>Tanggal Order</i>
                            <input type="text" readonly class="form-control" value="<?= $data['Date_Time']?>">
                        </div>
                        <div class="col-md-8">
                            <i>Drop Off Date</i>
                            <input type="text" readonly class="form-control" value="<?= $data['Dropoff_Date']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <i>No Pemimpin</i>
                            <input type="text" readonly class="form-control" value="<?= $data['no_pemimpin']?>">
                        </div>
                        <div class="col-md-8">
                            <i>Trip Description</i>
                            <input type="text" readonly class="form-control" value="<?= $data['Trip_Description']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <i>No Pemesan</i>
                            <input type="text" readonly class="form-control" value="<?= $data['no_pemesan']?>">
                        </div>
                        <div class="col-md-8">
                            <i>Tarif</i>
                            <input type="text" readonly class="form-control" value="Rp. <?= $data['fare']?>">
                        </div>
                    </div>
                  </div>
               </div>
               <hr>
            </div>
         </div>
         <!--/box -->
      </div>
   </div>
</section>
