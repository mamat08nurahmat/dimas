<script type="text/javascript">
function get_excel(){
		var start=document.getElementById('start').value;
		var end=document.getElementById('ends').value;
		// window.location.assign("get_laporan_dma.php?month="+month+"&year="+year);
		window.location.assign("<?= base_url('administrator/form_report_kode_grab/exp_sort')?>"+"?start="+start+"&end="+end);
		}
</script>
  
<section class="content-header">
  <div class="row">
    <div class="col-md-6">
      <?php if($this->input->post('_stardate')==TRUE){?>
      <h3> Report All Kode</h3> 
            <h4><?= $count ?> Data ditemukan pada periode <?= $this->input->post('_stardate') ?> s/d <?= $this->input->post('_enddate') ?> </h4>
                <?php }else{echo '<h3> Report Semua Data</h3>';} ?>
    </div> 
    <div class="col-md-3">

    </div>
    <div class="col-md-3">
        <ol class="breadcrumb" style="background:transparent">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Kode Grab</li>
        </ol>
    </div>
  </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="box box-warning">
        <div class="box-body">
          <div class="box box-widget widget-user-2">
          <?= form_open(base_url('administrator/Form_report_kode_grab/allsort'), [
                    'enctype' => 'multipart/form-data', 
                    'method'  => 'POST']); ?> 
            <div class="col-md-3">
              <i>Tanggal Awal</i>
              <input type="date" name="_stardate" required class="form-control valid-feedback">
            </div>
            <div class="col-md-3" style="margin-left:-25px">
              <i>Tanggal Akhir</i>
              <input type="date" name="_enddate" required class="form-control valid-feedback">
            </div>
            <div class="col-md-6" style="padding-top:20px;margin-left:-25px">
              <button type="submit" class="btn btn-info" title="Submit"><i class="fa fa-paper-plane"></i> Submit</button>
              <?= form_close(); 
              if($this->input->post('_stardate')==NULL){
                echo ' ';
              }else{?>
                <input id="start" type="text" value="<?= $this->input->post('_stardate',true)?>">
                <input id="end" type="text" value="<?= $this->input->post('_enddate',true)?>">
                <button class="btn btn-primary" onclick="get_excel()"><i class="fa fa-file-excel-o"></i> Expsdaort</button>
                <a href="<?= base_url('administrator/form_report_kode_grab/all')?>"class="btn btn-success"><i class="fa fa-refresh"></i></a>
              <?php }?>
            </div>



            <table id="myTable"class="table table-striped table-hover table-striped table-sm table-bordered">
              <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kode</th>
                    <th>Used At</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php 
                $no=1;
                $statusbayar=['<span class="badge badge-danger">Belum</span>','<span class="badge badge-success">Sudah</span>'];
                $stt_acc=['<span class="badge badge-danger">Un-accept</span>','<span class="badge badge-success">Accepted</span>'];
                    foreach($data as $dt): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $dt['nama']?></td>
                    <td><?= $dt['kode_grab']?></td>
                    <td><?= $dt['used_at']?></td>
                    <td><?php if($dt['Name_Employee']==Null){echo '<span>Blm</span>';}else{echo '<span>Terpakai</span>';}?></td>
                    <td>
                        <a href="<?= base_url('administrator/Form_report_kode_grab/alldetail/').$dt['kode_grab']?>" ><i class="fa fa-search"></i><button class="badge badge-dark" title="Detail" ></button></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
          </div>
        </div>
      </div> 
    </div>
    <div class="col-md-6">
      <div class="box box-warning">
        <div class="box-body">
          <div class="box box-widget widget-user-2">
            <div class="widget-user-header">
              <div class="row pull-right">
                <?php echo date("Y M D H-i-s")?>
              </div>
              <div class="widget-user-image">
                here
              </div>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>
</section>