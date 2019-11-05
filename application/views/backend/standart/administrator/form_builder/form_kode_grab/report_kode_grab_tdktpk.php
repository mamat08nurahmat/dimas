<section class="content-header">
  <div class="row">
    <div class="col-md-6">
      <?php if($this->input->post('_stardate')==False){
                echo '<h3> Report Kode Tidak Terpakai</h3>';
          }else{?>
              <h3> Report Kode Tidak Terpakai</h3> 
              <h4><?= $count ?> Data ditemukan pada periode <?= $this->input->post('_stardate') ?> s/d <?= $this->input->post('_enddate') ?> </h4>
          <?php } ?>
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
                    <!-- ------------------------------------------------------------------ -->
                    <!-- ------------------------------------------------------------------ -->
                    <?= form_open(base_url('administrator/Form_report_kode_grab/sortbelumterpakai'), [
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
                          <a href="#"class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export</a>
                          <a href="<?= base_url('administrator/form_report_kode_grab/tdkterpakai')?>"class="btn btn-success"><i class="fa fa-refresh"></i></a>
                        <?php }?>
                      </div>
                    <!-- ------------------------------------------------------------------ -->
                    <!-- ------------------------------------------------------------------ -->
            <!-- </div> -->


            <table id="myTable"class="table table-striped table-hover table-striped table-sm table-bordered">
              <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kode</th>
                    <th>Tanggal Order</th>
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
                    <td class="text-left"><?= $dt['nama']?></td>
                    <td><?= $dt['kode_grab']?></td>
                    <td><?= $dt['used_at']; ?></td>
                  
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

              <div style="">
                <h2 class="text-center"><u></u></h2>
                <canvas id="myChart"></canvas>
              </div>

            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>
</section>





<?php for($a=1;$a<=31;$a++){$b[]=json_encode($a);}?>
<!--<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php //echo json_encode($b); ?>,
				datasets: [{
					label: 'Data order',
					data: <?php //echo $oktober ?>,
					backgroundColor: [
					'rgba(156, 136, 255,0.4)',
					],
					borderColor: [
            'rgba(156, 136, 255,0.4)',
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>-->