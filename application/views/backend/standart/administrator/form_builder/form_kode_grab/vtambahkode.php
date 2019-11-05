<section class="content-header">
    <div class="row">
        <div class="col-md-9">
            <h3>
                Tambah Kode Grab <small>
            </h3>
        </div>
    </div>
</section>



<section class="content">
   <div class="row" >
      
      <div class="col-md-6">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
                <div class="row">
                    <div class="col-md-3" style="">
                        <button onclick="javascript:history.back()">Kembali</button>
                    </div>
                    <div class="col-md-9 bold" style="color:red">
                        <h5>NOTE : Pastikan Kode Grab ada di Cell B11 !!</h5>
                    </div>
               </div>
               <?= form_open(base_url('administrator/form_kode_grab/import'), [
                    'enctype' => 'multipart/form-data', 
                    'method'  => 'POST'
                    ]); ?>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Active</h5>
                        <input type="date"name="_active" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Expired</h5>
                        <input type="date"name="_expired" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <h5>Select File Excel</h5>
                        <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info" style="margin-top:10px;margin-left:18px"><i class="fa fa-file-excel-o"></i> Import </button>
                    </div>
                </div>
            <?= form_close(); ?>
            </div>
         </div>
         <!--/box -->
      </div>
   </div>
</section>
