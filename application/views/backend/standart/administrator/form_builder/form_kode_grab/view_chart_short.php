<section class="content-header">
  <div class="row">
    <div class="col-md-6">
      <h3> Grafik Pemakaian Kode Grab Bulan <?= $this->input->post('month',true).' Tahun '.$this->input->post('year',true);?> </h3> 
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
    <div class="col-md-9">
      <div class="box box-warning">
        <div class="box-body">
          <div class="box box-widget widget-user-2">
            <div class="widget-user-header">
							<h2 class="text-center"><u></u></h2>
							<canvas id="myChart"></canvas>
            </div>
          </div>  
        </div>
      </div>
    </div>
    <div class="col-md-3">
			<div class="box box-warning">
				<div class="box-body">
					<div class="box box-widget widget-user-2">
						<button class="btn btn-block" onclick="javascript:history.back()"><< Kembali</button>
                    </div>  
					<?= form_open(base_url('administrator/Form_report_kode_grab/getchart'), [
                    'enctype' => 'multipart/form-data', 
                    'method'  => 'POST']); ?> 
						<div class="row">
							<div class="col-md-7">
								<select name="month" id="month" class="form-control  btn-block">
									<option>Pilih Bulan</option>
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-7">
								<select name="year" id="year" class="form-control  btn-block">
									<option value="2019">2019</option>
									<option value="2020">2020</option>
								</select>
							</div>
							<div class="col-md-5" style="padding-left:0px">
								<button type="submit" class="btn btn-success btn-block">Cari</button>
							</div>
						</div>
					<?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php for($a=1;$a<=31;$a++){$b[]=json_encode($a);}?>



<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($b); ?>,
				datasets: [{
					label: 'Kode Tidak Terpakai',
                    data: <?php echo $tidakterpakai ?>,
                    backgroundColor: 'rgba(235, 77, 75,1.0)',
                    borderColor: 'rgba(156, 136, 255,0.4)',
                    borderWidth: 1
				},
                {
					label: 'Kode Terpakai',
                    data: <?php echo $terpakai ?>,
                    backgroundColor: 'rgba(106, 176, 76,1.0)',
                    borderColor: 'blue',
                    borderWidth: 0.001
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
</script> 

<a href="">Generate now</a >